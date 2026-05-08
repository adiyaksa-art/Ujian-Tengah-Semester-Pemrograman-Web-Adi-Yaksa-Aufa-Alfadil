<?php
include 'koneksi.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$judul = ''; $pengarang = ''; $tahun = ''; $foto_lama = '';

if ($id != '') {
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE id = '$id'");
    if ($row = mysqli_fetch_assoc($query)) {
        $judul = $row['judul_buku'];
        $pengarang = $row['nama_pengarang'];
        $tahun = $row['tahun_terbit'];
        $foto_lama = $row['foto'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Edit' : 'Tambah'; ?> Data Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2><?= $id ? 'Edit' : 'Tambah'; ?> Data Buku</h2>
        
        <form action="proses.php" method="POST" enctype="multipart/form-data" onsubmit="return validasiForm()">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="foto_lama" value="<?= $foto_lama; ?>">

            <label>Judul Buku:</label>
            <input type="text" name="judul_buku" id="judul_buku" value="<?= $judul; ?>" placeholder="Masukkan judul buku">

            <label>Nama Pengarang:</label>
            <input type="text" name="nama_pengarang" id="nama_pengarang" value="<?= $pengarang; ?>" placeholder="Masukkan nama pengarang">

            <label>Tahun Terbit:</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" value="<?= $tahun; ?>" placeholder="Contoh: 2024">

            <label>Foto Sampul:</label>
            <?php if ($foto_lama) echo "<img src='uploads/$foto_lama' width='80' style='border:1px solid #ccc; margin-bottom:10px; border-radius:4px;'><br>"; ?>
            <input type="file" name="foto" id="foto" accept="image/jpeg, image/png, image/jpg">

            <button type="submit" class="btn-simpan">Simpan Data</button>
            <a href="index.php" class="btn-batal">Batal</a>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>