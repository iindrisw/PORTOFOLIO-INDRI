<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Enkripsi MD5

    // Cek apakah username atau email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username atau Email sudah digunakan!";
    } else {
        $query = "INSERT INTO users (nama_lengkap, username, email, password) 
                  VALUES ('$nama', '$username', '$email', '$password')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location='login_user.php';</script>";
        } else {
            $error = "Gagal mendaftar, coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - BOKWIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #ffe6f2; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .card { border-radius: 25px; border: none; width: 400px; }
        .btn-pink { background: #ff4da6; color: white; border-radius: 25px; border: none; padding: 10px; font-weight: bold; transition: 0.3s; }
        .btn-pink:hover { background: #e60073; color: white; }
        .form-control { border-radius: 15px; padding: 10px; }
    </style>
</head>
<body>
    <div class="card shadow-lg p-4 my-4">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color: #e60073;">Buat Akun</h3>
            <p class="text-muted small">Daftar untuk mulai booking wisata</p>
        </div>

        <?php if(isset($error)) echo "<div class='alert alert-danger small py-2'>$error</div>"; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="small fw-bold ms-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Indri Setiawati" required>
            </div>
            <div class="mb-3">
                <label class="small fw-bold ms-2">Username</label>
                <input type="text" name="username" class="form-control" placeholder="indriset" required>
            </div>
            <div class="mb-3">
                <label class="small fw-bold ms-2">Email</label>
                <input type="email" name="email" class="form-control" placeholder="indri@email.com" required>
            </div>
            <div class="mb-4">
                <label class="small fw-bold ms-2">Password</label>
                <input type="password" name="password" class="form-control" placeholder="******" required>
            </div>
            <button type="submit" name="register" class="btn btn-pink w-100 mb-3">DAFTAR SEKARANG</button>
            <p class="text-center small">Sudah punya akun? <a href="login.php" style="color: #ff4da6;">Login di sini</a></p>
        </form>
    </div>
</body>
</html>