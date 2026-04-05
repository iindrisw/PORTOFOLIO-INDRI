<?php
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
    <title>Admin Panel | UMKM Sejahtera</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        :root { --primary-color: #4e73df; --bg-soft: #f8f9fc; }
        body { background-color: var(--bg-soft); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .navbar-main { background: var(--primary-color); padding: 1rem 0; }
        .nav-link { font-weight: 500; color: rgba(255,255,255,0.85) !important; }
        .nav-link:hover { color: #fff !important; }
        
        /* Dropdown Styling */
        .dropdown-menu { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 10px; padding: 10px; }
        .dropdown-item { border-radius: 6px; padding: 10px 20px; transition: 0.2s; }
        .dropdown-item:hover { background-color: var(--bg-soft); color: var(--primary-color); }

        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .footer-dark { background: #2c3e50; color: #ecf0f1; padding: 50px 0 20px; margin-top: 80px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-main sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-store me-2"></i>UMKM ADMIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?menu=produk"><i class="fas fa-box me-1"></i> Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?menu=staff"><i class="fas fa-users me-1"></i> Staff</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="reportDrop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt me-1"></i> Laporan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reportDrop">
                        <li><a class="dropdown-item" href="index.php?menu=laporan_pembelian">Laporan Pembelian</a></li>
                        <li><a class="dropdown-item" href="index.php?menu=laporan_stok">Laporan Stok</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item fw-bold" href="index.php?menu=grafik">Ringkasan Grafik</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="text-white me-3 d-none d-md-block text-end">
                    <small class="opacity-75">Halo,</small><br>
                    <strong><?= $_SESSION['nama']; ?></strong>
                </div>
                <a href="logout.php" class="btn btn-light rounded-pill px-4 btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 min-vh-100">
    <?php if (!isset($_GET['menu']) || $_GET['menu'] == 'dashboard') { ?>
        
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card card-custom p-4 bg-white">
                    <div class="text-muted small fw-bold">TOTAL PRODUK</div>
                    <div class="h2 fw-bold mb-0">120</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 bg-white">
                    <div class="text-muted small fw-bold">TOTAL STAFF</div>
                    <div class="h2 fw-bold mb-0">8</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4 bg-white">
                    <div class="text-muted small fw-bold">TOTAL PENJUALAN</div>
                    <div class="h2 fw-bold mb-0">350</div>
                </div>
            </div>
        </div>

        <div class="card card-custom shadow-sm p-5 border-0">
            <h3 class="fw-bold">Selamat Datang di Dashboard</h3>
            <p class="text-muted">Anda login sebagai <strong><?= $_SESSION['nama']; ?></strong>. Kelola data UMKM Anda dengan mudah melalui menu di atas.</p>
        </div>

    <?php } else { include "menu.php"; } ?>
</div>

<footer class="footer-dark">
    <div class="container text-center text-md-start">
        <div class="row gy-4">
            <div class="col-md-6">
                <h4 class="fw-bold text-white mb-3">UMKM Sejahtera</h4>
                <p class="opacity-50">Sistem Manajemen Produk berbasis PHP & MySQL.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5 class="text-white mb-3">Kontak Bantuan</h5>
                <p class="small opacity-50 mb-0">Email: admin@umkm.id</p>
                <p class="small opacity-50">Telp: 0812-xxxx-xxxx</p>
            </div>
        </div>
        <hr class="my-4 opacity-25">
        <p class="text-center small opacity-50 mb-0">© 2026 Admin Panel UMKM.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>