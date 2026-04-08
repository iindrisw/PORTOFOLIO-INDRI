<?php
include '../koneksi.php';
session_start();

// 1. Ambil data dari Form
$id_user  = $_SESSION['id_user'];
$judul    = mysqli_real_escape_string($conn, $_POST['judul']);
$kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
$isi      = mysqli_real_escape_string($conn, $_POST['isi']);
$lokasi   = mysqli_real_escape_string($conn, $_POST['lokasi']);

// 2. Logic Upload Foto
$foto_name = $_FILES['foto']['name'];
if ($foto_name != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $foto_name);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $foto_name; // Biar nama file gak bentrok

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../assets/img/' . $nama_gambar_baru);
        
        // Query dengan Foto
        $query = "INSERT INTO laporan (id_user, judul, isi_laporan, kategori, foto, lokasi, status) 
                  VALUES ('$id_user', '$judul', '$isi', '$kategori', '$nama_gambar_baru', '$lokasi', 'pending')";
    }
} else {
    // Query tanpa Foto
    $query = "INSERT INTO laporan (id_user, judul, isi_laporan, kategori, lokasi, status) 
              VALUES ('$id_user', '$judul', '$isi', '$kategori', '$lokasi', 'pending')";
}

// 3. Eksekusi & Redirect ke INDEX
if (mysqli_query($conn, $query)) {
    // BERHASIL: Tendang ke index.php di folder utama
    header("Location: ../index.php?pesan=laporan_terkirim");
} else {
    // GAGAL
    echo "Gagal mengirim laporan: " . mysqli_error($conn);
}
?>