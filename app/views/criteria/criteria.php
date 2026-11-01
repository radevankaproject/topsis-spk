<?php
require_once __DIR__ . '/../../../config/controlWeb.php';
?>

<title>Data Kriteria - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Data Kriteria</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Parameter & Bobot Penilaian Kelayakan UMKM</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Dashboard</a></li>
      <li class="breadcrumb-item active">Data Kriteria</li>
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
              <i class="fas fa-sliders-h mr-2" style="color: #00802B;"></i>Daftar Kriteria Penilaian TOPSIS
            </h5>
            <small class="text-muted">Kriteria Benefit (semakin tinggi semakin baik) & Cost (semakin rendah semakin baik).</small>
          </div>
          <div class="mt-2 mt-sm-0">
            <?php if (!empty($_SESSION['level']) && $_SESSION['level'] == 1) : ?>
              <a href="<?= base_url(); ?>criteria/add" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Kriteria
              </a>
            <?php endif ?>
          </div>
        </div>

        <div class="widget-body clearfix">
          <div class="table-responsive">
            <table id="tableCriteria" class="table table-bordered table-striped hover">
              <thead>
                <tr>
                  <th style="width: 50px;" class="text-center">#</th>
                  <th style="width: 90px;" class="text-center">Kode ID</th>
                  <th>Nama Kriteria</th>
                  <th style="width: 130px;" class="text-center">Jenis</th>
                  <th style="width: 120px;" class="text-center">Bobot</th>
                  <th>Keterangan</th>
                  <?php if (!empty($_SESSION['level']) && $_SESSION['level'] == 1) : ?>
                    <th style="width: 170px;" class="text-center">Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = "SELECT * FROM criteria";
                $result = $db->query($sql);
                if ($result && $result->num_rows > 0): ?>
                  <?php while ($criteria = $result->fetch_assoc()): ?>
                    <tr>
                      <td class="text-center align-middle"><?= $no++ ?></td>
                      <td class="text-center align-middle">
                        <span class="badge badge-warning px-2 py-1"><?= htmlspecialchars($criteria['criteria_id']); ?></span>
                      </td>
                      <td class="align-middle font-weight-bold" style="color: #181C18;">
                        <?= htmlspecialchars($criteria['criteria_name']); ?>
                      </td>
                      <td class="text-center align-middle">
                        <?php if ($criteria['criteria_type'] == 'cost'): ?>
                          <span class="badge badge-danger"><i class="fas fa-arrow-down mr-1"></i>Cost</span>
                        <?php else: ?>
                          <span class="badge badge-success"><i class="fas fa-arrow-up mr-1"></i>Benefit</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center align-middle">
                        <strong style="color: #064E22; font-size: 14px;"><?= htmlspecialchars($criteria['criteria_value']) ?></strong>
                      </td>
                      <td class="align-middle"><?= htmlspecialchars($criteria['criteria_information']); ?></td>
                      <?php if (!empty($_SESSION['level']) && $_SESSION['level'] == 1) : ?>
                        <td class="text-center align-middle">
                          <a class="btn btn-sm btn-warning edit-user mr-1" href="<?= base_url(); ?>criteria/edit/<?= $criteria['criteria_id']; ?>">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <a href="<?= base_url(); ?>criteria/delete/<?= $criteria['criteria_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus kriteria ini?')">
                            <i class="fa fa-trash"></i> Hapus
                          </a>
                        </td>
                      <?php endif ?>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Belum ada data kriteria.</td>
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
<?php include_once __DIR__ . '/../../../config/jstable.php'; ?>
<script src="<?= base_url(); ?>app/views/criteria/js/criteria.js"></script>
