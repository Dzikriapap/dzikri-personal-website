# 🌐 Personal Website - Dzikri Andika Putra

Project ini merupakan sebuah **website personal dinamis** yang dibangun menggunakan kombinasi **PHP (native)**, **MySQL** sebagai basis data, serta **Tailwind CSS** untuk desain tampilan yang responsif dan modern.

Website ini dirancang untuk menjadi platform portofolio sekaligus sistem informasi personal yang memuat berbagai konten seperti:

- Artikel yang bisa dikelola oleh admin
- Galeri gambar yang dapat ditambahkan secara dinamis
- Halaman about yang bisa diedit lewat dashboard
- Sistem login untuk user dan admin
- Tampilan interaktif dengan mode terang/gelap dan animasi smooth
- Fitur search artikel (pencarian berdasarkan judul)
- Sistem komentar oleh user di setiap artikel

Selain sebagai sarana menampilkan informasi pribadi, website ini juga dilengkapi fitur back-end untuk **manajemen konten secara penuh**, sehingga cocok sebagai latihan membangun sistem web skala kecil-menengah.

## 🎯 Tujuan Pembuatan

- Mengimplementasikan ilmu pemrograman web (front-end dan back-end)
- Melatih pemahaman struktur database relasional
- Membuat website portofolio dengan dashboard admin sendiri
- Membuktikan pemahaman CRUD dan otentikasi user secara nyata

---
## 💡 Teknologi yang Digunakan

- **XAMPP** (Apache & MySQL server lokal)
- **PHP** (tanpa framework)
- **MySQL** (phpMyAdmin)
- **Tailwind CSS** (untuk desain responsif)
- **HTML & JavaScript**
- **Session & autentikasi PHP**
- **Fitur pencarian berbasis query**
- **Sistem komentar per artikel**
- **Infinityfree** (untuk Hosting Online di mobile)

## 📁 Struktur Folder Proyek

Berikut adalah struktur utama dari folder proyek:

![Struktur Folder](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/struktur-folder.jpeg?raw=true)

## 🖥️ Antarmuka Pengguna - Halaman User

Berikut adalah dokumentasi tampilan dari sisi pengguna umum (user), termasuk halaman login dan halaman-halaman publik.

---

### A.Halaman Login (User & Admin)

Sistem login ini menggunakan halaman yang sama untuk user dan admin. Hak akses akan dibedakan berdasarkan data username dan password yang dimasukkan ke dalam form.

- Jika login sebagai **user**, dengan username:user & Passpword: user123 maka akan diarahkan langsung ke halaman publik (user)
- Jika login sebagai **admin**, dengan user:admin & Passpword: admmin123 maka akan diarahkan ke dashboard admin

![Halaman Login](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/halaman-login-user-admin.png?raw=true)

---

### B.Halaman Beranda User

Menampilkan daftar artikel terbaru dari database. Pengguna dapat membaca artikel, melihat waktu publikasi, dan menggunakan fitur dark/light mode. Tersedia juga fitur search dan komentar disetiap artikelnya

![Beranda User](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/beranda-user.png?raw=true)

---

### 🅑 Halaman Beranda User versi dark

Tampilan dark mode dari halaman beranda user. Fitur ini diaktifkan melalui toggle switch pada navigasi, memberikan kenyamanan visual saat digunakan dalam kondisi cahaya rendah. Seluruh elemen seperti artikel, teks, dan tombol akan menyesuaikan tema gelap.

![Beranda User](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/beranda-user-versi-dark.png?raw=true)

---


### C.Halaman Galeri

Menampilkan galeri foto yang diambil dari database. Gambar dapat ditambah dan dikelola melalui dashboard admin.

![Galeri User](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/galery-user.png?raw=true)

---

### D.Halaman About

Menampilkan informasi "Tentang Saya" yang juga dapat diubah oleh admin. Konten ditampilkan secara dinamis dari database.

![About User](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/about-user.png?raw=true)

---
> 📌 Catatan: Seluruh tampilan halaman user dirancang responsif dan terintegrasi dengan fitur dark mode.

## 🛠️ Antarmuka Admin / Dashboard

Bagian ini menampilkan dokumentasi tampilan sisi admin. Admin memiliki akses penuh untuk mengelola konten website seperti artikel, galeri, about, dan komentar.

---

### A.Dashboard Admin (Beranda)

Halaman utama setelah admin berhasil login. Menyediakan navigasi menuju fitur-fitur pengelolaan data seperti artikel, galeri, about, dan komentar.

![Dashboard Admin](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/beranda-admin.png?raw=true)

---

### B.Dashboard Admin (Beranda) versi dark

Tampilan dashboard admin saat fitur dark mode diaktifkan. Semua elemen seperti sidebar, header, dan konten tabel menyesuaikan dengan tema gelap untuk kenyamanan visual saat bekerja dalam kondisi minim cahaya.

![Dashboard Admin](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/beranda-admin-versi-dark.png?raw=true)

---

### C.Kelola Artikel

Halaman untuk menambah, mengedit, dan menghapus artikel yang akan ditampilkan ke user. Tersedia form input dengan validasi dasar serta preview data dalam bentuk tabel.

![Kelola Artikel](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/kelola-artikel-admin.png?raw=true)

---

### D.Kelola Galeri

Digunakan untuk mengatur gambar-gambar galeri yang akan muncul di halaman user. Admin dapat menambahkan atau menghapus gambar melalui form dan tabel.

![Kelola Galeri](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/kelola-galery-admin.png?raw=true)

---

### E.Kelola About

Menampilkan form untuk mengedit informasi "About Me" yang muncul di halaman user. Konten disimpan di database dan dapat diperbarui kapan saja.

![Kelola About](https://github.com/Dzikriapap/dzikri-personal-website/blob/main/personal_web/assets/screenshots/kelola-about-admin.png?raw=true)

---

> 📌 Catatan: Seluruh halaman admin dirancang hanya dapat diakses setelah proses autentikasi login berhasil, untuk menjaga keamanan data dan konten.

## 📱 Akses Versi Mobile

Kamu bisa mengakses website ini melalui perangkat mobile menggunakan link berikut:

🔗 [https://dzikri-project.infinityfreeapp.com/index.php)

Website ini telah dioptimalkan agar responsif dan nyaman digunakan pada berbagai ukuran layar.


## 🔧 Rencana Pengembangan

Beberapa fitur yang direncanakan untuk ditambahkan di masa mendatang:

- Form registrasi user
- Dashboard statistik sederhana untuk admin
- Upload gambar langsung di editor artikel
- Formulir kontak/feedback user
- Notifikasi komentar baru

---

## 🚀 Terima Kasih

Terima kasih sudah mampir melihat-lihat proyek ini.  
Semoga bisa jadi inspirasi, atau minimal… nambah semangat coding 😄






