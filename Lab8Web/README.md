# Lab8Web – PHP dan Database MySQL

Project Praktikum 8 Pemrograman Web OBE tentang CRUD data barang menggunakan PHP dan MySQL.

## 1. Persiapan
- Install dan buka XAMPP.
- Jalankan **Apache** dan **MySQL**.
- Buka VS Code.

## 2. Menempatkan folder project
Salin folder `Lab8Web` ke:
`C:\xampp\htdocs\`

Pastikan susunannya seperti ini:
```text
Lab8Web/
├── gambar/
├── koneksi.php
├── index.php
├── tambah.php
├── ubah.php
├── hapus.php
├── style.css
├── database.sql
└── README.md
```

## 3. Membuat database
1. Buka `http://localhost/phpmyadmin/`.
2. Pilih menu **SQL**.
3. Buka file `database.sql`, salin seluruh isinya, lalu tempel ke kolom SQL.
4. Klik **Go/Kirim**.
5. Pastikan database `latihan1` dan tabel `data_barang` sudah muncul.

## 4. Menjalankan project
Buka browser dan akses:
`http://localhost/Lab8Web/`

Halaman Data Barang akan menampilkan data awal HP Samsung, Xiaomi, dan OPPO.

## 5. Pengujian CRUD
- **Create:** klik `Tambah Barang`, isi formulir, lalu klik `Simpan`.
- **Read:** data barang tampil pada halaman utama.
- **Update:** klik `Ubah` pada salah satu barang, edit data, lalu simpan.
- **Delete:** klik `Hapus` dan setujui konfirmasi.

## 6. Pengujian gambar
Pada halaman Tambah/Ubah Barang, pilih file gambar dari komputer. File akan disimpan ke folder `gambar/` dan ditampilkan pada tabel.

## 7. Screenshot laporan
Ambil screenshot hasil yang benar-benar tampil di browser untuk:
1. XAMPP Apache dan MySQL aktif.
2. Database `latihan1` dan tabel `data_barang` di phpMyAdmin.
3. Halaman utama Data Barang.
4. Form Tambah Barang dan hasil setelah data disimpan.
5. Form Ubah Barang dan hasil setelah perubahan disimpan.
6. Konfirmasi Hapus dan halaman setelah data terhapus.

Masukkan screenshot ke README atau folder `screenshots/`, lalu tulis keterangan singkat di bawah setiap gambar. Screenshot perlu diambil sendiri dari hasil menjalankan project.

## 8. GitHub
Buat repository baru bernama `Lab8Web`, kemudian jalankan perintah berikut dari terminal VS Code di dalam folder project:

```bash
git init
git add .
git commit -m "Praktikum 8 PHP MySQL CRUD"
git branch -M main
git remote add origin https://github.com/USERNAME/Lab8Web.git
git push -u origin main
```

Ganti `USERNAME` dengan username GitHub sendiri. Setelah berhasil, salin URL repository dan kumpulkan ke e-learning.

## Keterangan
Project mengikuti urutan modul: membuat database `latihan1`, tabel `data_barang`, koneksi PHP, menampilkan data (Read), menambah (Create), mengubah (Update), dan menghapus (Delete). Query pada file PHP menggunakan prepared statement agar input lebih aman.
