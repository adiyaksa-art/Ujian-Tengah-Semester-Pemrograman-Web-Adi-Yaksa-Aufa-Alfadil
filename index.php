<?php
include 'koneksi.php';
$query = "SELECT * FROM buku ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Buku Perpustakaan</h2>
        <a href="form.php" class="btn-tambah">+ Tambah Data Buku</a>
        
        <table>
            <tr>
                <th>No</th>
                <th>Sampul</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><img src="uploads/<?= $row['foto']; ?>" class="thumbnail" alt="Sampul"></td>
                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                <td><?= htmlspecialchars($row['nama_pengarang']); ?></td>
                <td><?= htmlspecialchars($row['tahun_terbit']); ?></td>
                <td>
                    <a href="form.php?id=<?= $row['id']; ?>" class="link-aksi edit">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="link-aksi hapus" onclick="return konfirmasiHapus();">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>