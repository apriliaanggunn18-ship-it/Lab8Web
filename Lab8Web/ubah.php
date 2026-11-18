<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $nama = trim($_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga_jual = (float)$_POST['harga_jual'];
    $harga_beli = (float)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar = "";

    if (!empty($_FILES['file_gambar']['name']) && $_FILES['file_gambar']['error'] === 0) {
        $namaFile = basename($_FILES['file_gambar']['name']);
        $namaFile = preg_replace('/[^A-Za-z0-9._-]/', '_', $namaFile);
        $tujuan = __DIR__ . '/gambar/' . $namaFile;
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $tujuan)) {
            $gambar = 'gambar/' . $namaFile;
        }
    }

    if ($gambar !== "") {
        $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama=?, kategori=?, harga_jual=?, harga_beli=?, stok=?, gambar=? WHERE id_barang=?");
        mysqli_stmt_bind_param($stmt, "ssddisi", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama=?, kategori=?, harga_jual=?, harga_beli=?, stok=? WHERE id_barang=?");
        mysqli_stmt_bind_param($stmt, "ssddii", $nama, $kategori, $harga_jual, $harga_beli, $stok, $id);
    }

    mysqli_stmt_execute($stmt);
    header('Location: index.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = mysqli_prepare($conn, "SELECT * FROM data_barang WHERE id_barang=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data barang tidak ditemukan. <a href='index.php'>Kembali</a>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Ubah Barang</title>
</head>
<body>
<div class="container form-container">
    <h1>Ubah Barang</h1>
    <form method="post" action="ubah.php" enctype="multipart/form-data">
        <div class="input"><label>Nama Barang</label><input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required></div>
        <div class="input">
            <label>Kategori</label>
            <select name="kategori" required>
                <?php foreach (['Komputer', 'Elektronik', 'Hand Phone'] as $kategori): ?>
                    <option value="<?= $kategori; ?>" <?= $data['kategori'] === $kategori ? 'selected' : ''; ?>><?= $kategori; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input"><label>Harga Jual</label><input type="number" name="harga_jual" min="0" value="<?= htmlspecialchars($data['harga_jual']); ?>" required></div>
        <div class="input"><label>Harga Beli</label><input type="number" name="harga_beli" min="0" value="<?= htmlspecialchars($data['harga_beli']); ?>" required></div>
        <div class="input"><label>Stok</label><input type="number" name="stok" min="0" value="<?= htmlspecialchars($data['stok']); ?>" required></div>
        <div class="input"><label>File Gambar (opsional)</label><input type="file" name="file_gambar" accept="image/*"></div>
        <input type="hidden" name="id" value="<?= (int)$data['id_barang']; ?>">
        <div class="submit"><button type="submit" name="submit">Simpan Perubahan</button><a href="index.php" class="kembali">Kembali</a></div>
    </form>
</div>
</body>
</html>
