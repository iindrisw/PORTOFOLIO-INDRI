<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
// Sesuaikan base_url dengan folder project lo
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/uts/";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-PENGADUAN | Cirebon</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CORE STICKY FOOTER --- */
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .main-content {
            flex: 1 0 auto; /* Menarik konten agar footer tetap di bawah */
        }
        footer {
            flex-shrink: 0;
        }
        /* --- END STICKY FOOTER --- */

        .navbar-custom { 
            background-color: #ce2127; 
            padding: 12px 0; 
            border-bottom: 1px solid rgba(255,255,255,0.1); 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand { color: white !important; font-weight: 800; font-size: 1.4rem; letter-spacing: 1px; }
        .nav-link { color: rgba(255,255,255,0.9) !important; font-size: 0.95rem; transition: 0.3s; }
        .nav-link:hover { color: white !important; opacity: 1; }
        
        .dropdown-menu { border-radius: 12px; padding: 10px; }
        .dropdown-item { border-radius: 8px; font-size: 0.9rem; padding: 8px 15px; }
        
        .hero { background: #ce2127; color: white; padding: 50px 0 90px 0; text-align: center; border-bottom: 5px solid #a51a1f; }
        
        /* Utility */
        .btn-lapor { background-color: white !important; color: #ce2127 !important; font-weight: bold; border-radius: 50px; }
        .btn-lapor:hover { background-color: #f8f9fa !important; transform: scale(1.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= $base_url; ?>index.php">SI-PENGADUAN</a>
            
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="dropdown" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php">Home</a></li>
                    
                    <?php if(isset($_SESSION['status']) && $_SESSION['status'] == "login"): ?>
                        
                        <?php if($_SESSION['level'] == 'user'): ?>
                            <li class="nav-item">
                                <a class="nav-link btn-lapor px-4 ms-lg-3 shadow-sm" href="<?= $base_url; ?>user/lapor.php">LAPOR!</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ms-lg-2" href="<?= $base_url; ?>user/cek_status.php">Status Laporan</a>
                            </li>
                        <?php elseif($_SESSION['level'] == 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link text-warning fw-bold ms-lg-3" href="<?= $base_url; ?>admin/validasi_admin.php">
                                    <i class="bi bi-speedometer2 me-1"></i> Panel Admin
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item dropdown ms-lg-3 mt-2 mt-lg-0">
                            <a class="nav-link dropdown-toggle btn btn-outline-light btn-sm px-3 text-white" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> Hi, <?= explode(' ', $_SESSION['nama_lengkap'])[0]; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item" href="<?= $base_url; ?>profile.php">
                                        <i class="bi bi-person-gear me-2"></i> Edit Profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= $base_url; ?>logout.php">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm text-white px-4 ms-lg-3 mt-2 mt-lg-0 rounded-pill" href="<?= $base_url; ?>login.php">
                                LOGIN / DAFTAR
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">