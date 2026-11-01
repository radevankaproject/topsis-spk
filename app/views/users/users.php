<?php
require_once __DIR__ . '/../../../config/controlWeb.php';

if ($_SESSION['level'] != 1) {
  toastNotif('error', 'Anda tidak memiliki akses dihalaman users!');
  echo "<script>window.location='" . base_url() . "home'</script>";
  exit();
}
?>

<title>Manajemen Pengguna - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Data Pengguna</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Kelola Akun Pengurus & Pelaku UMKM Koperasi</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Dashboard</a></li>
      <li class="breadcrumb-item active">Data Pengguna</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-2 pb-3 mb-3 border-bottom">
          <div>
            <h5 class="mb-1" style="color: #064E22; font-weight: 800;">
              <i class="fas fa-users-cog mr-2" style="color: #00802B;"></i>Daftar Pengguna Sistem
            </h5>
            <small class="text-muted">Manajemen hak akses pengurus admin dan peserta UMKM.</small>
          </div>
          <div class="mt-2 mt-sm-0">
            <a href="<?= base_url(); ?>users/add" class="btn btn-primary">
              <i class="fas fa-user-plus mr-1"></i> Tambah Pengguna
            </a>
          </div>
        </div>

        <div class="widget-body clearfix">
          <div class="table-responsive">
            <table id="tableUsers" class="table table-bordered table-striped hover">
              <thead class="text-center">
                <tr>
                  <th style="width: 50px;">#</th>
                  <th>Username</th>
                  <th>Nama Lengkap / UMKM</th>
                  <th>Peran / Level</th>
                  <th>Foto Profil</th>
                  <th>Terdaftar</th>
                  <th style="width: 170px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = "SELECT * FROM users";
                $result = $db->query($sql);
                if ($result && $result->num_rows > 0): ?>
                  <?php while ($user = $result->fetch_assoc()): ?>
                    <tr>
                      <td class="text-center align-middle"><?= $no++; ?></td>
                      <td class="align-middle font-weight-bold"><?= htmlspecialchars($user['username']); ?></td>
                      <td class="align-middle"><?= htmlspecialchars($user['name']); ?></td>
                      <td class="text-center align-middle">
                        <?php if ($user['level'] == 1): ?>
                          <span class="badge badge-primary"><i class="fas fa-user-shield mr-1"></i>Pengurus (Admin)</span>
                        <?php else: ?>
                          <span class="badge badge-success"><i class="fas fa-store mr-1"></i>Pelaku UMKM</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center align-middle">
                        <?php $img = !empty($user['img']) ? $user['img'] : 'default.png'; ?>
                        <figure class="thumb-xs2 mb-0 d-inline-block">
                          <img class="rounded-circle"
                            src="<?= base_url(); ?>assets/img/profile/<?= htmlspecialchars($img); ?>"
                            onerror="this.src='<?= base_url(); ?>assets/img/logo-koperasi.png'"
                            alt="Avatar"
                            style="width: 38px; height: 38px; object-fit: cover; border: 2px solid #F5C400;">
                        </figure>
                      </td>
                      <td class="align-middle"><?= date('d M Y H:i', strtotime($user['created_at'])); ?></td>
                      <td class="text-center align-middle">
                        <a class="btn btn-sm btn-warning edit-user mr-1" href="<?= base_url(); ?>users/edit/<?= $user['user_id']; ?>">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url(); ?>users/delete/<?= $user['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus user ini?')">
                          <i class="fa fa-trash"></i> Hapus
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Belum ada data pengguna.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once __DIR__ . "/../../../config/jstable.php" ?>
<script src="<?= base_url(); ?>app/views/users/js/users.js"></script>
