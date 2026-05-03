<?php 
include 'koneksi.php';
session_start();

// Proteksi: Harus Login
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$level   = $_SESSION['level'];

// 1. AMBIL DATA USER TERBARU
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($user_query);

// 2. PROSES UPDATE
if (isset($_POST['update_profile'])) {
    $nama_baru = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $user_baru = mysqli_real_escape_string($conn, $_POST['username']);
    $pass_baru = $_POST['password'];

    // Jika password diisi, update password juga. Jika kosong, pakai yang lama.
    if (!empty($pass_baru)) {
        $update = mysqli_query($conn, "UPDATE users SET nama_lengkap='$nama_baru', username='$user_baru', password='$pass_baru' WHERE id_user='$id_user'");
    } else {
        $update = mysqli_query($conn, "UPDATE users SET nama_lengkap='$nama_baru', username='$user_baru' WHERE id_user='$id_user'");
    }

    if ($update) {
        // Update Session biar nama di Navbar langsung berubah
        $_SESSION['nama_lengkap'] = $nama_baru;
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profile.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil | SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .card-profile { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .avatar-circle { width: 100px; height: 100px; background: #ce2127; color: white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; margin: 0 auto 20px; border-radius: 50%; border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        /* Style khusus Admin Sidebar */
        .sidebar { background: #212529; min-height: 100vh; color: white; padding: 20px; position: fixed; width: 16.666%; }
        .nav-link { color: rgba(255,255,255,0.7); margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>

<?php if($level == 'admin') : ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                <div class="sidebar shadow">
                    <h4 class="fw-bold mb-4 text-danger text-center">ADMIN PANEL</h4>
                    <hr>
                    <div class="nav flex-column">
                    <a href="admin/validasi_admin.php" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a href="admin/kelola_admin.php" class="nav-link text-warning"><i class="bi bi-person-plus-fill me-2"></i> Kelola Admin</a>
                    <a href="admin/laporan_bulanan.php" class="nav-link text-info"><i class="bi bi-file-earmark-pdf me-2"></i> Rekap Bulanan</a>
                    <hr>
                    <a href="index.php" class="nav-link"><i class="bi bi-globe me-2"></i> Lihat Web</a>
                    <a href="profile.php" class="nav-link">Profil Saya</a>
                    <a href="logout.php" class="nav-link text-danger mt-5"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-2 p-5">
<?php else : ?>
    <?php include 'layout/header.php'; ?>
    <div class="container py-5">
<?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-profile p-4 p-md-5 bg-white mt-4">
                <div class="text-center">
                    <div class="avatar-circle">
                        <?= strtoupper(substr($data['nama_lengkap'], 0, 1)); ?>
                    </div>
                    <h4 class="fw-bold m-0"><?= $data['nama_lengkap']; ?></h4>
                    <span class="badge bg-light text-muted border mb-4 text-uppercase"><?= $data['level']; ?></span>
                </div>

                <form method="POST">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted">NAMA LENGKAP</label>
                        <input type="text" name="nama_lengkap" class="form-control border-2 shadow-none" value="<?= $data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted">USERNAME</label>
                        <input type="text" name="username" class="form-control border-2 shadow-none" value="<?= $data['username']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted">GANTI PASSWORD (Kosongkan jika tidak diganti)</label>
                        <input type="password" name="password" class="form-control border-2 shadow-none" placeholder="Password baru...">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" name="update_profile" class="btn btn-danger py-3 fw-bold rounded-pill shadow">SIMPAN PERUBAHAN</button>
                        <?php if($level == 'user') : ?>
                            <a href="index.php" class="btn btn-light border py-2 fw-bold rounded-pill text-muted">KEMBALI</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php if($level == 'admin') : ?>
            </div>
        </div>
    </div>
<?php else : ?>
    </div>
    <?php include 'layout/footer.php'; ?>
<?php endif; ?>

</body>
</html>