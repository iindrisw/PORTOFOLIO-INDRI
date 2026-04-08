<?php 
include '../koneksi.php';
session_start();

// Proteksi Admin
if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") {
    header("Location: ../login.php");
    exit();
}

// Statistik
$total_laporan   = mysqli_num_rows(mysqli_query($conn, "SELECT id_laporan FROM laporan"));
$laporan_pending = mysqli_num_rows(mysqli_query($conn, "SELECT id_laporan FROM laporan WHERE status='pending'"));
$laporan_selesai = mysqli_num_rows(mysqli_query($conn, "SELECT id_laporan FROM laporan WHERE status='selesai'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* CSS INI HARUS SAMA PERSIS DENGAN KELOLA_ADMIN.PHP */
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .sidebar { background: #212529; min-height: 100vh; color: white; padding: 20px; position: fixed; width: 16.666%; }
        .nav-link { color: rgba(255,255,255,0.7); margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        
        /* Style Tambahan Validasi */
        .card-stat { border: none; border-radius: 15px; transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
        .clickable-row { cursor: pointer; }
        .clickable-row:hover { background-color: #f8f9fa !important; }
        .no-click { position: relative; z-index: 5; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0">
            <div class="sidebar shadow">
                <h4 class="fw-bold mb-4 text-danger text-center">ADMIN PANEL</h4>
                <hr>
                <div class="nav flex-column">
                    <a href="validasi_admin.php" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a href="kelola_admin.php" class="nav-link text-warning"><i class="bi bi-person-plus-fill me-2"></i> Kelola Admin</a>
                    <a href="laporan_bulanan.php" class="nav-link text-info"><i class="bi bi-file-earmark-pdf me-2"></i> Rekap Bulanan</a>
                    <hr>
                    <a href="../index.php" class="nav-link"><i class="bi bi-globe me-2"></i> Lihat Web</a>
                    <a href=".../profile.php" class="nav-link">Profil Saya</a>
                    <a href="../logout.php" class="nav-link text-danger mt-5"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-10 offset-md-2 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Manajemen Laporan</h2>
                <span class="badge bg-white text-dark shadow-sm p-2 px-3 border rounded-pill">
                    Admin: <strong><?= $_SESSION['nama_lengkap']; ?></strong>
                </span>
            </div>

            <div class="row mb-5 text-center">
                <div class="col-md-4">
                    <div class="card card-stat shadow-sm p-3">
                        <small class="text-muted fw-bold">TOTAL LAPORAN</small>
                        <h2 class="fw-bold m-0"><?= $total_laporan; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat shadow-sm p-3 border-start border-danger border-5">
                        <small class="text-muted fw-bold text-danger">BELUM DIPROSES</small>
                        <h2 class="fw-bold m-0 text-danger"><?= $laporan_pending; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat shadow-sm p-3 border-start border-success border-5">
                        <small class="text-muted fw-bold text-success">SUDAH SELESAI</small>
                        <h2 class="fw-bold m-0 text-success"><?= $laporan_selesai; ?></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Pelapor</th>
                                <th>Detail</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = mysqli_query($conn, "SELECT laporan.*, users.nama_lengkap FROM laporan JOIN users ON laporan.id_user = users.id_user ORDER BY created_at DESC");
                            while($data = mysqli_fetch_assoc($sql)) :
                            ?>
                            <tr class="clickable-row" onclick="window.location='../detail_laporan.php?id=<?= $data['id_laporan']; ?>'">
                                <td class="ps-4">
                                    <div class="fw-bold"><?= explode(' ', $data['nama_lengkap'])[0]; ?></div>
                                    <small class="text-muted"><?= date('d/m/y', strtotime($data['created_at'])); ?></small>
                                </td>
                                <td>
                                    <div class="small fw-bold text-truncate" style="max-width: 150px;"><?= $data['judul']; ?></div>
                                </td>
                                <td><span class="badge bg-light text-danger border rounded-pill"><?= $data['kategori']; ?></span></td>
                                <td>
                                    <?php if($data['foto']) : ?>
                                        <img src="../assets/img/<?= $data['foto']; ?>" width="40" height="40" class="rounded object-fit-cover shadow-sm">
                                    <?php endif; ?>
                                </td>
                                <td class="no-click" onclick="event.stopPropagation();">
                                    <form action="update_status.php" method="POST">
    <input type="hidden" name="id_laporan" value="<?= $data['id_laporan']; ?>">
    <select name="status" class="form-select form-select-sm rounded-pill fw-bold shadow-sm" 
            onchange="this.form.submit()" 
            style="font-size: 0.75rem; width: 110px; cursor: pointer; 
            background-color: <?= ($data['status']=='pending' ? '#f8d7da' : ($data['status']=='proses' ? '#fff3cd' : '#d1e7dd')); ?>; 
            color: <?= ($data['status']=='pending' ? '#842029' : ($data['status']=='proses' ? '#664d03' : '#0f5132')); ?>; 
            border: 1px solid currentColor;">
            
        <option value="pending" <?= ($data['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
        <option value="proses" <?= ($data['status'] == 'proses') ? 'selected' : ''; ?>>Proses</option>
        <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
    </select>
</form>
                                </td>
                                <td class="text-center no-click" onclick="event.stopPropagation();">
                                    <a href="balas_laporan.php?id=<?= $data['id_laporan']; ?>" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">BALAS</a>
                                    <a href="hapus_laporan.php?id=<?= $data['id_laporan']; ?>" class="btn btn-sm btn-light text-danger rounded-circle ms-1" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>