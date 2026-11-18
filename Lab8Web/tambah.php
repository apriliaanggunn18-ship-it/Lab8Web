<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

$pesan = "";

if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga_jual = (float)$_POST['harga_jual'];
    $harga_beli = (float)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar = "";

    if (!empty($_FILES['file_gambar']['name'])) {
        if ($_FILES['file_gambar']['error'] === 0) {
            $namaFile = basename($_FILES['file_gambar']['name']);
            $namaFile = preg_replace('/[^A-Za-z0-9._-]/', '_', $namaFile);
            $tujuan = __DIR__ . '/gambar/' . $namaFile;
            if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $tujuan)) {
                $gambar = 'gambar/' . $namaFile;
            }
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssddis", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit;
    } else {
        $pesan = "Data gagal disimpan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Tambah Barang</title>
</head>
<body>
<div class="container form-container">
    <h1>Tambah Barang</h1>
    <?php if ($pesan): ?><p class="pesan"><?= htmlspecialchars($pesan); ?></p><?php endif; ?>
    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <div class="input"><label>Nama Barang</label><input type="text" name="nama" required></div>
        <div class="input">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </div>
        <div class="input"><label>Harga Jual</label><input type="number" name="harga_jual" min="0" required></div>
        <div class="input"><label>Harga Beli</label><input type="number" name="harga_beli" min="0" required></div>
        <div class="input"><label>Stok</label><input type="number" name="stok" min="0" required></div>
        <div class="input"><label>File Gambar</label><input type="file" name="file_gambar" accept="image/*"></div>
        <div class="submit"><button type="submit" name="submit">Simpan</button><a href="index.php" class="kembali">Kembali</a></div>
    </form>
</div>
</body>
</html>
