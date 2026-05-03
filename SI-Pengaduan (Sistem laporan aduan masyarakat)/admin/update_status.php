<?php 
include '../koneksi.php';
session_start();

if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") { exit; }

if (isset($_POST['status'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_laporan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // 1. Jalankan Update Status
    $query = "UPDATE laporan SET status = '$status' WHERE id_laporan = '$id'";
    
    if (mysqli_query($conn, $query)) {
        
        // 2. LOGIC POIN: Jika status 'selesai', kasih poin ke pelapor
        if ($status == 'selesai') {
            // Cari tau siapa pelapornya
            $get_lapor = mysqli_query($conn, "SELECT id_user FROM laporan WHERE id_laporan = '$id'");
            $data_lapor = mysqli_fetch_assoc($get_lapor);
            $id_pelapor = $data_lapor['id_user'];

            // Tambah 10 Poin ke tabel users
            mysqli_query($conn, "UPDATE users SET points = points + 10 WHERE id_user = '$id_pelapor'");
        }

        header("Location: validasi_admin.php?pesan=berhasil");
    } else {
        echo "Gagal update, Yes!";
    }
}
?>