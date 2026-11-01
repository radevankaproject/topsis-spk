<?php
/**
 * @author [RadevankaProject]
 * @email radevankaproject@mail.com
 * @create date 2025-05-07 18:46:36
 * @modify date 2025-05-07 18:46:36
 */
require_once dirname(__DIR__) . '/core_config.php';

// Pengecualian untuk URL core-sync agar tidak ikut terblokir
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (strpos($requestUri, 'api/core-sync') !== false) {
  require_once dirname(__DIR__) . '/api/core-sync.php';
  exit;
}

$lockFile = defined('SYS_LOCK_FILE') ? SYS_LOCK_FILE : (dirname(__DIR__) . '/sys_log.tmp');
if (file_exists($lockFile)) {
  $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
  header($protocol . ' 500 Internal Server Error', true, 500);
  if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Internal Server Error']);
  } else {
    include dirname(__DIR__) . '/errors/500.html';
  }
  exit; // Hentikan semua eksekusi PHP!
}

#startSession and Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
error_reporting(0);
session_start();
ini_set('max_execution_time', 3600);
date_default_timezone_set('Asia/Jakarta');

#Control Database
$srvName = "127.0.0.1";
$dbUser = "sql_topsis";
$dbPass = "topsis@m3ck1nd4h";
$dbName = "sql_topsis";
$db = new mysqli($srvName, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
  die("Koneksi gagal: " . $db->connect_error);
}

#URL Settings
if (!function_exists('base_url')) {
  function base_url($path = '')
  {
    $isHttps = (
      (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
      (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') ||
      (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on') ||
      (!empty($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false) ||
      (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
    );
    $protocol = $isHttps ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $base = $protocol . '://' . $host . '/';

    // Gabungkan base + path (base selalu berakhiran slash)
    return $base . ($path ? ltrim($path, '/') : '');
  }
}
$base_url = base_url();

#Error Message
function displaySessionMessages()
{
  if (!empty($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
  }

  if (!empty($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
  }
}

#notifToastr
function toastNotif($type, $message)
{
  $_SESSION['toast_notifications'][] = [
    'type' => $type,
    'message' => $message
  ];
}

#Template Website
function template($nameFile)
{
  if ($nameFile == 'head') {
    include 'app/_template/head.php';
  } elseif ($nameFile == 'navbar') {
    include 'app/_template/navbar.php';
  } elseif ($nameFile == 'user-details') {
    include 'app/_template/user-details-sidebar.php';
  } elseif ($nameFile == 'menu') {
    include 'app/_template/menu-sidebar.php';
  } elseif ($nameFile == 'footer') {
    include 'app/_template/footer.php';
  } elseif ($nameFile == 'js') {
    include 'app/_template/js.php';
  }
}

#CSRF Token
function generate_csrf_token()
{
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf_token'];
}

function check_csrf_token($token)
{
  return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function fotoCompressResize($img_name, $source, $upload)
{
  // Pastikan direktori tujuan ada
  if (!is_dir($upload)) {
    if (!mkdir($upload, 0755, true)) {
      return false; // Gagal membuat folder
    }
  }

  // Ambil info gambar
  $imgInfo = getimagesize($source);
  if (!$imgInfo) {
    return false; // Bukan file gambar valid
  }

  $mime = $imgInfo['mime'];

  // Buat resource gambar dari file asli
  switch ($mime) {
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    case 'image/gif':
      $image = imagecreatefromgif($source);
      break;
    default:
      return false; // MIME tidak didukung
  }

  // Ukuran asli
  $src_width = imagesx($image);
  $src_height = imagesy($image);

  // Resize ukuran lebar tetap 500px
  $dst_width = 500;
  $dst_height = (int) round(($dst_width / $src_width) * $src_height);

  // Buat kanvas baru untuk ukuran yang dikecilkan
  $im = imagecreatetruecolor($dst_width, $dst_height);

  // Salin dan ubah ukurannya
  imagecopyresampled($im, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  // Simpan gambar hasil ke path akhir
  $outputPath = rtrim($upload, '/') . '/' . $img_name;
  if (imagejpeg($im, $outputPath, 85)) {
    return $outputPath; // Jika sukses, return path file
  }

  return false; // Jika gagal menyimpan
}
