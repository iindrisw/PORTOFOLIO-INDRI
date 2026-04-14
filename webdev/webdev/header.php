<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bokwis Ciayumajakuning - Wisata Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { 
            --pink-main: #ff4da6; 
            --pink-dark: #e60073; 
            --pink-light: #ffe6f2; 
        }

        body { 
            font-family: 'Segoe UI', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        
        /* Navbar Styling */
        .navbar { 
            background: linear-gradient(90deg, var(--pink-dark), var(--pink-main)); 
            z-index: 1050; 
        }
        .nav-link { 
            color: rgba(255,255,255,0.9) !important; 
            font-weight: 500;
        }
        .nav-link:hover { 
            color: #fff !important; 
        }

        /* Carousel Styling */
        .carousel-item { height: 500px; }
        .carousel-item img { object-fit: cover; height: 100%; filter: brightness(65%); }
        .carousel-caption { 
            bottom: 30%; 
            background: rgba(0,0,0,0.3); 
            border-radius: 20px; 
            padding: 25px; 
            backdrop-filter: blur(5px); 
        }

        /* Global Card Styling */
        .card-kategori { 
            background-color: var(--pink-light); 
            border: none; 
            border-radius: 20px; 
            transition: 0.3s; 
            text-align: center; 
            padding: 20px; 
        }
        .card-kategori:hover { 
            background-color: var(--pink-main); 
            transform: translateY(-5px); 
        }
        .card-kategori:hover h5 { color: white !important; }

        .card-destinasi { 
            border: none; 
            border-radius: 20px; 
            transition: 0.3s; 
            overflow: hidden; 
            background: white; 
        }
        .card-destinasi:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        .img-card { height: 210px; object-fit: cover; }
        
        /* Buttons */
        .btn-pink { 
            background: var(--pink-main); 
            color: white; 
            border-radius: 25px; 
            border: none; 
            padding: 8px 20px; 
            font-weight: bold; 
        }
        .btn-pink:hover { background: var(--pink-dark); color: white; }

        /* Detail Page Styling */
        .img-main { width: 100%; height: 400px; object-fit: cover; border-radius: 25px; }
        .sticky-wrapper { 
            position: -webkit-sticky; 
            position: sticky; 
            top: 90px; 
            z-index: 10; 
        }
        .badge-hot { 
            position: absolute; 
            top: 15px; 
            right: 15px; 
            background: var(--pink-dark); 
            color: white; 
            padding: 4px 12px; 
            border-radius: 20px; 
            font-size: 11px; 
            font-weight: bold; 
            z-index: 5;
        }

        @media (max-width: 768px) {
            .carousel-item { height: 300px; }
            .sticky-wrapper { position: static; margin-top: 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">💖 BOKWIS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-center align-items-center">
        <li class="nav-item">
            <a class="nav-link px-3" href="index.php">Beranda</a>
        </li>
        
        <?php if(isset($_SESSION['admin'])): ?>
            <li class="nav-item">
                <a class="nav-link fw-bold text-warning" href="admin/dashboard.php">Panel Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
        <?php elseif(isset($_SESSION['user'])): ?>
            <li class="nav-item">
                <a class="nav-link fw-bold text-warning" href="#">Hi, <?= $_SESSION['user']['username']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link px-3" href="login.php">Login</a>
            </li>
            <li class="nav-item ms-lg-2">
                <a class="nav-link fw-bold text-white btn btn-outline-light btn-sm px-4" href="register.php" style="border-radius:20px;">Daftar</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-top: 60px;"></div>