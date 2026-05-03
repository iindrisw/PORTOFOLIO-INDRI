<?php
include '../koneksi.php';
session_start();

if ($_SESSION['level'] != "admin") { exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_laporan = $_POST['id_laporan'];
    $id_admin   = $_SESSION['id_user'];
    $tanggapan  = mysqli_real_escape_string($conn, $_POST['tanggapan']);

    // 1. Ambil ID Pelapor (id_user) dari tabel laporan sebelum update
    $get_pelapor = mysqli_query($conn, "SELECT id_user FROM laporan WHERE id_laporan = '$id_laporan'");
    $data_laporan = mysqli_fetch_assoc($get_pelapor);
    $id_pelapor = $data_laporan['id_user'];

    // 2. Simpan ke tabel comments
    $query_tanggapan = "INSERT INTO comments (id_posts, id_users, comment_text) VALUES ('$id_laporan', '$id_admin', '$tanggapan')";
    
    if (mysqli_query($conn, $query_tanggapan)) {
        // 3. Otomatis ubah status laporan jadi 'selesai'
        mysqli_query($conn, "UPDATE laporan SET status = 'selesai' WHERE id_laporan = '$id_laporan'");
        
        // 4. TAMBAHKAN POIN KE PELAPOR
        // Misal: Hadiah 10 poin karena laporan valid dan selesai
        $jumlah_poin = 10;
        mysqli_query($conn, "UPDATE users SET points = points + $jumlah_points WHERE id_user = '$id_pelapor'");
        
        echo "<script>alert('Tanggapan dikirim & Points berhasil diberikan!'); window.location='validasi_admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>