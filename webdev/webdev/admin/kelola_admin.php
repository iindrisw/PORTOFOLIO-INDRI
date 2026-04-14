<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

// Logika Tambah Admin Baru
if (isset($_POST['tambah_admin'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $query = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$user', '$pass', '$nama')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Admin baru berhasil ditambahkan!'); window.location='kelola_admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin - BOKWIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-bg: #212529; --sidebar-hover: #343a40; --pink-main: #ff4da6; }
        body { background-color: #f4f6f9; }

        /* Sidebar Styling (Sama dengan Dashboard) */
        .sidebar { width: 280px; height: 100vh; background: var(--sidebar-bg); position: fixed; padding: 20px; color: white; }
        .sidebar h2 { color: #dc3545; font-weight: bold; font-size: 24px; text-align: center; margin-bottom: 30px; }
        .nav-link-custom { display: flex; align-items: center; padding: 12px 15px; color: #adb5bd; text-decoration: none; border-radius: 10px; margin-bottom: 5px; }
        .nav-link-custom i { margin-right: 15px; }
        .nav-link-custom:hover, .nav-link-custom.active { background: var(--sidebar-hover); color: white; }
        .nav-link-custom.active { border-left: 4px solid var(--pink-main); }
        .nav-link-custom.kelola { color: #ffc107; }

        .main-content { margin-left: 280px; padding: 30px; }
        .card-table { background: white; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>ADMIN PANEL</h2>
    <hr class="text-secondary">
    <a href="dashboard.php" class="nav-link-custom"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
    <a href="kelola_admin.php" class="nav-link-custom active kelola"><i class="bi bi-person-plus-fill"></i> <span>Kelola Admin</span></a>
    <a href="rekap_bulanan.php" class="nav-link-custom rekap"><i class="bi bi-file-earmark-pdf-fill"></i> <span>Rekap Bulanan</span></a>
    <hr class="text-secondary my-4">
    <a href="../logout.php" class="nav-link-custom text-danger"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Manajemen Akun Admin</h3>
        <button class="btn btn-warning fw-bold rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalAdmin">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Admin
        </button>
    </div>

    <div class="card card-table overflow-hidden">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $res = mysqli_query($conn, "SELECT * FROM admin ORDER BY id_admin DESC");
                while($row = mysqli_fetch_assoc($res)):
                ?>
                <tr>
                    <td class="ps-4"><?= $no++; ?></td>
                    <td><strong><?= $row['nama_lengkap']; ?></strong></td>
                    <td><code class="text-primary"><?= $row['username']; ?></code></td>
                    <td class="text-center">
                        <?php if($row['username'] != $_SESSION['admin']['username']): ?>
                            <a href="hapus_admin.php?id=<?= $row['id_admin']; ?>" class="btn btn-sm btn-outline-danger px-3 rounded-pill" onclick="return confirm('Hapus admin ini?')">Hapus</a>
                        <?php else: ?>
                            <span class="badge bg-secondary">Anda</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalAdmin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" method="POST" class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold">Tambah Admin Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="small fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Admin Baru" required>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="adminbaru" required>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" name="tambah_admin" class="btn btn-warning w-100 fw-bold">Simpan Admin</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>