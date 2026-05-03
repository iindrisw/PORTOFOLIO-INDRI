<?php 
include '../koneksi.php';
session_start();

// Proteksi Admin
if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") {
    header("Location: ../login.php");
    exit();
}

// PROSES TAMBAH ADMIN BARU
if (isset($_POST['tambah_admin'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $user     = mysqli_real_escape_string($conn, $_POST['username']);
    $pass     = mysqli_real_escape_string($conn, $_POST['password']);
    $level    = "admin"; // Otomatis set jadi admin

    $query = "INSERT INTO users (nama_lengkap, username, password, level) VALUES ('$nama', '$user', '$pass', '$level')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Admin baru berhasil ditambahkan!'); window.location='kelola_admin.php';</script>";
    }
}

// PROSES HAPUS ADMIN
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Jangan biarkan admin hapus dirinya sendiri biar gak kekunci keluar
    if ($id == $_SESSION['id_user']) {
        echo "<script>alert('Gak bisa hapus diri sendiri, Yes!'); window.location='kelola_admin.php';</script>";
    } else {
        mysqli_query($conn, "DELETE FROM users WHERE id_user='$id'");
        header("Location: kelola_admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin | SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .sidebar { background: #212529; min-height: 100vh; color: white; padding: 20px; position: fixed; width: 16.666%; }
        .nav-link { color: rgba(255,255,255,0.7); margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
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
                    <a href="validasi_admin.php" class="nav-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a href="kelola_admin.php" class="nav-link active text-warning"><i class="bi bi-person-plus-fill me-2"></i> Kelola Admin</a>
                    <a href="laporan_bulanan.php" class="nav-link text-info"><i class="bi bi-file-earmark-pdf me-2"></i> Rekap Bulanan</a>
                    <hr>
                    <a href="../index.php" class="nav-link"><i class="bi bi-globe me-2"></i> Lihat Web</a>
                    <a href="../profile.php" class="nav-link">Profil Saya</a>
                    <a href="../logout.php" class="nav-link text-danger mt-5"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-10 offset-md-2 p-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-3">Tambah Admin Baru</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">NAMA LENGKAP</label>
                                <input type="text" name="nama_lengkap" class="form-control form-control-sm shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">USERNAME</label>
                                <input type="text" name="username" class="form-control form-control-sm shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">PASSWORD</label>
                                <input type="password" name="password" class="form-control form-control-sm shadow-none" required>
                            </div>
                            <button name="tambah_admin" class="btn btn-danger btn-sm w-100 rounded-pill fw-bold">SIMPAN ADMIN</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-white py-3 border-0">
                            <h5 class="fw-bold m-0">Daftar Akun Admin</h5>
                        </div>
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="small text-muted text-uppercase">
                                    <th class="ps-4">Nama Lengkap</th>
                                    <th>Username</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = mysqli_query($conn, "SELECT * FROM users WHERE level='admin' ORDER BY id_user DESC");
                                while($d = mysqli_fetch_assoc($sql)) :
                                ?>
                                <tr>
                                    <td class="ps-4 fw-bold"><?= $d['nama_lengkap']; ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= $d['username']; ?></span></td>
                                    <td class="text-center">
                                        <?php if($d['id_user'] != $_SESSION['id_user']) : ?>
                                            <a href="kelola_admin.php?hapus=<?= $d['id_user']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus admin ini, Yes?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php else : ?>
                                            <span class="badge bg-success-subtle text-success small" style="font-size: 0.6rem;">YOU</span>
                                        <?php endif; ?>
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
</div>

</body>
</html>