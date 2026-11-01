<?php
$id = $_GET['id'];
$query = "SELECT * FROM criteria WHERE criteria_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$criteria = $result->fetch_assoc();
$stmt->close();
?>
<title>Edit Kriteria - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Edit Kriteria</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Perbarui Parameter & Bobot Penilaian</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>criteria">Data Kriteria</a></li>
      <li class="breadcrumb-item active">Edit Kriteria</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="widget-heading border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0" style="color: #064E22; font-weight: 800;">
            <i class="fas fa-edit mr-2" style="color: #F5C400;"></i>Edit Kriteria: <?= htmlspecialchars($criteria['criteria_name'] ?? ''); ?>
          </h5>
          <a href="<?= base_url(); ?>criteria" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
          </a>
        </div>
        <div class="widget-body clearfix">
          <form action="<?= base_url(); ?>criteria/actionEdit/<?= $criteria['criteria_id']; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="criteriaId">Kode Kriteria (ID)</label>
                  <input type="text" id="criteriaId" value="<?= htmlspecialchars($criteria['criteria_id']); ?>" class="form-control" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Nama Kriteria</label>
                  <input type="text" class="form-control" value="<?= htmlspecialchars($criteria['criteria_name']); ?>" name="name" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="value">Bobot Preferensi</label>
                  <input type="number" step="0.01" value="<?= htmlspecialchars($criteria['criteria_value']); ?>" class="form-control" name="value" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="type">Jenis Kriteria</label>
                  <select class="form-control" name="type" required>
                    <?php $type = ['cost' => 'Cost (Semakin kecil semakin layak)', 'benefit' => 'Benefit (Semakin besar semakin layak)']; ?>
                    <option value="<?= htmlspecialchars($criteria['criteria_type']); ?>"><?= $type[$criteria['criteria_type']]; ?> (Saat Ini)</option>
                    <option value="benefit">Benefit (Semakin besar semakin layak)</option>
                    <option value="cost">Cost (Semakin kecil semakin layak)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="information">Keterangan / Deskripsi Kriteria</label>
              <textarea class="form-control" name="information" rows="3"><?= htmlspecialchars($criteria['criteria_information']); ?></textarea>
            </div>
            <div class="modal-footer pr-0">
              <a href="<?= base_url(); ?>criteria" class="btn btn-secondary mr-2">Batal</a>
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
<script src="<?= base_url(); ?>app/views/criteria/js/criteria.js"></script>
