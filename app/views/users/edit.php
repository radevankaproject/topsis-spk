<?php
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<title>Edit Pengguna - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Edit Pengguna</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Perbarui Data Pengurus atau Peserta UMKM</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>users">Data Pengguna</a></li>
      <li class="breadcrumb-item active">Edit Pengguna</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="widget-heading border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0" style="color: #064E22; font-weight: 800;">
            <i class="fas fa-user-edit mr-2" style="color: #F5C400;"></i>Edit Data: <?= htmlspecialchars($user['name'] ?? ''); ?>
          </h5>
          <a href="<?= base_url(); ?>users" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
          </a>
        </div>
        <div class="widget-body clearfix">
          <form id="editUserForm" action="<?= base_url(); ?>users/actionEdit/<?= $user['user_id']; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password Baru <small class="text-muted">(Opsional)</small></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Nama Lengkap / Nama Usaha UMKM</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="level">Peran Akses (Level)</label>
                  <?php $level = ['1' => 'Pengurus / Admin Koperasi', '2' => 'Pelaku UMKM / Masyarakat']; ?>
                  <select class="form-control" id="level" name="level" required>
                    <option value="<?= $user['level']; ?>"><?= $level[$user['level']]; ?> (Saat Ini)</option>
                    <option value="1">Pengurus / Admin Koperasi</option>
                    <option value="2">Pelaku UMKM / Masyarakat</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Foto Profil</label>
              <div class="drag-drop-area" id="imageDragDropArea">
                <input type="file" name="image" id="imageUploadInput" accept="image/*" class="d-none">
                <p class="text-muted mb-2 initial-text">Seret dan lepas gambar di sini, atau</p>
                <button type="button" class="btn btn-primary btn-sm" id="browseImageButton">
                  <i class="fas fa-upload mr-1"></i> Pilih Gambar
                </button>
                <img id="imagePreview" class="preview-image mt-3" src="#" alt="Image Preview" style="display: none;">
                <div id="fileInfo" class="mt-2 text-center" style="display: none;">
                  <p class="mb-0 text-muted" id="fileName"></p>
                  <p class="mb-0 text-muted" id="fileSize"></p>
                </div>
                <i class="feather feather-x-circle clear-image-icon" style="display: none;" title="Hapus Gambar"></i>
                <small class="text-muted mt-2 max-size-text">Ukuran maks: 2MB</small>
              </div>

              <?php if (isset($user['img']) && !empty($user['img'])) : ?>
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($user['img']); ?>">
                <img src="<?= base_url('assets/img/profile/' . $user['img']); ?>"
                  onerror="this.src='<?= base_url('assets/img/logo-koperasi.png'); ?>'"
                  alt="Current Profile Image"
                  class="current-profile-image mt-2"
                  style="max-width: 120px; display: block;">
                <small class="text-muted current-image-label">Foto profil saat ini.</small>
              <?php endif; ?>
            </div>
            <div class="modal-footer pr-0">
              <a href="<?= base_url(); ?>users" class="btn btn-secondary mr-2">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>app/views/users/js/users.js"></script>
<script src="<?= base_url(); ?>app/views/users/js/imgUploads.js"></script>
