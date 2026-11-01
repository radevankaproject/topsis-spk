<?php
$homeLink = ((int)($_SESSION['level'] ?? 0) === 1) ? base_url('home') : base_url('alternative/add');
?>
<div class="navbar-header">
  <a href="<?= $homeLink; ?>" class="navbar-brand kop-brand">
    <img class="kop-logo-img" alt="Logo Koperasi Indonesia" src="<?= base_url(); ?>assets/img/logo-koperasi.png">
    <div class="kop-brand-text">
      <span class="kop-brand-title">Koperasi Indonesia</span>
      <span class="kop-brand-sub">SPK Metode TOPSIS</span>
    </div>
  </a>
</div>
