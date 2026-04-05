<?php
include 'koneksi.php';
$id = $_GET['id'];

if (mysqli_query($conn, "DELETE FROM staff WHERE id=$id")) {
    echo "<script>alert('Data terhapus'); window.location='index.php?menu=staff';</script>";
} else {
    echo "Gagal hapus: " . mysqli_error($conn);
}
?>