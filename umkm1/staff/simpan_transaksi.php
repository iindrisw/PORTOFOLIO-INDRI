<?php
session_start();
include 'koneksi.php';

// 1. Cek apakah keranjang kosong
if (empty($_SESSION['keranjang'])) {
    header("Location: index.php?menu=produk_masuk");
    exit;
}

$tanggal = date('Y-m-d');
$id_staff = $_SESSION['id_user']; // Sekarang ini sudah ada isinya karena login diperbaiki


// 2. Simpan data induk ke tabel produk_masuk
$query_masuk = mysqli_query($conn, "INSERT INTO produk_masuk (tanggal, id_staff) VALUES ('$tanggal', '$id_staff')");

if ($query_masuk) {
    // Ambil ID transaksi yang baru saja dibuat
    $id_masuk = mysqli_insert_id($conn);

    // 3. Pindahkan isi keranjang ke detail dan UPDATE STOK
    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        
        // Simpan ke tabel detail
        mysqli_query($conn, "INSERT INTO produk_masuk_detail (id_masuk, id_produk, jumlah) VALUES ('$id_masuk', '$id_produk', '$jumlah')");

        // PROSES UPDATE STOK: Stok lama + Jumlah masuk
        // Pastikan nama kolom ID di tabel produk kamu sesuai (id atau id_produk)
        mysqli_query($conn, "UPDATE produk SET stok = stok + $jumlah WHERE id = '$id_produk'");
    }

    // 4. Kosongkan keranjang setelah berhasil simpan
    unset($_SESSION['keranjang']);

    echo "<script>alert('Transaksi Berhasil Disimpan & Stok Terupdate!'); window.location='index.php?menu=produk_masuk';</script>";
} else {
    echo "Gagal menyimpan transaksi: " . mysqli_error($conn);
}
?>