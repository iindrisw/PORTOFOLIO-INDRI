<?php
include 'koneksi.php';

$id = $_GET['id'];

// ambil nama file gambar
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM produk WHERE id=$id"));

// hapus file gambar
if ($data['gambar'] != "") {
    unlink("gambar/".$data['gambar']);
}

// hapus dari database
mysqli_query($conn, "DELETE FROM produk WHERE id=$id");

header("Location: produk.php");
?>
?>