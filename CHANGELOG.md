# 📋 Catatan Perubahan (*Changelog*)

<div align="center">

**SPK Kelayakan Bantuan UMKM — Metode TOPSIS**  
Dikembangkan oleh [**Radevanka Project**](https://radevankaproject.com)  
*“Build with Logic. Secure with Discipline. Deliver with Pride”*

</div>

Seluruh perubahan penting pada proyek ini didokumentasikan di dalam file ini.  
Format dokumentasi mengacu pada standar [Keep a Changelog](https://keepachangelog.com/id-ID/1.0.0/) dan menggunakan penomoran [Semantic Versioning](https://semver.org/lang/id/).

---

## [v2.0.0] — Koperasi Indonesia Edition (2026)

Rilis besar (*Major Release*) yang merombak total antarmuka aplikasi dengan identitas visual **Koperasi Indonesia**, peningkatan keamanan akses berbasis *role* (RBAC), serta penyempurnaan alur input data nilai alternatif untuk Administrator maupun Peserta UMKM.

### ✨ Ditambahkan (*Added*)
- **Desain Tema Koperasi Indonesia (`assets/css/koperasi-theme.css`)**:
  - Palet warna khas Koperasi Indonesia: *Hijau Beringin Tua* (`#0B3D20` & `#00802B`), *Kuning Emas Kerakyatan* (`#F4B400`), dan *Merah Putih* (`#D91B1B`).
  - Integrasi penuh tipografi **Roboto Slab** (Google Fonts) di seluruh halaman.
- **Circular Progress Preloader Logo Koperasi**:
  - Animasi *circular progress bar* SVG bergradasi Emas–Hijau–Merah yang melingkari logo Koperasi Indonesia (`0%–100%`) saat pemuatan halaman.
- **Halaman Login Split-Screen Modern (`app/views/login.php`)**:
  - Banner identitas Koperasi Indonesia dengan tiga pilar (*Keadilan, Kemakmuran, Objektif*) dan kartu form login modern.
- **Input & Edit Nilai Alternatif oleh Admin (`app/views/alternative/add.php`)**:
  - *Dropdown selector* peserta UMKM khusus Administrator untuk menginput atau memperbarui nilai kriteria peserta secara langsung.
  - *Auto-populate* nilai kriteria otomatis berbasis JavaScript saat Admin memilih nama peserta UMKM, dilengkapi tombol pintasan **Edit** di halaman Rekap Alternatif (`app/views/alternative/list.php`).
- **Dukungan Multi-Web Server**:
  - Penambahan konfigurasi URL Rewrite khusus Nginx (`nginx_rewrite.conf`) untuk pengguna aaPanel / VPS selain `.htaccess` untuk Apache (Laragon / XAMPP).
- **Dokumentasi Proyek Lengkap**:
  - Penambahan `README.md`, `SECURITY.md`, dan `CHANGELOG.md` resmi dari **Radevanka Project**.

### 🔄 Diubah (*Changed*)
- **Role-Based Access Control (RBAC) Ketat (`index.php` & `route/web.php`)**:
  - Seluruh halaman kini wajib autentikasi login.
  - Pengguna dengan *role* **Peserta UMKM (`Level 2`)** difokuskan dan dikunci khusus pada halaman **Input Nilai Usaha** (`/alternative/add`).
  - Pengguna dengan *role* **Administrator (`Level 1`)** memiliki akses penuh ke seluruh modul manajemen, rekapitulasi, dan perhitungan TOPSIS.
- **Dashboard Analitik (`app/views/home/home.php`)**:
  - Pembaruan *KPI Summary Cards* (Total Peserta UMKM, Kriteria Penilaian, Peringkat #1 Terbaik, Rata-rata Skor Preferensi).
  - Pembaruan palet grafik **Chart.js** dan lencana medali peringkat (Emas, Perak, Perunggu).
- **Halaman Perhitungan TOPSIS (`app/views/topsis/results.php`)**:
  - Penyajian rumus matematis dan matriks tahapan 1 s.d. 6 yang lebih rapi dan mudah dibaca untuk kebutuhan presentasi sidang skripsi.

### 🐛 Diperbaiki (*Fixed*)
- **Kompatibilitas PHP 8 & MySQL Strict Mode (`app/controllers/TopsisCalculator.php`)**:
  - Perbaikan query `ONLY_FULL_GROUP_BY` pada pengambilan data dashboard dan rekap alternatif.
- **Deteksi Protokol HTTPS & Reverse Proxy (`config/controlWeb.php`)**:
  - Perbaikan fungsi `base_url()` agar otomatis mendeteksi `HTTP_X_FORWARDED_PROTO` dan `HTTP_CF_VISITOR` sehingga bebas dari peringatan *Mixed Content* pada SSL/HTTPS.
- **Fallback Foto Profil Otomatis (`app/_template/navbar.php` & `user-details-sidebar.php`)**:
  - Pengecekan keberadaan file fisik (`is_file()`) sebelum memuat foto profil dan *fallback* otomatis ke logo Koperasi Indonesia tanpa memicu error `404` di konsol browser.
- **Perbaikan Script Tema (`assets/js/theme.js`)**:
  - Penambahan pengecekan fungsi plugin pada inisialisasi `Unifato` agar tidak memutus eksekusi script halaman.

---

## [v1.0.0] — Initial Release (2025-05-07)

Rilis perdana aplikasi **Sistem Pendukung Keputusan (SPK) Penentuan Kelayakan Bantuan UMKM Menggunakan Metode TOPSIS**.

### ✨ Fitur Awal
- Mesin perhitungan **TOPSIS (`TopsisCalculator.php`)** lengkap 6 tahapan:
  1. Matriks Keputusan ($X$)
  2. Matriks Normalisasi ($R$)
  3. Matriks Normalisasi Terbobot ($Y$)
  4. Solusi Ideal Positif ($A^+$) & Negatif ($A^-$)
  5. Jarak Euclidean ($D_i^+$ & $D_i^-$)
  6. Nilai Preferensi ($V_i$) & Perangkingan Otomatis ke tabel `topsis_results`
- Modul CRUD Manajemen Pengguna (`UsersControllers.php`) dengan kompresi foto profil dan enkripsi password `bcrypt`.
- Modul CRUD Manajemen Kriteria & Bobot (`CriteriasControllers.php`) dengan dukungan atribut *Benefit* & *Cost*.
- Modul Input & Rekapitulasi Nilai Alternatif (`AlternativeControllers.php`).
- Proteksi keamanan form menggunakan **CSRF Token** dan notifikasi *toast* (`Toastr.js`).
- Ekspor laporan tabel ke format **Copy, CSV, Excel, PDF, dan Print** menggunakan *DataTables Buttons*.

---

<div align="center">
  <sub>Dikembangkan oleh <a href="https://radevankaproject.com"><strong>Radevanka Project</strong></a> • <a href="mailto:hi@radevankaproject.com">hi@radevankaproject.com</a> • <code>@radevankaproject</code></sub><br/>
  <sub><em>"Build with Logic. Secure with Discipline. Deliver with Pride"</em></sub>
</div>
