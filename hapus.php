<?php
include 'koneksi.php';

$id = $_GET['id'];

$query_pilih = mysqli_query($conn, "SELECT foto FROM buku WHERE id='$id'");
$row = mysqli_fetch_assoc($query_pilih);

if ($row) {
    $foto = $row['foto'];
    if ($foto != '' && file_exists('uploads/' . $foto)) {
        unlink('uploads/' . $foto);
    }
    
    $query_hapus = mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");
    
    if ($query_hapus) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>