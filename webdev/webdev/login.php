<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    // 1. Cek di tabel Admin
    $cek_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $data_admin = mysqli_fetch_assoc($cek_admin);

    if (mysqli_num_rows($cek_admin) > 0) {
        $_SESSION['admin'] = $data_admin;
        header("Location: admin/dashboard.php");
        exit();
    } 

    // 2. Cek di tabel User (bisa pakai username atau email)
    $cek_user = mysqli_query($conn, "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'");
    $data_user = mysqli_fetch_assoc($cek_user);

    if (mysqli_num_rows($cek_user) > 0) {
        $_SESSION['user'] = $data_user;
        header("Location: index.php");
        exit();
    } 

    $error = "Akun tidak ditemukan atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login BOKWIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #ffe6f2; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .card { border-radius: 25px; border: none; width: 400px; padding: 20px; }
        .btn-pink { background: #ff4da6; color: white; border-radius: 25px; border: none; padding: 12px; font-weight: bold; }
        .btn-pink:hover { background: #e60073; color: white; }
        .form-control { border-radius: 15px; padding: 12px; }
    </style>
</head>
<body>
    <div class="card shadow-lg">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #e60073;">Login</h2>
            <p class="text-muted small">Masuk ke akun BOKWIS kamu</p>
        </div>

        <?php if(isset($error)) echo "<div class='alert alert-danger small'>$error</div>"; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username atau Email" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-pink w-100 mb-3">MASUK</button>
            <p class="text-center small">Belum punya akun? <a href="register.php" style="color: #ff4da6;">Daftar di sini</a></p>
        </form>
    </div>
</body>
</html>