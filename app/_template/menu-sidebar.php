<?php
$currM = $_GET['m'] ?? '';
$currR = $_GET['r'] ?? '';
$isHome = empty($currM) && empty($currR);
$isMaster = in_array($currM, ['users', 'criteria', 'alternative']);
?>
<ul class="nav in side-menu">
  <?php if ((int)($_SESSION['level'] ?? 0) === 1) : ?>
    <li class="<?= $isHome ? 'active current-page' : ''; ?>">
      <a href="<?= base_url(); ?>home">
        <i class="list-icon feather feather-grid"></i>
        <span class="hide-menu">Dashboard Koperasi</span>
      </a>
    </li>

    <li class="menu-item-has-children <?= $isMaster ? 'active' : ''; ?>">
      <a href="javascript:void(0);">
        <i class="list-icon feather feather-database"></i>
        <span class="hide-menu">Data Master</span>
      </a>
      <ul class="list-unstyled sub-menu">
        <li class="<?= ($currM === 'users') ? 'active' : ''; ?>">
          <a href="<?= base_url(); ?>users"><i class="fas fa-users mr-2"></i> Data Pengguna</a>
        </li>
        <li class="<?= ($currM === 'criteria') ? 'active' : ''; ?>">
          <a href="<?= base_url(); ?>criteria"><i class="fas fa-sliders-h mr-2"></i> Data Kriteria</a>
        </li>
        <li class="<?= ($currM === 'alternative' && $currR === 'list') ? 'active' : ''; ?>">
          <a href="<?= base_url(); ?>alternative"><i class="fas fa-clipboard-list mr-2"></i> Rekap Alternatif</a>
        </li>
        <li class="<?= ($currM === 'alternative' && $currR === 'add') ? 'active' : ''; ?>">
          <a href="<?= base_url(); ?>alternative/add"><i class="fas fa-edit mr-2"></i> Input Alternatif</a>
        </li>
      </ul>
    </li>

    <li class="<?= ($currM === 'topsis') ? 'active current-page' : ''; ?>">
      <a href="<?= base_url(); ?>topsis/results">
        <i class="list-icon feather feather-award"></i>
        <span class="hide-menu">Perhitungan TOPSIS</span>
      </a>
    </li>
  <?php else : ?>
    <li class="<?= ($currM === 'alternative' && $currR === 'add') ? 'active current-page' : ''; ?>">
      <a href="<?= base_url(); ?>alternative/add">
        <i class="list-icon feather feather-edit-3"></i>
        <span class="hide-menu">Input Nilai Usaha</span>
      </a>
    </li>
  <?php endif; ?>

  <?php if (!empty($_SESSION['username'])) : ?>
    <li>
      <a href="javascript:void(0);" onclick="confirmLogout()">
        <i class="list-icon feather feather-power"></i>
        <span class="hide-menu">Keluar Sistem</span>
      </a>
    </li>
  <?php endif; ?>
</ul>
