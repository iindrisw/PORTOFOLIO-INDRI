<?php
// Proteksi agar hanya yang sudah login bisa masuk
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel | UMKM Sejahtera</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root { --primary-color: #2c3e50; --bg-soft: #f8f9fc; } /* Tema gelap untuk Staf */
        body { background-color: var(--bg-soft); font-family: 'Segoe UI', sans-serif; }
        .navbar-main { background: var(--primary-color); padding: 1rem 0; }
        .nav-link { font-weight: 500; color: rgba(255,255,255,0.85) !important; }
        .nav-link:hover { color: #fff !important; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-main sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-user-tie me-2"></i>STAFF PANEL</a>
        <div class="collapse navbar-collapse" id="staffNav">
            <ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?menu=produk"><i class="fas fa-box me-1"></i> Data Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?menu=produk_masuk"><i class="fas fa-truck-loading me-1"></i> Transaksi Masuk</a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-file-alt me-1"></i> Laporan
        </a>
        <ul class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="index.php?menu=laporan_stok"><i class="fas fa-clipboard-list me-2"></i>Laporan Stok</a></li>
    <li><a class="dropdown-item" href="index.php?menu=laporan_pembelian"><i class="fas fa-history me-2"></i>Laporan Pembelian</a></li>
    <li><a class="dropdown-item" href="index.php?menu=grafik"><i class="fas fa-chart-bar me-2"></i>Grafik Pembelian</a></li>
</ul>
    </li>
</ul>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Staff: <strong><?= $_SESSION['nama']; ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light rounded-pill btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 min-vh-100">
    <?php 
    if (!isset($_GET['menu']) || $_GET['menu'] == 'dashboard') {
        // JANGAN PAKAI ECHO LAGI. 
        // Langsung panggil file home.php yang berisi Card Statistik.
        include "home.php"; 
    } else {
        // Masukkan ke dalam card putih agar tampilan menu lain (Produk/Laporan) tetap rapi
        echo '<div class="card card-custom p-4 shadow-sm border-0 bg-white">';
        include "menu.php";
        echo '</div>';
    }
    ?>
</div>

<footer class="mt-5 py-4 bg-light text-center border-top">
    <p class="small text-muted mb-0">© 2026 UMKM Sejahtera - Staff Panel.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>