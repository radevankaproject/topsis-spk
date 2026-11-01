# 🛡️ Kebijakan Keamanan & Atribusi (*Security & Attribution Policy*)

<div align="center">

**SPK Kelayakan Bantuan UMKM — Metode TOPSIS**  
Dikembangkan oleh [**Radevanka Project**](https://radevankaproject.com)  
*“Build with Logic. Secure with Discipline. Deliver with Pride”*

</div>

---

## 1. ⚖️ Ketentuan Penggunaan Open Source & Kewajiban Atribusi (Wajib Dibaca)

Proyek ini dirilis sebagai **Open Source** untuk tujuan **edukasi, pembelajaran akademik, dan referensi Skripsi / Tugas Akhir Mahasiswa**. Anda diperbolehkan untuk mempelajari, memodifikasi, dan mengembangkan kode sumber ini dengan mematuhi ketentuan mutlak berikut:

### ✅ Yang Diperbolehkan:
- Menggunakan aplikasi ini sebagai bahan pembelajaran, riset akademik, atau referensi skripsi.
- Memodifikasi tampilan, kriteria, maupun studi kasus sesuai kebutuhan penelitian akademik.
- Menambahkan nama Anda sebagai *konstributor / pengembang lanjutan* di samping kredit pengembang awal.

### 🚫 Yang Dilarang Keras (*Strictly Prohibited*):
1. **DILARANG MENGHILANGKAN KREDIT AWAL (*Original Credit*)**  
   Anda **tidak diperbolehkan menghapus, menyembunyikan, atau mengganti total** identitas pengembang awal (**Radevanka Project** / `radevankaproject.com`) baik pada:
   - Dokumentasi proyek (`README.md`, `SECURITY.md`).
   - Header komentar kode sumber (`@author [RadevankaProject]`).
   - Atribusi pengembang pada repositori hasil *fork* atau publikasi ulang.
2. **Dilarang Mengklaim Karya Secara Sepihak (*Plagiarisme Lisensi*)**  
   Mendistribusikan ulang atau memperjualbelikan *source code* ini secara komersial atas nama pihak lain dengan menghapus kredit **Radevanka Project** merupakan pelanggaran integritas karya intelektual.

---

## 2. 📌 Versi yang Didukung (*Supported Versions*)

Pembaruan keamanan dan perbaikan *bug* aktif diberikan untuk versi berikut:

| Versi | Status Dukungan | Keterangan |
| :--- | :---: | :--- |
| **v2.x (Koperasi Edition)** | ✅ Didukung Penuh | Tema Koperasi Indonesia, RBAC Ketat, Proteksi CSRF & Prepared Statements |
| **v1.x (Legacy)** | ⚠️ Terbatas | Versi awal sebelum perombakan UI & RBAC |

---

## 3. 🔒 Standar Keamanan pada Aplikasi

Sesuai dengan prinsip ***"Build with Logic. Secure with Discipline. Deliver with Pride"***, aplikasi ini menerapkan lapisan keamanan berikut:

- **Role-Based Access Control (RBAC)**: Pembatasan hak akses ketat antara Administrator Koperasi (`Level 1`) dan Peserta UMKM (`Level 2`) di tingkat *routing* maupun *controller*.
- **CSRF Token Protection**: Seluruh form autentikasi dan mutasi data dilindungi menggunakan token CSRF berbasis sesi (`generate_csrf_token()` & `check_csrf_token()`).
- **Password Hashing**: Kata sandi pengguna dienkripsi satu arah menggunakan algoritma `PASSWORD_BCRYPT` (`password_hash()` & `password_verify()`).
- **SQL Injection Prevention**: Operasi basis data menggunakan *Prepared Statements* (`mysqli::prepare` & `bind_param`).
- **XSS Mitigation**: Seluruh output data dinamis pada *view* disanitasi menggunakan `htmlspecialchars()`.

---

## 4. 🚨 Pelaporan Celah Keamanan (*Reporting a Vulnerability*)

Jika Anda menemukan celah keamanan (*security vulnerability*) atau pelanggaran atribusi pada proyek ini, mohon **jangan** mempublikasikannya secara terbuka di *public issue* sebelum diperbaiki. Silakan laporkan langsung kepada tim **Radevanka Project** melalui:

- 📧 **Email Resmi**: [hi@radevankaproject.com](mailto:hi@radevankaproject.com)
- 🌐 **Website**: [https://radevankaproject.com](https://radevankaproject.com)
- 📸 **Instagram / TikTok / Facebook / Threads**: `@radevankaproject`

Tim kami akan meninjau laporan Anda dan memberikan tanggapan secepatnya.

---

<div align="center">
  <sub>&copy; <strong>Radevanka Project</strong> • <em>"Build with Logic. Secure with Discipline. Deliver with Pride"</em></sub>
</div>
