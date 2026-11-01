<?php
// app/views/topsis/results.php
?>

<title>Hasil Perhitungan TOPSIS - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Hasil Perhitungan TOPSIS</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Peringkat Kelayakan & Tahapan Matriks SPK Koperasi</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Dashboard</a></li>
      <li class="breadcrumb-item active">Hasil TOPSIS</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="widget-body clearfix">
          <?php if (isset($topsisData['error'])): ?>
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-triangle mr-2"></i>Error: <?= htmlspecialchars($topsisData['error']); ?>
            </div>
          <?php elseif (empty($rankingResults)): ?>
            <div class="alert alert-info" role="alert">
              <i class="fas fa-info-circle mr-2"></i>Belum ada data alternatif untuk dihitung atau tidak ada kriteria.
            </div>
          <?php else: ?>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-3 border-bottom">
              <div>
                <h4 class="mb-1" style="color: #064E22; font-weight: 800;">
                  <i class="fas fa-trophy mr-2" style="color: #F5C400;"></i>Peringkat Kelayakan Penerima Bantuan UMKM
                </h4>
                <p class="text-muted mb-0" style="font-size: 13px;">
                  Urutan prioritas pelaku UMKM berdasarkan nilai preferensi akhir ($V_i$) tertinggi.
                </p>
              </div>
              <span class="badge badge-success px-3 py-2 mt-2 mt-sm-0" style="font-size: 12.5px;">
                <i class="fas fa-check-circle mr-1"></i>Total Dinilai: <?= count($rankingResults); ?> UMKM
              </span>
            </div>

            <div class="table-responsive mb-5">
              <table id="tableResults" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 110px;" class="text-center">Peringkat</th>
                    <th>Nama Pelaku UMKM / Masyarakat</th>
                    <th style="width: 220px;">Nilai Preferensi (V)</th>
                    <th style="width: 160px;" class="text-center">Status Rekomendasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rankingResults as $result):
                    $rank = (int)$result['rank'];
                    $badgeClass = 'kop-rank-other';
                    if ($rank === 1) $badgeClass = 'kop-rank-1';
                    elseif ($rank === 2) $badgeClass = 'kop-rank-2';
                    elseif ($rank === 3) $badgeClass = 'kop-rank-3';
                  ?>
                    <tr>
                      <td class="text-center align-middle">
                        <span class="kop-rank-badge <?= $badgeClass; ?>">
                          <?php if ($rank === 1): ?><i class="fas fa-crown mr-1" style="font-size:10px;"></i><?php endif; ?>
                          #<?= $rank; ?>
                        </span>
                      </td>
                      <td class="align-middle font-weight-bold" style="color: #181C18;">
                        <?= htmlspecialchars($result['user_name']); ?>
                      </td>
                      <td class="align-middle">
                        <span class="font-weight-bold" style="color: #064E22; font-size: 14px;">
                          <?= number_format($result['score'], 4); ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <?php if ($rank <= 3): ?>
                          <span class="badge badge-success"><i class="fas fa-star mr-1"></i>Prioritas Utama</span>
                        <?php else: ?>
                          <span class="badge badge-secondary">Cadangan</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="mb-3">
              <h4 style="color: #064E22; font-weight: 800;">
                <i class="fas fa-layer-group mr-2" style="color: #00802B;"></i>Tahapan Detail Perhitungan Metode TOPSIS
              </h4>
              <p class="text-muted" style="font-size: 13px;">
                Transparansi proses perhitungan matematis dari matriks keputusan awal hingga nilai preferensi.
              </p>
            </div>

            <?php
            $criteriaHeaders = [];
            if (!empty($criteriaInfo)) {
              foreach ($criteriaInfo as $criteriaId => $info) {
                $criteriaHeaders[$criteriaId] = $info['criteria_name'];
              }
            } elseif (!empty($idealPositive)) {
              foreach ($idealPositive as $criteriaId => $value) {
                $criteriaHeaders[$criteriaId] = $criteriaId;
              }
            }
            ?>

            <!-- Tahap 1 -->
            <div class="kop-step-card">
              <div class="kop-step-header">
                <span class="kop-step-num">1</span>
                <h5>Matriks Keputusan Awal (X)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-3">Nilai input asli dari setiap pelaku UMKM pada masing-masing kriteria penilaian.</p>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Pelaku UMKM</th>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <th><?= htmlspecialchars($cname); ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($allUsersData as $userData): ?>
                        <?php $userId = $userData['user_id']; ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($userData['user_name']); ?></td>
                          <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                            <td><?= number_format($topsisData['detailMatrices']['matrix'][$userId][$cid] ?? 0, 2); ?></td>
                          <?php endforeach; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tahap 2 -->
            <div class="kop-step-card">
              <div class="kop-step-header">
                <span class="kop-step-num">2</span>
                <h5>Matriks Normalisasi (R)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-2">Normalisasi Euclidean untuk menyamakan skala nilai antar kriteria:</p>
                <div class="formula">
                  $$r_{ij} = \frac{x_{ij}}{\sqrt{\sum_{i=1}^{m} x_{ij}^2}}$$
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Pelaku UMKM</th>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <th><?= htmlspecialchars($cname); ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($allUsersData as $userData): ?>
                        <?php $userId = $userData['user_id']; ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($userData['user_name']); ?></td>
                          <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                            <td><?= number_format($detailMatrices['normalizedMatrix'][$userId][$cid] ?? 0, 4); ?></td>
                          <?php endforeach; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tahap 3 -->
            <div class="kop-step-card">
              <div class="kop-step-header">
                <span class="kop-step-num">3</span>
                <h5>Matriks Normalisasi Terbobot (Y)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-2">Matriks normalisasi dikalikan dengan bobot preferensi kriteria ($w_j$):</p>
                <div class="formula">
                  $$y_{ij} = w_j \cdot r_{ij}$$
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Pelaku UMKM</th>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <th><?= htmlspecialchars($cname); ?> (Bobot: <?= number_format($criteriaInfo[$cid]['weight'] ?? 0, 2); ?>)</th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($allUsersData as $userData): ?>
                        <?php $userId = $userData['user_id']; ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($userData['user_name']); ?></td>
                          <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                            <td><?= number_format($detailMatrices['weightedNormalizedMatrix'][$userId][$cid] ?? 0, 4); ?></td>
                          <?php endforeach; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tahap 4 -->
            <div class="kop-step-card">
              <div class="kop-step-header">
                <span class="kop-step-num">4</span>
                <h5>Solusi Ideal Positif ($A^+$) dan Solusi Ideal Negatif ($A^-$)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-3">
                  $A^+$ adalah nilai terbaik tiap kriteria, sedangkan $A^-$ adalah nilai terburuk berdasarkan jenis kriteria (Benefit/Cost).
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Solusi Ideal</th>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <th><?= htmlspecialchars($cname); ?> (<?= strtoupper(htmlspecialchars($criteriaInfo[$cid]['type'] ?? '')); ?>)</th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="font-weight-bold text-success">Solusi Ideal Positif ($A^+$)</td>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <td class="font-weight-bold"><?= number_format($idealPositive[$cid] ?? 0, 4); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td class="font-weight-bold text-danger">Solusi Ideal Negatif ($A^-$)</td>
                        <?php foreach ($criteriaHeaders as $cid => $cname): ?>
                          <td class="font-weight-bold"><?= number_format($idealNegative[$cid] ?? 0, 4); ?></td>
                        <?php endforeach; ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tahap 5 -->
            <div class="kop-step-card">
              <div class="kop-step-header">
                <span class="kop-step-num">5</span>
                <h5>Jarak Solusi Ideal Positif ($D_i^+$) dan Negatif ($D_i^-$)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-2">Perhitungan jarak Euclidean setiap alternatif terhadap solusi ideal positif dan negatif:</p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="formula">
                      $$D_i^+ = \sqrt{\sum_{j=1}^{n} (A_j^+ - y_{ij})^2}$$
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="formula">
                      $$D_i^- = \sqrt{\sum_{j=1}^{n} (A_j^- - y_{ij})^2}$$
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Pelaku UMKM</th>
                        <th>Jarak Ideal Positif ($D_i^+$)</th>
                        <th>Jarak Ideal Negatif ($D_i^-$)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($allUsersData as $userData): ?>
                        <?php $userId = $userData['user_id']; ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($userData['user_name']); ?></td>
                          <td><?= number_format($detailMatrices['distancePositive'][$userId] ?? 0, 4); ?></td>
                          <td><?= number_format($detailMatrices['distanceNegative'][$userId] ?? 0, 4); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tahap 6 -->
            <div class="kop-step-card mb-0">
              <div class="kop-step-header">
                <span class="kop-step-num">6</span>
                <h5>Nilai Preferensi Akhir ($V_i$)</h5>
              </div>
              <div class="kop-step-body">
                <p class="text-muted mb-2">Kedekatan relatif setiap alternatif terhadap solusi ideal positif:</p>
                <div class="formula">
                  $$V_i = \frac{D_i^-}{D_i^- + D_i^+}$$
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Pelaku UMKM</th>
                        <th>Nilai Preferensi ($V_i$)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rankingResults as $result): ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($result['user_name']); ?></td>
                          <td><span class="badge badge-success px-2 py-1"><?= number_format($result['score'], 4); ?></span></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .formula {
    font-family: serif;
    font-size: 1.08em;
    background-color: #F4F9F5;
    padding: 10px 16px;
    border-left: 4px solid #00802B;
    border-radius: 6px;
    margin-bottom: 16px;
    overflow-x: auto;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
  window.MathJax = {
    tex: {
      inlineMath: [
        ['$', '$'],
        ['\\(', '\\)']
      ]
    },
    svg: {
      fontCache: 'global'
    }
  };
</script>
<?php include_once __DIR__ . '/../../../config/jstable.php' ?>
