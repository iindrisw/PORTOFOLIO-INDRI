<?php
include 'koneksi.php';

// 1. Hitung Total Produk
$q_produk = mysqli_query($conn, "SELECT * FROM produk");
$total_produk = mysqli_num_rows($q_produk);

// 2. Hitung Stok Kritis (di bawah 5)
$q_stok = mysqli_query($conn, "SELECT * FROM produk WHERE stok < 5");
$stok_kritis = mysqli_num_rows($q_stok);

// 3. Hitung Transaksi Masuk Hari Ini
$tgl_sekarang = date('Y-m-d');
$q_transaksi = mysqli_query($conn, "SELECT * FROM produk_masuk WHERE tanggal = '$tgl_sekarang'");
$total_transaksi = mysqli_num_rows($q_transaksi);
?>


<div class="row mb-4">
    <div class="col-md-4">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h6 class="text-muted small fw-bold text-uppercase">Total Produk</h6>
            <h2 class="fw-bold mb-0"><?= $total_produk; ?></h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h6 class="text-muted small fw-bold text-uppercase">Stok Hampir Habis</h6>
            <h2 class="fw-bold mb-0 text-danger"><?= $stok_kritis; ?></h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h6 class="text-muted small fw-bold text-uppercase">Transaksi Hari Ini</h6>
            <h2 class="fw-bold mb-0 text-success"><?= $total_transaksi; ?></h2>
        </div>
    </div>
</div>

<div class="card card-custom p-5 shadow-sm border-0">
    <h2 class="fw-bold mb-2">Selamat Datang di Dashboard Staff</h2>
    <p class="text-muted">Anda login sebagai <strong><?= $_SESSION['nama']; ?></strong>. Kelola data barang masuk dan pantau stok melalui menu di atas.</p>
</div>