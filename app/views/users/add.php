<title>Tambah Pengguna - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Tambah Pengguna</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Registrasi Pengurus atau Peserta UMKM Baru</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>users">Data Pengguna</a></li>
      <li class="breadcrumb-item active">Tambah Baru</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="widget-heading border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0" style="color: #064E22; font-weight: 800;">
            <i class="fas fa-user-plus mr-2" style="color: #00802B;"></i>Formulir Pengguna Baru
          </h5>
          <a href="<?= base_url(); ?>users" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
          </a>
        </div>
        <div class="widget-body clearfix">
          <form action="<?= base_url(); ?>users/actionAdd" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username unik" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password akun" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Nama Lengkap / Nama Usaha UMKM</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Budi Santoso" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="level">Peran Akses (Level)</label>
                  <select class="form-control" id="level" name="level" required>
                    <option value="2">Pelaku UMKM / Masyarakat</option>
                    <option value="1">Pengurus / Admin Koperasi</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Foto Profil (Opsional)</label>
              <div class="drag-drop-area" id="imageDragDropArea">
                <input type="file" name="image" id="imageUploadInput" accept="image/*" class="d-none">
                <p class="text-muted mb-2">Seret dan lepas gambar di sini, atau</p>
                <button type="button" class="btn btn-primary btn-sm" id="browseImageButton">
                  <i class="fas fa-upload mr-1"></i> Pilih Gambar
                </button>
                <img id="imagePreview" class="preview-image mt-3" src="#" alt="Image Preview" style="display: none;">
                <div id="fileInfo" class="mt-2 text-center" style="display: none;">
                  <p class="mb-0 text-muted" id="fileName"></p>
                  <p class="mb-0 text-muted" id="fileSize"></p>
                </div>
                <i class="feather feather-x-circle clear-image-icon" style="display: none;" title="Hapus Gambar"></i>
              </div>
            </div>
            <div class="modal-footer pr-0">
              <a href="<?= base_url(); ?>users" class="btn btn-secondary mr-2">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Pengguna
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
