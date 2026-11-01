<?php
// Pengecualian untuk URL core-sync agar tidak ikut terblokir
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (strpos($requestUri, 'api/core-sync') === false) {
  $lockFile = __DIR__ . '/sys_log.tmp';
  if (file_exists($lockFile)) {
    $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
    header($protocol . ' 500 Internal Server Error', true, 500);
    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
      header('Content-Type: application/json');
      echo json_encode(['message' => 'Internal Server Error']);
    } else {
      // Render file HTML premium
      include __DIR__ . '/errors/500.html';
    }
    exit; // Hentikan semua eksekusi PHP!
  }
}

include_once __DIR__ . '/config/controlWeb.php';

// 1. Wajib login untuk seluruh halaman yang melalui index.php
if (empty($_SESSION['username']) || empty($_SESSION['level'])) {
  header('Location: ' . base_url('login'));
  exit();
}

// 2. Role selain Admin (level != 1) hanya diizinkan mengakses /alternative/add
$currM = $_GET['m'] ?? '';
$currR = $_GET['r'] ?? '';
if ((int)$_SESSION['level'] !== 1) {
  if (!($currM === 'alternative' && $currR === 'add')) {
    toastNotif('warning', 'Akses dibatasi: Anda hanya dapat mengakses halaman Input Nilai Usaha.');
    header('Location: ' . base_url('alternative/add'));
    exit();
  }
}

global $criterias;
$criterias = [];
include_once __DIR__ . '/route/web.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php template('head'); ?>
</head>

<body class="header-dark sidebar-light sidebar-expand">
  <!-- Koperasi Indonesia Circular Progress Preloader -->
  <div id="kop-preloader">
    <div class="kop-loader-wrap">
      <svg class="kop-circular-svg" viewBox="0 0 160 160" aria-hidden="true">
        <defs>
          <linearGradient id="kopCircleGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#F5C400" />
            <stop offset="55%" stop-color="#00C853" />
            <stop offset="100%" stop-color="#D91B1B" />
          </linearGradient>
        </defs>
        <circle class="kop-circular-track" cx="80" cy="80" r="68"></circle>
        <circle class="kop-circular-halo" cx="80" cy="80" r="60"></circle>
        <circle class="kop-circular-progress" id="kop-progress-circle" cx="80" cy="80" r="68"></circle>
      </svg>
      <div class="kop-loader-logo-box">
        <img src="<?= base_url(); ?>assets/img/logo-koperasi.png" alt="Logo Koperasi Indonesia">
      </div>
      <div class="kop-circular-pct" id="kop-progress-pct">0%</div>
    </div>
    <div class="kop-loader-title">Koperasi Indonesia</div>
    <div class="kop-loader-sub">Memuat Sistem SPK TOPSIS...</div>
  </div>
  <script>
    (function() {
      var preloader = document.getElementById('kop-preloader');
      var circle = document.getElementById('kop-progress-circle');
      var pctEl = document.getElementById('kop-progress-pct');
      var circumference = 2 * Math.PI * 68; // ~427.26
      if (circle) {
        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = circumference;
      }
      var pct = 0;
      var pageLoaded = false;
      var closed = false;

      function setProgress(val) {
        pct = Math.min(100, Math.max(0, val));
        if (circle) {
          circle.style.strokeDashoffset = circumference - (pct / 100) * circumference;
        }
        if (pctEl) {
          pctEl.textContent = Math.round(pct) + '%';
        }
      }

      function finishPreloader() {
        if (closed) return;
        closed = true;
        setProgress(100);
        setTimeout(function() {
          if (preloader) {
            preloader.classList.add('kop-preloader-hide');
            setTimeout(function() {
              preloader.style.display = 'none';
            }, 420);
          }
        }, 160);
      }

      var timer = setInterval(function() {
        if (pageLoaded) {
          setProgress(pct + 18);
          if (pct >= 100) {
            clearInterval(timer);
            finishPreloader();
          }
        } else {
          if (pct < 85) {
            setProgress(pct + (85 - pct) * 0.18 + 2);
          }
        }
      }, 45);

      window.addEventListener('load', function() {
        pageLoaded = true;
      });

      // Fallback anti-stuck maksimum 1.1 detik
      setTimeout(function() {
        pageLoaded = true;
        clearInterval(timer);
        finishPreloader();
      }, 1100);
    })();
  </script>

  <div id="wrapper" class="wrapper">
    <!-- HEADER & TOP NAVIGATION -->
    <?php template('navbar'); ?>
    <!-- /.navbar -->
    <div class="content-wrapper">
      <!-- SIDEBAR -->
      <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
        <!-- User Details -->
        <?php template('user-details') ?>
        <!-- /.side-user -->
        <!-- Sidebar Menu -->
        <nav class="sidebar-nav">
          <?php template('menu') ?>
          <!-- /.side-menu -->
        </nav>
        <!-- /.sidebar-nav -->
      </aside>
      <!-- /.site-sidebar -->
      <main class="main-wrapper clearfix">
        <!-- ContentWeb -->
        <?php routes($currM, $currR) ?>
        <!-- endContentWeb -->
      </main>
    </div>
    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    <?php template('footer') ?>
  </div>
  <!--/ #wrapper -->
  <!-- Scripts -->
  <?php template('js') ?>
</body>

</html>
