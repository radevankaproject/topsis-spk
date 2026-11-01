<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/logo-koperasi.png">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/pace.css?v=5.0">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- <title>Default</title> -->
<!-- CSS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="<?= base_url(); ?>assets/vendors/material-icons/material-icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/vendors/feather-icons/feather.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> -->
<link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/css/koperasi-theme.css?v=5.0" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!-- Head Libs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
<style>
  .drag-drop-area {
    min-height: 180px;
    /* Diperbesar sedikit dari contoh sebelumnya */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px dashed #ced4da;
    border-radius: 8px;
    /* Sedikit lebih membulat */
    padding: 20px;
    position: relative;
    overflow: hidden;
    /* Pastikan gambar preview tidak keluar */
  }

  .drag-drop-area:hover {
    border-color: #00802B;
    background-color: rgba(0, 128, 43, 0.05);
  }

  .drag-drop-area.highlight {
    border-color: #00802B;
    background-color: rgba(0, 128, 43, 0.1);
  }

  .preview-image {
    max-width: 100%;
    max-height: 150px;
    /* Batasi tinggi preview */
    object-fit: contain;
    /* Jaga rasio aspek */
    border-radius: 4px;
    /* Sudut sedikit membulat */
  }

  .clear-image-icon {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 24px;
    color: #dc3545;
    /* Merah untuk hapus */
    cursor: pointer;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    padding: 3px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
  }

  .clear-image-icon:hover {
    color: #c82333;
    transform: scale(1.1);
  }

  .current-profile-image {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
  }

  /* Sembunyikan elemen teks saat ada preview gambar */
  .drag-drop-area.has-image .initial-text,
  .drag-drop-area.has-image button,
  .drag-drop-area.has-image .max-size-text {
    /* Sembunyikan juga teks max size saat ada gambar */
    display: none;
  }

  .current-profile-image {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
  }

  .current-image-label {
    /* Styling for the "Gambar saat ini" text */
    display: block;
    margin-top: 5px;
  }

  /* Critical Circular Progress Preloader around Koperasi Logo */
  #kop-preloader {
    position: fixed;
    inset: 0;
    z-index: 999999;
    background: radial-gradient(circle at center, #145A32 0%, #063B1B 65%, #03220F 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.4s ease, visibility 0.4s ease;
  }

  #kop-preloader.kop-preloader-hide,
  #kop-preloader.kop-preloader-hidden {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
  }

  .kop-loader-wrap {
    position: relative;
    width: 164px;
    height: 164px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 22px;
  }

  .kop-circular-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
    filter: drop-shadow(0 0 12px rgba(245, 196, 0, 0.35));
  }

  .kop-circular-track {
    fill: none;
    stroke: rgba(255, 255, 255, 0.14);
    stroke-width: 7;
  }

  .kop-circular-halo {
    fill: none;
    stroke: rgba(245, 196, 0, 0.25);
    stroke-width: 2;
    stroke-dasharray: 6 6;
    transform-origin: 80px 80px;
    animation: kopSpinHalo 6s linear infinite;
  }

  .kop-circular-progress {
    fill: none;
    stroke: url(#kopCircleGrad);
    stroke-width: 7;
    stroke-linecap: round;
    stroke-dasharray: 427.26;
    stroke-dashoffset: 427.26;
    transition: stroke-dashoffset 0.08s linear;
  }

  .kop-loader-logo-box {
    width: 104px;
    height: 104px;
    border-radius: 50%;
    background: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.4), inset 0 0 0 2px rgba(245, 196, 0, 0.45);
    animation: kopPulseLogo 1.8s ease-in-out infinite;
    z-index: 2;
  }

  .kop-loader-logo-box img {
    width: 100% !important;
    height: 100% !important;
    max-width: 80px !important;
    max-height: 80px !important;
    object-fit: contain;
  }

  .kop-circular-pct {
    position: absolute;
    bottom: -8px;
    background: linear-gradient(135deg, #F5C400 0%, #D99B00 100%);
    color: #063B1B;
    font-size: 11.5px;
    font-weight: 800;
    padding: 2px 10px;
    border-radius: 99px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
    z-index: 3;
    letter-spacing: 0.5px;
  }

  .kop-loader-title {
    color: #FFFFFF !important;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    margin-bottom: 4px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
  }

  .kop-loader-sub {
    color: #FFE066 !important;
    font-size: 12.5px;
    font-weight: 500;
    letter-spacing: 0.3px;
    opacity: 0.92;
  }

  @keyframes kopSpinHalo {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  @keyframes kopPulseLogo {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.04); }
  }
</style>