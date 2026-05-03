<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['captcha_reg_ans'])) {
    $n1 = rand(1, 9);
    $n2 = rand(1, 9);
    $_SESSION['captcha_reg_ans'] = $n1 + $n2;
    $_SESSION['captcha_reg_text'] = "$n1 + $n2 = ?";
}

if (isset($_POST['register'])) {
    if ($_POST['captcha_input'] != $_SESSION['captcha_reg_ans']) {
        echo "<script>alert('Captcha Salah!'); window.location='register.php';</script>";
        unset($_SESSION['captcha_reg_ans']);
        exit();
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 

    $query = "INSERT INTO users (username, password, nama_lengkap, level) VALUES ('$username', '$password', '$nama', 'user')";
    if (mysqli_query($conn, $query)) {
        unset($_SESSION['captcha_reg_ans']);
        header("Location: login.php?pesan=berhasil");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar | SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .hero-sm { background: #ce2127; color: white; padding: 40px 0 80px 0; text-align: center; }
        .register-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); margin-top: -50px; }
    </style>
</head>
<body>
    <nav class="navbar bg-danger py-3 shadow"><div class="container"><a class="navbar-brand text-white fw-bold" href="index.php">SI-PENGADUAN</a></div></nav>
    <section class="hero-sm"><h2 class="fw-bold">Bergabung dengan Kami</h2></section>
    <div class="container"><div class="row justify-content-center"><div class="col-md-5"><div class="register-card">
        <form method="POST">
            <div class="mb-3"><label class="form-label fw-bold small">Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
            <div class="mb-3"><label class="form-label fw-bold small">Username</label><input type="text" name="username" class="form-control" required></div>
            <div class="mb-3"><label class="form-label fw-bold small">Password</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-4 bg-light p-2 rounded">
                <label class="form-label fw-bold small text-danger">Keamanan: <?= $_SESSION['captcha_reg_text']; ?></label>
                <input type="number" name="captcha_input" class="form-control" required>
            </div>
            <button name="register" class="btn btn-danger w-100 fw-bold py-2 mb-3">DAFTAR SEKARANG</button>
            <div class="text-center"><small>Punya akun? <a href="login.php" class="text-danger fw-bold">Login</a></small></div>
        </form>
    </div></div></div></div>
</body>
</html>