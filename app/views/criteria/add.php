<title>Tambah Kriteria - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Tambah Kriteria</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Input Parameter Penilaian Baru</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>criteria">Data Kriteria</a></li>
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
            <i class="fas fa-plus-circle mr-2" style="color: #00802B;"></i>Formulir Kriteria Penilaian
          </h5>
          <a href="<?= base_url(); ?>criteria" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
          </a>
        </div>
        <div class="widget-body clearfix">
          <form action="<?= base_url(); ?>criteria/actionAdd" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="criteriaId">Kode Kriteria (ID)</label>
                  <input type="text" id="criteriaId" class="form-control" name="id" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Nama Kriteria</label>
                  <input type="text" class="form-control" name="name" placeholder="Contoh: Omset Penjualan" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="value">Bobot Preferensi (Contoh: 0.25)</label>
                  <input type="number" step="0.01" value="0.0" class="form-control" name="value" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="type">Jenis Kriteria</label>
                  <select class="form-control" name="type" required>
                    <option value="benefit">Benefit (Semakin besar semakin layak)</option>
                    <option value="cost">Cost (Semakin kecil semakin layak)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="information">Keterangan / Deskripsi Kriteria</label>
              <textarea class="form-control" name="information" rows="3" placeholder="Penjelasan skala atau satuan kriteria..."></textarea>
            </div>
            <div class="modal-footer pr-0">
              <a href="<?= base_url(); ?>criteria" class="btn btn-secondary mr-2">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Kriteria
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url(); ?>app/views/criteria/js/criteria.js"></script>
