<?php
include '../koneksi.php';
session_start();

if ($_SESSION['level'] != "admin") { exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_laporan = $_POST['id_laporan'];
    $id_admin   = $_SESSION['id_user'];
    $tanggapan  = mysqli_real_escape_string($conn, $_POST['tanggapan']);

    // 1. Simpan ke tabel comments (menggunakan id_posts sebagai relasi ke id_laporan)
    $query_tanggapan = "INSERT INTO comments (id_posts, id_users, comment_text) VALUES ('$id_laporan', '$id_admin', '$tanggapan')";
    
    if (mysqli_query($conn, $query_tanggapan)) {
        // 2. Otomatis ubah status laporan jadi 'selesai'
        mysqli_query($conn, "UPDATE laporan SET status = 'selesai' WHERE id_laporan = '$id_laporan'");
        
        echo "<script>alert('Tanggapan berhasil dikirim!'); window.location='validasi_admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>