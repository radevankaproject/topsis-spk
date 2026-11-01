<div class="side-user">
  <div class="col-sm-12 text-center p-0 clearfix">
    <div class="kop-user-card">
      <?php if (empty($_SESSION['username'])) : ?>
        <div class="kop-avatar-wrap">
          <img src="<?= base_url(); ?>assets/img/logo-koperasi.png" alt="Koperasi Indonesia">
        </div>
        <div class="lh-14">
          <a href="<?= base_url(); ?>login" class="hide-menu side-user-heading">Mode Pengunjung</a>
          <span class="hide-menu kop-role-pill">Klik Login</span>
        </div>
      <?php else :
        $img = !empty($_SESSION['img']) ? $_SESSION['img'] : 'default.png';
        $profileDiskPath = __DIR__ . '/../../assets/img/profile/' . $img;
        $avatarUrl = is_file($profileDiskPath)
          ? base_url('assets/img/profile/' . rawurlencode($img))
          : base_url('assets/img/logo-koperasi.png');
        $roleText = (($_SESSION['level'] ?? 0) == 1) ? 'Admin Koperasi' : 'Peserta UMKM';
      ?>
        <div class="kop-avatar-wrap">
          <img src="<?= htmlspecialchars($avatarUrl); ?>"
            onerror="this.src='<?= base_url(); ?>assets/img/logo-koperasi.png'"
            alt="Avatar">
        </div>
        <div class="lh-14">
          <span class="hide-menu side-user-heading"><?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['username']); ?></span>
          <span class="hide-menu kop-role-pill"><?= $roleText; ?></span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
