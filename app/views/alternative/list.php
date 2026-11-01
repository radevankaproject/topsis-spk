<title>Daftar Nilai Alternatif - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Data Alternatif UMKM</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Rekapitulasi Nilai Kriteria Seluruh Peserta UMKM</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Dashboard</a></li>
      <li class="breadcrumb-item active">Daftar Alternatif</li>
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
              <i class="fas fa-clipboard-list mr-2" style="color: #00802B;"></i>Matriks Data Nilai Alternatif Masyarakat
            </h5>
            <small class="text-muted">Data input setiap pelaku UMKM terhadap masing-masing kriteria penilaian.</small>
          </div>
          <div class="mt-2 mt-sm-0 d-flex flex-wrap" style="gap: 8px;">
            <a href="<?= base_url(); ?>alternative/add" class="btn btn-warning">
              <i class="fas fa-plus-circle mr-1"></i> Input / Edit Nilai Alternatif
            </a>
            <a href="<?= base_url(); ?>topsis/results" class="btn btn-primary">
              <i class="fas fa-trophy mr-1" style="color: #FFD700;"></i> Lihat Hasil Peringkat TOPSIS
            </a>
          </div>
        </div>

        <div class="widget-body clearfix">
          <?php if (empty($alternativesList)): ?>
            <div class="alert alert-info" role="alert">
              <i class="fas fa-info-circle mr-2"></i>Belum ada data alternatif yang diinput oleh peserta UMKM.
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table id="tableAlternative" class="table table-bordered table-striped data-table">
                <thead>
                  <tr>
                    <th style="width: 55px;" class="text-center">#</th>
                    <th>Nama Pelaku UMKM / Masyarakat</th>
                    <?php foreach ($criteriaList as $criteria): ?>
                      <th class="text-center"><?= htmlspecialchars($criteria['criteria_name']); ?></th>
                    <?php endforeach; ?>
                    <th style="width: 110px;" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($alternativesList as $userId => $data): ?>
                    <tr>
                      <td class="text-center align-middle"><?= $i++; ?></td>
                      <td class="align-middle font-weight-bold" style="color: #181C18;">
                        <?= htmlspecialchars($data['user_name']); ?>
                      </td>
                      <?php foreach ($criteriaList as $criteria): ?>
                        <td class="text-center align-middle">
                          <span class="font-weight-bold" style="color: #064E22;">
                            <?= htmlspecialchars($data['values'][$criteria['criteria_id']] ?? '-'); ?>
                          </span>
                        </td>
                      <?php endforeach; ?>
                      <td class="text-center align-middle">
                        <a href="<?= base_url(); ?>alternative/add?user_id=<?= (int)$userId; ?>" class="btn btn-sm btn-warning">
                          <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once __DIR__ . "/../../../config/jstable.php" ?>
