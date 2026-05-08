<?php
include 'koneksi.php';

$id = $_POST['id'];
$judul = mysqli_real_escape_string($conn, $_POST['judul_buku']);
$pengarang = mysqli_real_escape_string($conn, $_POST['nama_pengarang']);
$tahun = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
$foto_lama = isset($_POST['foto_lama']) ? $_POST['foto_lama'] : '';

$nama_file_baru = $foto_lama;

// === TAMBAHAN: Validasi Wajib Upload Foto di PHP ===
// Jika ini adalah proses Tambah Data ($id kosong) DAN tidak ada file yang diupload
if ($id == '' && $_FILES['foto']['error'] !== 0) {
    echo "<script>alert('Gagal! Foto sampul wajib diunggah.'); window.history.back();</script>";
    exit;
}
// ===================================================

if ($_FILES['foto']['error'] === 0) {
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    
    $ekstensi_valid = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    if (in_array($ekstensi_file, $ekstensi_valid) && $ukuran_file <= 2000000) {
        $nama_file_baru = uniqid() . '.' . $ekstensi_file;
        move_uploaded_file($tmp_name, 'uploads/' . $nama_file_baru);
        
        if ($id != '' && $foto_lama != '' && file_exists('uploads/' . $foto_lama)) {
            unlink('uploads/' . $foto_lama);
        }
    } else {
        echo "<script>alert('Gagal! Pastikan file gambar (JPG/PNG) dan maksimal 2MB.'); window.history.back();</script>";
        exit;
    }
}

if ($id == '') {
    $query = "INSERT INTO buku (judul_buku, nama_pengarang, tahun_terbit, foto) VALUES ('$judul', '$pengarang', '$tahun', '$nama_file_baru')";
} else {
    $query = "UPDATE buku SET judul_buku='$judul', nama_pengarang='$pengarang', tahun_terbit='$tahun', foto='$nama_file_baru' WHERE id='$id'";
}

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>