<nav class="navbar">
  <!-- Logo Area -->
  <?php include 'logo.php'; ?>
  <!-- /.navbar-header -->

  <!-- Left Menu & Sidebar Toggle -->
  <ul class="nav navbar-nav">
    <li class="sidebar-toggle">
      <a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
    </li>
  </ul>

  <div class="d-none d-lg-flex align-items-center ml-2">
    <span class="kop-topbar-badge">
      <i class="fas fa-award"></i>
      Sistem Pendukung Keputusan Kelayakan Bantuan UMKM
    </span>
  </div>

  <div class="spacer"></div>

  <!-- Right Action Area -->
  <?php if (!empty($_SESSION['username'])) : ?>
    <?php if ((int)($_SESSION['level'] ?? 0) === 1) : ?>
      <div class="btn-list dropdown d-none d-md-flex mr-3">
        <a href="javascript:void(0);" class="btn btn-primary dropdown-toggle ripple" data-toggle="dropdown">
          <i class="feather feather-plus list-icon"></i> Menu Cepat
        </a>
        <div class="dropdown-menu dropdown-left animated flipInY">
          <span class="dropdown-header">Pintasan Admin</span>
          <a class="dropdown-item" href="<?= base_url(); ?>users/add">
            <i class="fas fa-user-plus mr-2 text-success"></i> Tambah User Baru
          </a>
          <a class="dropdown-item" href="<?= base_url(); ?>criteria/add">
            <i class="fas fa-sliders-h mr-2 text-warning"></i> Tambah Kriteria
          </a>
          <a class="dropdown-item" href="<?= base_url(); ?>alternative/add">
            <i class="fas fa-edit mr-2 text-primary"></i> Input Nilai Alternatif
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url(); ?>topsis/results">
            <i class="fas fa-calculator mr-2 text-danger"></i> Lihat Perhitungan TOPSIS
          </a>
        </div>
      </div>
    <?php endif; ?>

    <?php
    $img = !empty($_SESSION['img']) ? $_SESSION['img'] : 'default.png';
    $profileDiskPath = __DIR__ . '/../../assets/img/profile/' . $img;
    $avatarUrl = is_file($profileDiskPath)
      ? base_url('assets/img/profile/' . rawurlencode($img))
      : base_url('assets/img/logo-koperasi.png');
    $isAdmin = ((int)($_SESSION['level'] ?? 0) === 1);
    $roleLabel = $isAdmin ? 'Administrator' : 'Pelaku UMKM';
    ?>
    <ul class="nav navbar-nav mr-2">
      <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle ripple d-flex align-items-center" data-toggle="dropdown">
          <span class="avatar thumb-xs2 mr-2">
            <img src="<?= htmlspecialchars($avatarUrl); ?>"
              onerror="this.src='<?= base_url(); ?>assets/img/logo-koperasi.png'"
              class="rounded-circle"
              style="border: 2px solid #00802B;"
              alt="">
          </span>
          <span class="d-none d-md-inline-block fw-700 text-dark mr-1"><?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['username']); ?></span>
          <i class="feather feather-chevron-down list-icon text-muted"></i>
        </a>
        <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
          <div class="card">
            <div class="p-3 border-bottom" style="background: #E8F5EC;">
              <div class="fw-700 text-dark"><?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['username']); ?></div>
              <small class="text-success fw-600"><?= $roleLabel; ?></small>
            </div>
            <ul class="list-unstyled card-body mb-0">
              <?php if ($isAdmin) : ?>
                <li>
                  <a href="<?= base_url(); ?>home">
                    <i class="feather feather-home mr-2"></i><span>Dashboard Utama</span>
                  </a>
                </li>
                <li>
                  <a href="<?= base_url(); ?>topsis/results">
                    <i class="feather feather-bar-chart-2 mr-2"></i><span>Hasil Ranking TOPSIS</span>
                  </a>
                </li>
              <?php else : ?>
                <li>
                  <a href="<?= base_url(); ?>alternative/add">
                    <i class="feather feather-edit-3 mr-2"></i><span>Input Nilai Usaha</span>
                  </a>
                </li>
              <?php endif; ?>
              <li>
                <a href="javascript:void(0);" onclick="confirmLogout()" class="text-danger">
                  <i class="feather feather-power mr-2"></i><span>Keluar (Logout)</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  <?php endif; ?>
</nav>
