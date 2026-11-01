<?php
$user_count = $db->query("SELECT COUNT(DISTINCT user_id) FROM alternative")->fetch_row()[0] ?? 0;
$criteria_count = $db->query("SELECT COUNT(*) FROM criteria")->fetch_row()[0] ?? 0;
$last_calc = $db->query("SELECT MAX(calculated_at) FROM ranking")->fetch_row()[0] ?? null;
$top_user = !empty($rankingResults) ? $rankingResults[0]['user_name'] : '-';
$top_score = !empty($rankingResults) ? number_format($rankingResults[0]['score'], 4) : '-';
?>
<title>Dashboard - SPK Koperasi Indonesia</title>

<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Dashboard Utama</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">Ringkasan Penilaian Kelayakan Bantuan UMKM Koperasi</p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Koperasi SPK</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </div>
</div>

<!-- Row 1: 4 KPI Cards Koperasi -->
<div class="row mb-4">
  <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
    <div class="kop-kpi-card kop-kpi-green">
      <div class="kop-kpi-info">
        <div class="kop-kpi-label">Total Peserta UMKM</div>
        <h3 class="kop-kpi-value"><?= htmlspecialchars($user_count); ?></h3>
        <div class="kop-kpi-sub"><i class="fas fa-check-circle text-success mr-1"></i>Telah menginput data alternatif</div>
      </div>
      <div class="kop-kpi-icon">
        <i class="fas fa-users"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
    <div class="kop-kpi-card kop-kpi-gold">
      <div class="kop-kpi-info">
        <div class="kop-kpi-label">Prioritas Utama (#1)</div>
        <h3 class="kop-kpi-value" style="font-size: 19px; line-height: 1.25;"><?= htmlspecialchars($top_user); ?></h3>
        <div class="kop-kpi-sub">Skor Preferensi: <strong style="color: #064E22;"><?= $top_score; ?></strong></div>
      </div>
      <div class="kop-kpi-icon">
        <i class="fas fa-trophy"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 mb-md-0">
    <div class="kop-kpi-card kop-kpi-green">
      <div class="kop-kpi-info">
        <div class="kop-kpi-label">Kriteria Penilaian</div>
        <h3 class="kop-kpi-value"><?= htmlspecialchars($criteria_count); ?></h3>
        <div class="kop-kpi-sub">
          <span class="text-success font-weight-bold"><?= (int)($criteriaTypes['benefit_count'] ?? 0); ?> Benefit</span> &bull;
          <span class="text-danger font-weight-bold"><?= (int)($criteriaTypes['cost_count'] ?? 0); ?> Cost</span>
        </div>
      </div>
      <div class="kop-kpi-icon">
        <i class="fas fa-sliders-h"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="kop-kpi-card kop-kpi-red">
      <div class="kop-kpi-info">
        <div class="kop-kpi-label">Perhitungan Terakhir</div>
        <h3 class="kop-kpi-value" style="font-size: 20px;"><?= $last_calc ? date('d M Y', strtotime($last_calc)) : 'Belum Ada'; ?></h3>
        <div class="kop-kpi-sub"><i class="far fa-clock mr-1"></i><?= $last_calc ? date('H:i', strtotime($last_calc)) . ' WIB' : '-'; ?></div>
      </div>
      <div class="kop-kpi-icon">
        <i class="fas fa-calculator"></i>
      </div>
    </div>
  </div>
</div>

<!-- Row 2: Tabel Peringkat & Grafik Bar -->
<div class="widget-list row">
  <div class="widget-holder widget-full-height widget-flex col-lg-6 mb-4">
    <div class="widget-bg">
      <div class="widget-heading d-flex justify-content-between align-items-center">
        <h4 class="widget-title mb-0">
          <i class="fas fa-medal mr-2" style="color: #D9A400;"></i>Penerima UMKM Teratas
        </h4>
        <?php if (!empty($_SESSION['level']) && $_SESSION['level'] == 1): ?>
          <a href="<?= base_url(); ?>topsis/results" class="btn btn-sm btn-primary">
            Detail TOPSIS <i class="fas fa-arrow-right ml-1"></i>
          </a>
        <?php else: ?>
          <a href="<?= base_url(); ?>criteria" class="btn btn-sm btn-primary">
            Lihat Kriteria <i class="fas fa-arrow-right ml-1"></i>
          </a>
        <?php endif; ?>
      </div>
      <div class="widget-body">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th style="width: 85px;" class="text-center">Peringkat</th>
                <th>Pelaku UMKM</th>
                <th class="text-right">Skor (V)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($rankingResults)): ?>
                <?php foreach ($rankingResults as $result):
                  $rank = (int)$result['rank'];
                  $badgeClass = 'kop-rank-other';
                  if ($rank === 1) $badgeClass = 'kop-rank-1';
                  elseif ($rank === 2) $badgeClass = 'kop-rank-2';
                  elseif ($rank === 3) $badgeClass = 'kop-rank-3';
                  $img = !empty($result['image']) ? $result['image'] : 'default.png';
                ?>
                  <tr>
                    <td class="text-center align-middle">
                      <span class="kop-rank-badge <?= $badgeClass; ?>">
                        <?php if ($rank === 1): ?><i class="fas fa-crown mr-1" style="font-size:10px;"></i><?php endif; ?>
                        #<?= $rank; ?>
                      </span>
                    </td>
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <img class="rounded-circle mr-3"
                          src="<?= base_url(); ?>assets/img/profile/<?= htmlspecialchars($img); ?>"
                          onerror="this.src='<?= base_url(); ?>assets/img/logo-koperasi.png'"
                          alt="Avatar"
                          style="width: 38px; height: 38px; object-fit: cover; border: 2px solid #E2ECE5;">
                        <div>
                          <div class="font-weight-bold" style="color: #181C18;"><?= htmlspecialchars($result['user_name']); ?></div>
                          <small class="text-muted">Peserta UMKM Koperasi</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-right align-middle">
                      <span class="badge badge-success px-2 py-1" style="font-size: 13px;">
                        <?= number_format($result['score'], 4); ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center text-muted py-4">Belum ada data peringkat terhitung.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="widget-holder widget-full-height widget-flex col-lg-6 mb-4">
    <div class="widget-bg">
      <div class="widget-heading">
        <h4 class="widget-title mb-0">
          <i class="fas fa-chart-bar mr-2" style="color: #00802B;"></i>Grafik Skor Preferensi 5 Teratas
        </h4>
      </div>
      <div class="widget-body">
        <div style="height: 290px; position: relative;">
          <canvas id="rankingChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Row 3: Doughnut Charts -->
  <div class="widget-holder widget-full-height widget-flex col-lg-6 mb-4">
    <div class="widget-bg">
      <div class="widget-heading">
        <h4 class="widget-title mb-0">
          <i class="fas fa-chart-pie mr-2" style="color: #D9A400;"></i>Proporsi Bobot Kriteria
        </h4>
      </div>
      <div class="widget-body">
        <div style="height: 270px; position: relative;">
          <canvas id="criteriaWeightChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="widget-holder widget-full-height widget-flex col-lg-6 mb-4">
    <div class="widget-bg">
      <div class="widget-heading">
        <h4 class="widget-title mb-0">
          <i class="fas fa-balance-scale mr-2" style="color: #D91B1B;"></i>Distribusi Jenis Kriteria (Benefit vs Cost)
        </h4>
      </div>
      <div class="widget-body">
        <div style="height: 270px; position: relative;">
          <canvas id="criteriaTypeChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const rankingResults = <?php echo json_encode($rankingResults ?? []); ?>;
    const criteriaInfo = <?php echo json_encode($criteriaInfo ?? []); ?>;
    const criteriaTypes = <?php echo json_encode($criteriaTypes ?? ['benefit_count' => 0, 'cost_count' => 0]); ?>;

    // Palet Resmi Koperasi Indonesia
    const kopPalette = ['#F5C400', '#00802B', '#064E22', '#D91B1B', '#2E9E53', '#D98200'];

    if (rankingResults.length > 0) {
      const rankingLabels = rankingResults.slice(0, 5).map(r => r.user_name);
      const rankingScores = rankingResults.slice(0, 5).map(r => Number(r.score));

      const rankingCtx = document.getElementById('rankingChart').getContext('2d');
      new Chart(rankingCtx, {
        type: 'bar',
        data: {
          labels: rankingLabels,
          datasets: [{
            label: 'Nilai Preferensi (V)',
            data: rankingScores,
            backgroundColor: [
              'rgba(245, 196, 0, 0.88)',
              'rgba(0, 128, 43, 0.85)',
              'rgba(6, 78, 34, 0.85)',
              'rgba(46, 158, 83, 0.82)',
              'rgba(217, 27, 27, 0.82)'
            ],
            borderColor: [
              '#D4A900',
              '#00802B',
              '#064E22',
              '#2E9E53',
              '#D91B1B'
            ],
            borderWidth: 2,
            borderRadius: 8
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              max: 1.0,
              grid: {
                color: '#EBF1EC'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          },
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return 'Skor V: ' + Number(context.parsed.y).toFixed(4);
                }
              }
            }
          }
        }
      });
    }

    if (Object.keys(criteriaInfo).length > 0) {
      const weightLabels = Object.values(criteriaInfo).map(c => c.criteria_name);
      const weightData = Object.values(criteriaInfo).map(c => Number(c.weight));

      const weightCtx = document.getElementById('criteriaWeightChart').getContext('2d');
      new Chart(weightCtx, {
        type: 'doughnut',
        data: {
          labels: weightLabels,
          datasets: [{
            label: 'Bobot Kriteria',
            data: weightData,
            backgroundColor: kopPalette,
            hoverBackgroundColor: kopPalette,
            borderWidth: 2,
            borderColor: '#FFFFFF'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '62%',
          plugins: {
            legend: {
              position: 'bottom'
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.label + ': ' + (context.parsed * 100).toFixed(1) + '%';
                }
              }
            }
          }
        }
      });
    }

    if (criteriaTypes.benefit_count > 0 || criteriaTypes.cost_count > 0) {
      const typeCtx = document.getElementById('criteriaTypeChart').getContext('2d');
      new Chart(typeCtx, {
        type: 'doughnut',
        data: {
          labels: ['Benefit (Semakin Tinggi Semakin Baik)', 'Cost (Semakin Rendah Semakin Baik)'],
          datasets: [{
            label: 'Jumlah Kriteria',
            data: [criteriaTypes.benefit_count, criteriaTypes.cost_count],
            backgroundColor: ['#00802B', '#D91B1B'],
            hoverBackgroundColor: ['#064E22', '#B01212'],
            borderWidth: 2,
            borderColor: '#FFFFFF'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '62%',
          plugins: {
            legend: {
              position: 'bottom'
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.label + ': ' + context.parsed + ' Kriteria';
                }
              }
            }
          }
        }
      });
    }
  });
</script>
