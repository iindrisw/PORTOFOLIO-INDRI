<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

// Ambil data statistik
$total_destinasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM destinasi"));
$total_booking = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM booking"));
$total_ulasan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM review"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BOKWIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-bg: #212529; --sidebar-hover: #343a40; --pink-main: #ff4da6; }
        body { background-color: #f4f6f9; overflow-x: hidden; }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            padding: 20px;
            color: white;
            z-index: 1000;
        }
        .sidebar h2 { color: #dc3545; font-weight: bold; font-size: 24px; text-align: center; margin-bottom: 30px; }
        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: 0.3s;
        }
        .nav-link-custom i { margin-right: 15px; font-size: 18px; }
        .nav-link-custom:hover, .nav-link-custom.active {
            background-color: var(--sidebar-hover);
            color: white;
        }
        .nav-link-custom.active { background-color: #343a40; border-left: 4px solid var(--pink-main); }
        .nav-link-custom.kelola { color: #ffc107; }
        .nav-link-custom.rekap { color: #0dcaf0; }
        .nav-link-custom.logout { color: #dc3545; margin-top: 50px; }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
        }
        .card-stat { border: none; border-radius: 15px; transition: 0.3s; color: white; }
        .table-custom { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 10px; }
            .sidebar h2, .nav-link-custom span { display: none; }
            .main-content { margin-left: 70px; }
        }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <h2>ADMIN PANEL</h2>
    <hr class="text-secondary">
    
    <a href="dashboard.php" class="nav-link-custom active">
        <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
    </a>
    <a href="kelola_admin.php" class="nav-link-custom kelola">
        <i class="bi bi-person-plus-fill"></i> <span>Kelola Admin</span>
    </a>
    <a href="rekap_bulanan.php" class="nav-link-custom rekap">
        <i class="bi bi-file-earmark-pdf-fill"></i> <span>Rekap Bulanan</span>
    </a>
    
    <hr class="text-secondary my-4">
    
    <a href="../index.php" class="nav-link-custom">
        <i class="bi bi-globe"></i> <span>Lihat Web</span>
    </a>
    <a href="profil.php" class="nav-link-custom">
        <i class="bi bi-person-circle"></i> <span>Profil Saya</span>
    </a>
    
    <a href="../logout.php" class="nav-link-custom logout" onclick="return confirm('Yakin ingin logout?')">
        <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
    </a>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Selamat Datang, <?= $_SESSION['admin']['nama_lengkap']; ?>!</h3>
        <div class="text-muted small"><?= date('l, d F Y'); ?></div>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card card-stat bg-primary p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h6 class="small opacity-75">DESTINASI</h6><h3><?= $total_destinasi; ?></h3></div>
                    <i class="bi bi-geo-alt fs-1 opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat bg-success p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h6 class="small opacity-75">BOOKING</h6><h3><?= $total_booking; ?></h3></div>
                    <i class="bi bi-ticket-perforated fs-1 opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat bg-warning text-dark p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h6 class="small opacity-75">ULASAN</h6><h3><?= $total_ulasan; ?></h3></div>
                    <i class="bi bi-star fs-1 opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Manajemen Destinasi</h4>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-2"></i> Tambah Wisata
        </button>
    </div>

    <div class="table-responsive table-custom p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4 py-3">Wisata</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM destinasi ORDER BY id_destinasi DESC");
                while($d = mysqli_fetch_assoc($query)):
                ?>
                <tr>
                    <td class="ps-4"><strong><?= $d['nama_wisata']; ?></strong></td>
                    <td><span class="badge bg-light text-dark border"><?= $d['kategori']; ?></span></td>
                    <td>Rp <?= number_format($d['harga_tiket']); ?></td>
                    <td><img src="../foto/<?= $d['gambar']; ?>" width="60" class="rounded shadow-sm"></td>
                    <td class="text-center">
                        <a href="edit_destinasi.php?id=<?= $d['id_destinasi']; ?>" class="btn btn-sm btn-warning text-white rounded-pill px-3">EDIT</a>
                        <a href="hapus_destinasi.php?id=<?= $d['id_destinasi']; ?>" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Hapus?')">HAPUS</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header bg-primary text-white"><h5>Tambah Destinasi</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body p-4">
                <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Wisata" required>
                <select name="kategori" class="form-select mb-3">
                    <option value="Pantai">Pantai</option>
                    <option value="Gunung">Gunung</option>
                    <option value="Alam">Alam</option>
                </select>
                <input type="number" name="harga" class="form-control mb-3" placeholder="Harga Tiket" required>
                <textarea name="deskripsi" class="form-control mb-3" placeholder="Deskripsi..."></textarea>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Simpan Data</button></div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>