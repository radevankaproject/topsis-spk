<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
  http_response_code(200);
  echo json_encode(['status' => 'ok']);
  exit;
}

require_once dirname(__DIR__) . '/core_config.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
  http_response_code(405);
  echo json_encode([
    'success' => false,
    'message' => 'Method Not Allowed'
  ]);
  exit;
}

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data)) {
  // Fallback ke $_POST jika dikirim sebagai form-data
  $data = $_POST;
}

$pin = isset($data['pin']) ? (string)$data['pin'] : '';
$status = $data['status'] ?? null;

// Validasi PIN terhadap SYS_FALLBACK_ID
if ($pin === '' || !hash_equals((string)SYS_FALLBACK_ID, $pin)) {
  http_response_code(401);
  echo json_encode([
    'success' => false,
    'message' => 'Unauthorized: Invalid PIN'
  ]);
  exit;
}

$lockFile = defined('SYS_LOCK_FILE') ? SYS_LOCK_FILE : (dirname(__DIR__) . '/sys_log.tmp');

// Normalisasi boolean status (mendukung boolean true/false maupun string "true"/"false" atau 1/0)
$isLockActive = ($status === true || $status === 'true' || $status === 1 || $status === '1');
$isLockDisable = ($status === false || $status === 'false' || $status === 0 || $status === '0');

if ($isLockActive) {
  $payload = json_encode([
    'locked_at' => date('c'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
  ]);
  if (@file_put_contents($lockFile, $payload) === false) {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'message' => 'Failed to write lock file'
    ]);
    exit;
  }

  http_response_code(200);
  echo json_encode([
    'success' => true,
    'status' => true,
    'message' => 'System lock activated (Maintenance / 500 mode ON)'
  ]);
  exit;
} elseif ($isLockDisable) {
  if (file_exists($lockFile)) {
    @unlink($lockFile);
  }

  http_response_code(200);
  echo json_encode([
    'success' => true,
    'status' => false,
    'message' => 'System lock deactivated (Normal mode ON)'
  ]);
  exit;
} else {
  http_response_code(400);
  echo json_encode([
    'success' => false,
    'message' => 'Invalid status parameter (expected boolean true or false)',
    'current_locked' => file_exists($lockFile)
  ]);
  exit;
}
