<?php
include_once __DIR__ . '/../../config/controlWeb.php';

if (isset($_POST['login'])) {
  if (!check_csrf_token($_POST['csrf_token'] ?? '')) {
    toastNotif('error', 'Token CSRF tidak valid.');
  } elseif (empty($_POST['username']) || empty($_POST['password'])) {
    toastNotif('error', 'Username dan Password wajib diisi.');
  } else {
    $u = $db->real_escape_string(trim($_POST['username']));
    $p = $db->real_escape_string(trim($_POST['password']));
    $q = $db->query("SELECT * FROM users WHERE username='$u'");

    if ($q && $q->num_rows >= 1) {
      $r = $q->fetch_assoc();
      $ph = $r['password'];

      if (password_verify($p, $ph)) {
        $_SESSION['user_id'] = $r['user_id'];
        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['name']     = $r['name'];
        $_SESSION['level']    = $r['level'];
        $_SESSION['img']      = $r['img'];

        toastNotif('success', 'Selamat datang di SPK Koperasi Indonesia');
        if ((int)$r['level'] === 1) {
          header("Location: " . base_url('home'));
        } else {
          header("Location: " . base_url('alternative/add'));
        }
        exit;
      } else {
        toastNotif('error', 'Password Salah!');
      }
    } else {
      toastNotif('error', 'Username tidak ditemukan!');
    }
  }
}

