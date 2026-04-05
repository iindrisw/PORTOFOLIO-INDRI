<?php
include 'admin/koneksi.php'; // Pastikan jalur koneksi benar
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Sejahtera - Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-produk { border: none; border-radius: 10px; transition: 0.3s; }
        .card-produk:hover { transform: translateY(-5px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .harga { color: #ee4d2d; font-weight: bold; }
        .img-produk { height: 180px; object-fit: cover; border-radius: 10px 10px 0 0; }
        .stok-habis { filter: grayscale(100%); opacity: 0.6; } /* Efek visual barang habis */
        a { text-decoration: none; color: inherit; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php">UMKM KITA</a>
        <form class="d-flex flex-grow-1 mx-lg-4 my-2 my-lg-0">
            <input class="form-control me-2" type="search" placeholder="Cari barang apa hari ini?" aria-label="Search">
        </form>
        <div class="d-flex">
            <div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Login
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="admin/login.php">Login Admin</a></li>
        
        <li><a class="dropdown-item" href="staff/login.php">Login Staff</a></li>
        
        <li><hr class="dropdown-divider"></li>
        
        <li><a class="dropdown-item disabled" href="#">Login Pelanggan</a></li>
    </ul>
</div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h5 class="fw-bold mb-3">Kategori Produk</h5>
    <div class="row text-center mb-4">
        <div class="col-3">
            <a href="index.php?kategori=Makanan">
                <div class="p-2 bg-white rounded shadow-sm">🍎<br><small>Makanan</small></div>
            </a>
        </div>
        <div class="col-3">
            <a href="index.php?kategori=Minuman">
                <div class="p-2 bg-white rounded shadow-sm">🥤<br><small>Minuman</small></div>
            </a>
        </div>
        <div class="col-3">
            <a href="index.php?kategori=Fashion">
                <div class="p-2 bg-white rounded shadow-sm">👕<br><small>Fashion</small></div>
            </a>
        </div>
        <div class="col-3">
            <a href="index.php">
                <div class="p-2 bg-white rounded shadow-sm">📦<br><small>Semua</small></div>
            </a>
        </div>
    </div>

    <h5 class="fw-bold mb-3">
        <?= isset($_GET['kategori']) ? "Kategori: " . $_GET['kategori'] : "Produk Terbaru" ?>
    </h5>
    
    <div class="row g-3"> 
        <?php
        // LOGIKA FILTER KATEGORI
        $kat = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        if ($kat != '') {
            $sql = "SELECT * FROM produk WHERE kategori = '$kat' ORDER BY id DESC";
        } else {
            $sql = "SELECT * FROM produk ORDER BY id DESC";
        }
        
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)) {
            $is_habis = ($row['stok'] <= 0); // Cek apakah stok 0
        ?>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 card-produk shadow-sm">
                <img src="admin/gambar/<?= str_replace(' ', '%20', $row['gambar']) ?>" 
                     class="card-img-top img-produk <?= $is_habis ? 'stok-habis' : '' ?>">
                
                <div class="card-body p-2 d-flex flex-column">
                    <p class="card-title mb-1 text-truncate fw-bold"><?= $row['nama_produk'] ?></p>
                    <p class="harga mb-1">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    
                    <small class="mb-2 <?= $is_habis ? 'text-danger' : 'text-muted' ?>">
                        Stok: <?= $row['stok'] ?> <?= $is_habis ? '(Habis)' : '' ?>
                    </small>

                    <?php if (!$is_habis) : ?>
                        <a href="keranjang.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm mt-auto w-100">Beli Sekarang</a>
                    <?php else : ?>
                        <button class="btn btn-secondary btn-sm mt-auto w-100" disabled>Stok Habis</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>