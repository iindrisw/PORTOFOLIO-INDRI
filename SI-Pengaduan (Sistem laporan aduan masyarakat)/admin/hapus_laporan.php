<?php 
include '../koneksi.php';
session_start();

// 1. PROTEKSI ADMIN: Pastikan hanya admin yang bisa hapus
if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") {
    exit("Akses ditolak!");
}

// 2. TANGKAP ID DARI URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 3. AMBIL NAMA FOTO: Biar bisa dihapus dari folder assets
    $cek_foto = mysqli_query($conn, "SELECT foto FROM laporan WHERE id_laporan = '$id'");
    $data = mysqli_fetch_assoc($cek_foto);
    $nama_foto = $data['foto'];

    // 4. HAPUS FILE FISIK: Jika ada fotonya, hapus dari folder
    if (!empty($nama_foto) && file_exists("../assets/img/" . $nama_foto)) {
        unlink("../assets/img/" . $nama_foto);
    }

    // 5. HAPUS DATA DARI DATABASE
    $query_hapus = mysqli_query($conn, "DELETE FROM laporan WHERE id_laporan = '$id'");

    if ($query_hapus) {
        echo "<script>alert('Laporan berhasil dihapus!'); window.location='validasi_admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='validasi_admin.php';</script>";
    }
} else {
    header("Location: validasi_admin.php");
}
?>