if (!empty($_SESSION['username'])) {
  if ((int)($_SESSION['level'] ?? 0) === 1) {
    header("Location: " . base_url('home'));
  } else {
    header("Location: " . base_url('alternative/add'));
  }
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/logo-koperasi.png">
  <title>Login Sistem &mdash; SPK Koperasi Indonesia</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    :root {
      --kop-green-deep: #043817;
      --kop-green-dark: #064E22;
      --kop-green: #00802B;
      --kop-green-soft: #E8F5EC;
      --kop-gold: #F5C400;
      --kop-gold-bright: #FFD700;
      --kop-red: #D91B1B;
      --kop-dark: #181C18;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto Slab', serif;
      min-height: 100vh;
      background: radial-gradient(circle at top left, #085e29 0%, #043817 55%, #02220d 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      position: relative;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, var(--kop-green) 0%, var(--kop-gold) 50%, var(--kop-red) 100%);
      z-index: 10;
    }

    .kop-login-shell {
      width: 100%;
      max-width: 960px;
      background: #FFFFFF;
      border-radius: 22px;
      overflow: hidden;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.42);
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      border: 1px solid rgba(245, 196, 0, 0.35);
    }

    /* Left Branding Panel */
    .kop-login-banner {
      background: linear-gradient(155deg, #064E22 0%, #00802B 52%, #043817 100%);
      color: #FFFFFF;
      padding: 46px 40px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }

    .kop-login-banner::after {
      content: '';
      position: absolute;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245, 196, 0, 0.22) 0%, transparent 70%);
      bottom: -90px;
      right: -80px;
      pointer-events: none;
    }

    .kop-banner-top {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .kop-banner-badge {
      background: rgba(245, 196, 0, 0.18);
      border: 1px solid var(--kop-gold);
      color: var(--kop-gold-bright);
      padding: 5px 14px;
      border-radius: 50px;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.7px;
      text-transform: uppercase;
    }

    .kop-banner-center {
      text-align: center;
      margin: 28px 0;
    }

    .kop-logo-circle {
      width: 132px;
      height: 132px;
      margin: 0 auto 20px;
      background: #FFFFFF;
      border-radius: 26px;
      padding: 12px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
      border: 3px solid var(--kop-gold);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .kop-logo-circle img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .kop-banner-title {
      font-size: 24px;
      font-weight: 800;
      letter-spacing: 0.4px;
      margin-bottom: 10px;
      color: #FFFFFF;
    }

    .kop-banner-desc {
      font-size: 13.5px;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.86);
    }

    .kop-pillars {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 18px;
    }

    .kop-pillar {
      background: rgba(0, 0, 0, 0.24);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      padding: 8px 13px;
      font-size: 12px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .kop-pillar i {
      color: var(--kop-gold-bright);
    }

    .kop-banner-footer {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.7);
      text-align: center;
      border-top: 1px solid rgba(255, 255, 255, 0.12);
      padding-top: 14px;
    }

    /* Right Form Panel */
    .kop-login-form-area {
      padding: 48px 42px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #FFFFFF;
    }

    .kop-form-header {
      margin-bottom: 28px;
    }

    .kop-form-header h2 {
      font-size: 24px;
      font-weight: 800;
      color: var(--kop-green-dark);
      margin-bottom: 6px;
    }

    .kop-form-header p {
      font-size: 13.5px;
      color: #607064;
    }

    .kop-field {
      margin-bottom: 18px;
    }

    .kop-field label {
      display: block;
      font-size: 13px;
      font-weight: 700;
      color: var(--kop-green-dark);
      margin-bottom: 7px;
    }

    .kop-input-group {
      position: relative;
    }

    .kop-input-group i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #607064;
      font-size: 15px;
      transition: color 0.2s;
    }

    .kop-input-group input {
      width: 100%;
      padding: 12px 14px 12px 42px;
      border: 1.5px solid #DCE6DF;
      border-radius: 10px;
      font-size: 14px;
      font-family: inherit;
      color: var(--kop-dark);
      background: #F9FCFA;
      transition: all 0.2s ease;
    }

    .kop-input-group input:focus {
      outline: none;
      background: #FFFFFF;
      border-color: var(--kop-green);
      box-shadow: 0 0 0 4px rgba(0, 128, 43, 0.12);
    }

    .kop-input-group input:focus + i,
    .kop-input-group:focus-within i {
      color: var(--kop-green);
    }

    .kop-btn-submit {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--kop-green) 0%, var(--kop-green-dark) 100%);
      color: #FFFFFF;
      font-family: inherit;
      font-size: 14.5px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(0, 128, 43, 0.28);
      transition: all 0.2s ease;
      margin-top: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .kop-btn-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 22px rgba(0, 128, 43, 0.36);
    }

    .kop-divider {
      margin: 20px 0;
      border-top: 1px solid #E6EFE9;
      position: relative;
      text-align: center;
    }

    .kop-btn-back {
      width: 100%;
      padding: 11px;
      border: 1.5px solid var(--kop-green);
      border-radius: 10px;
      background: var(--kop-green-soft);
      color: var(--kop-green-dark);
      font-family: inherit;
      font-size: 13.5px;
      font-weight: 700;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s ease;
    }

    .kop-btn-back:hover {
      background: var(--kop-green);
      color: #FFFFFF;
    }

    @media (max-width: 768px) {
      .kop-login-shell {
        grid-template-columns: 1fr;
      }
      .kop-login-banner {
        padding: 32px 24px;
      }
      .kop-login-form-area {
        padding: 32px 24px;
      }
    }

    /* Preloader Login - Circular Progress around Logo */
    #kop-preloader {
      position: fixed;
      inset: 0;
      z-index: 999999;
      background: radial-gradient(circle at center, #145A32 0%, #063B1B 65%, #03220F 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    #kop-preloader.kop-preloader-hide {
      opacity: 0 !important;
      visibility: hidden !important;
      pointer-events: none !important;
    }

    .kop-loader-wrap {
      position: relative;
      width: 164px;
      height: 164px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 22px;
    }

    .kop-circular-svg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      transform: rotate(-90deg);
      filter: drop-shadow(0 0 12px rgba(245, 196, 0, 0.35));
    }

    .kop-circular-track {
      fill: none;
      stroke: rgba(255, 255, 255, 0.14);
      stroke-width: 7;
    }

    .kop-circular-halo {
      fill: none;
      stroke: rgba(245, 196, 0, 0.25);
      stroke-width: 2;
      stroke-dasharray: 6 6;
      transform-origin: 80px 80px;
      animation: kopSpinHalo 6s linear infinite;
    }

    .kop-circular-progress {
      fill: none;
      stroke: url(#kopCircleGrad);
      stroke-width: 7;
      stroke-linecap: round;
      stroke-dasharray: 427.26;
      stroke-dashoffset: 427.26;
      transition: stroke-dashoffset 0.08s linear;
    }

    .kop-loader-logo-box {
      width: 104px;
      height: 104px;
      border-radius: 50%;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 12px;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.4), inset 0 0 0 2px rgba(245, 196, 0, 0.45);
      animation: kopPulseLogo 1.8s ease-in-out infinite;
      z-index: 2;
    }

    .kop-loader-logo-box img {
      width: 100%;
      height: 100%;
      max-width: 80px;
      max-height: 80px;
      object-fit: contain;
    }

    .kop-circular-pct {
      position: absolute;
      bottom: -8px;
      background: linear-gradient(135deg, #F5C400 0%, #D99B00 100%);
      color: #063B1B;
      font-size: 11.5px;
      font-weight: 800;
      padding: 2px 10px;
      border-radius: 99px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
      z-index: 3;
      letter-spacing: 0.5px;
    }

    .kop-loader-title {
      font-size: 16px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      margin-bottom: 4px;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    .kop-loader-sub {
      font-size: 12.5px;
      font-weight: 500;
      color: #FFE066;
      opacity: 0.92;
    }

    @keyframes kopSpinHalo {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    @keyframes kopPulseLogo {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.04); }
    }
  </style>
</head>

<body>
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
    <div class="kop-loader-sub">Memuat Halaman Login...</div>
  </div>
  <script>
    (function() {
      var preloader = document.getElementById('kop-preloader');
      var circle = document.getElementById('kop-progress-circle');
      var pctEl = document.getElementById('kop-progress-pct');
      var circumference = 2 * Math.PI * 68;
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
        }, 150);
      }

      var timer = setInterval(function() {
        if (pageLoaded) {
          setProgress(pct + 20);
          if (pct >= 100) {
            clearInterval(timer);
            finishPreloader();
          }
        } else if (pct < 85) {
          setProgress(pct + (85 - pct) * 0.2 + 2);
        }
      }, 40);

      window.addEventListener('load', function() {
        pageLoaded = true;
      });

      setTimeout(function() {
        pageLoaded = true;
        clearInterval(timer);
        finishPreloader();
      }, 1000);
    })();
  </script>

  <div class="kop-login-shell">
    <!-- Left Koperasi Branding -->
    <div class="kop-login-banner">
      <div class="kop-banner-top">
        <span class="kop-banner-badge"><i class="fas fa-star mr-1"></i> Koperasi Indonesia</span>
      </div>

      <div class="kop-banner-center">
        <div class="kop-logo-circle">
          <img src="<?= base_url(); ?>assets/img/logo-koperasi.png" alt="Logo Koperasi Indonesia">
        </div>
        <h1 class="kop-banner-title">SPK BANTUAN UMKM</h1>
        <p class="kop-banner-desc">
          Sistem Pendukung Keputusan Penentuan Kelayakan Penerima Bantuan Usaha Mikro Kecil Menengah Menggunakan Metode <strong>TOPSIS</strong>.
        </p>

        <div class="kop-pillars">
          <div class="kop-pillar"><i class="fas fa-balance-scale"></i> Keadilan</div>
          <div class="kop-pillar"><i class="fas fa-tree"></i> Kemakmuran</div>
          <div class="kop-pillar"><i class="fas fa-chart-line"></i> Objektif</div>
        </div>
      </div>

      <div class="kop-banner-footer">
        &copy; <?= date('Y'); ?> Koperasi Indonesia &bull; Metode TOPSIS
      </div>
    </div>

    <!-- Right Login Form -->
    <div class="kop-login-form-area">
      <div class="kop-form-header">
        <h2>Selamat Datang</h2>
        <p>Silakan masuk menggunakan akun Admin atau Peserta UMKM Anda.</p>
      </div>

      <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">

        <div class="kop-field">
          <label for="username">Username</label>
          <div class="kop-input-group">
            <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autofocus>
            <i class="fas fa-user"></i>
          </div>
        </div>

        <div class="kop-field">
          <label for="password">Password</label>
          <div class="kop-input-group">
            <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            <i class="fas fa-lock"></i>
          </div>
        </div>

        <button class="kop-btn-submit" type="submit" name="login">
          <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
        </button>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    function hideKopPreloader() {
      var preloader = document.getElementById('kop-preloader');
      if (preloader) preloader.classList.add('kop-preloader-hide');
    }
    window.addEventListener('load', function() {
      setTimeout(hideKopPreloader, 250);
    });
    setTimeout(hideKopPreloader, 1000);

    $(document).ready(function() {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };

      <?php if (isset($_SESSION['toast_notifications'])): ?>
        <?php foreach ($_SESSION['toast_notifications'] as $notification): ?>
          toastr.<?= $notification['type'] ?>('<?= addslashes($notification['message']) ?>');
        <?php endforeach; ?>
        <?php unset($_SESSION['toast_notifications']); ?>
      <?php endif; ?>
    });
  </script>
</body>

</html>
