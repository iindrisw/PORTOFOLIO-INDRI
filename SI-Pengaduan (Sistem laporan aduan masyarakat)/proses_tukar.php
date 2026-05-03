<?php
include 'koneksi.php';
session_start();

if (isset($_POST['tukar'])) {
    $id_user = $_SESSION['id_user'];
    $harga   = (int)$_POST['harga_poin'];
    $nama_v  = mysqli_real_escape_string($conn, $_POST['nama_voucher']);

    // 1. Ambil data poin asli dari database (Bukan dari session)
    $query_cek = mysqli_query($conn, "SELECT points FROM users WHERE id_user = '$id_user'");
    $data = mysqli_fetch_assoc($query_cek);

    if ($data && $data['points'] >= $harga) {
        
        // 2. POTONG POIN DI DATABASE
        $update_poin = mysqli_query($conn, "UPDATE users SET points = points - $harga WHERE id_user = '$id_user'");

        if ($update_poin) {
            // 3. GENERATE KODE UNIK
            $kode_acak = strtoupper(substr(md5(time() . $id_user), 0, 8));

            // 4. SIMPAN KE TABEL voucher_saya
            mysqli_query($conn, "INSERT INTO voucher_saya (id_user, nama_voucher, kode_voucher, status) 
                                 VALUES ('$id_user', '$nama_v', '$kode_acak', 'aktif')");

            // 5. UPDATE SESSION POIN (Penting: Pake nilai baru biar Header langsung berubah)
            $_SESSION['points'] = $data['points'] - $harga;
            
            // Redirect dengan notif
            header("Location: reward.php?pesan=berhasil_tukar&voucher=" . urlencode($nama_v));
            exit();
        } else {
            echo "Gagal memotong poin: " . mysqli_error($conn);
        }

    } else {
        header("Location: reward.php?pesan=poin_kurang");
        exit();
    }
} else {
    header("Location: reward.php");
    exit();
}
?>