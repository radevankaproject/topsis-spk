<?php
$isAdmin = ((int)($_SESSION['level'] ?? 0) === 1);
$usersList = [];
$allExistingValues = [];

if ($isAdmin) {
  $resUsers = $db->query("SELECT user_id, username, name, level FROM users ORDER BY level DESC, name ASC");
  if ($resUsers) {
    while ($u = $resUsers->fetch_assoc()) {
      $usersList[] = $u;
    }
  }

  $resAltAll = $db->query("SELECT user_id, criteria_id, alternative_value FROM alternative");
  if ($resAltAll) {
    while ($a = $resAltAll->fetch_assoc()) {
      $allExistingValues[(int)$a['user_id']][$a['criteria_id']] = $a['alternative_value'];
    }
  }
}

$selected_user_id = (int)($_SESSION['user_id'] ?? 0);
if ($isAdmin) {
  if (!empty($_GET['user_id'])) {
    $selected_user_id = (int)$_GET['user_id'];
  } elseif (!empty($usersList)) {
    $selected_user_id = (int)$usersList[0]['user_id'];
  }
}
?>
<title>Input Nilai Alternatif - SPK Koperasi Indonesia</title>
<div class="row page-title clearfix">
  <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">Input Data Alternatif UMKM</h6>
    <p class="page-title-description mr-0 d-none d-md-inline-block">
      <?= $isAdmin ? 'Input atau Perbarui Nilai Kriteria Peserta UMKM' : 'Formulir Pengisian Data Kriteria Usaha Anda'; ?>
    </p>
  </div>
  <div class="page-title-right d-none d-sm-inline-flex">
    <ol class="breadcrumb">
      <?php if ($isAdmin): ?>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>alternative">Data Alternatif</a></li>
      <?php else: ?>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>alternative/add">Pelaku UMKM</a></li>
      <?php endif; ?>
      <li class="breadcrumb-item active">Input Nilai Usaha</li>
    </ol>
  </div>
</div>

<div class="widget-list">
  <div class="row">
    <div class="col-md-12 widget-holder">
      <div class="widget-bg">
        <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-3">
          <div>
            <h5 class="mb-1" style="color: #064E22; font-weight: 800;">
              <i class="fas fa-edit mr-2" style="color: #00802B;"></i>Formulir Data Usaha Pelaku UMKM
            </h5>
            <small class="text-muted">
              <?= $isAdmin ? 'Pilih peserta UMKM lalu isi atau perbarui nilai pada setiap kriteria.' : 'Lengkapi nilai pada setiap kriteria sesuai kondisi usaha Anda secara jujur dan akurat.'; ?>
            </small>
          </div>
          <?php if ($isAdmin): ?>
            <div class="mt-2 mt-sm-0">
              <a href="<?= base_url(); ?>alternative" class="btn btn-warning">
                <i class="fas fa-clipboard-list mr-1"></i> Lihat Tabel Rekap Alternatif
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div class="widget-body clearfix">
          <form action="<?= base_url(); ?>alternative/save" method="post">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">

            <?php if (empty($criterias)): ?>
              <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>Belum ada kriteria yang ditambahkan oleh pengurus. Silakan hubungi pengurus Koperasi.
              </div>
            <?php else: ?>
              <?php
              $existing_alternative_values = [];
              if ($selected_user_id) {
                $stmt_alt = $db->prepare("SELECT criteria_id, alternative_value FROM alternative WHERE user_id = ?");
                $stmt_alt->bind_param("i", $selected_user_id);
                $stmt_alt->execute();
                $result_alt = $stmt_alt->get_result();
                while ($row_alt = $result_alt->fetch_assoc()) {
                  $existing_alternative_values[$row_alt['criteria_id']] = $row_alt['alternative_value'];
                }
                $stmt_alt->close();
              }
              ?>

              <?php if ($isAdmin): ?>
                <div class="p-3 mb-4 rounded" style="background: #E8F5EC; border: 1px solid #C5E2CE;">
                  <div class="form-group mb-0">
                    <label for="target_user_id" class="mb-2" style="font-size: 14px;">
                      <i class="fas fa-user-check mr-1 text-success"></i> Pilih Peserta UMKM / Pengguna yang Akan Diinput:
                    </label>
                    <select name="target_user_id" id="target_user_id" class="form-control" required>
                      <?php foreach ($usersList as $u):
                        $uid = (int)$u['user_id'];
                        $hasData = !empty($allExistingValues[$uid]);
                        $roleBadge = ((int)$u['level'] === 1) ? 'Admin' : 'Peserta UMKM';
                      ?>
                        <option value="<?= $uid; ?>" <?= ($uid === $selected_user_id) ? 'selected' : ''; ?>>
                          <?= htmlspecialchars($u['name']); ?> (@<?= htmlspecialchars($u['username']); ?> - <?= $roleBadge; ?>) <?= $hasData ? '✓ [Sudah Ada Nilai]' : '[Belum Input]'; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              <?php endif; ?>

              <div class="row">
                <?php foreach ($criterias as $criteria): ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="<?= htmlspecialchars($criteria['criteria_id']); ?>">
                        <span class="badge badge-warning mr-1"><?= htmlspecialchars($criteria['criteria_id']); ?></span>
                        <?= htmlspecialchars($criteria['criteria_name']); ?>
                        <small class="text-muted d-block mt-1 font-weight-normal">
                          <i class="fas fa-info-circle mr-1"></i><?= htmlspecialchars($criteria['criteria_information']); ?>
                        </small>
                      </label>
                      <input type="text" class="form-control kop-criteria-input"
                        id="<?= htmlspecialchars($criteria['criteria_id']); ?>"
                        name="<?= htmlspecialchars($criteria['criteria_id']); ?>"
                        value="<?= htmlspecialchars($existing_alternative_values[$criteria['criteria_id']] ?? ''); ?>"
                        placeholder="Masukkan nilai <?= htmlspecialchars($criteria['criteria_name']); ?>..."
                        required>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="modal-footer pr-0">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save mr-1"></i> Simpan Nilai Alternatif
                </button>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($isAdmin): ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const allValues = <?= json_encode($allExistingValues); ?>;
    const selectUser = document.getElementById('target_user_id');
    const inputs = document.querySelectorAll('.kop-criteria-input');

    if (selectUser) {
      selectUser.addEventListener('change', function() {
        const uid = this.value;
        const userValues = allValues[uid] || {};
        inputs.forEach(function(input) {
          const cid = input.getAttribute('name');
          input.value = (userValues[cid] !== undefined) ? userValues[cid] : '';
        });
      });
    }
  });
</script>
<?php endif; ?>
