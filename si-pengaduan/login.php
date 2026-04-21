<?php
session_start();
include 'koneksi.php'; 

if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("Location: index.php");
    exit();
}

// Generate Captcha Baru jika belum ada
if (!isset($_SESSION['captcha_ans'])) {
    $n1 = rand(1, 9);
    $n2 = rand(1, 9);
    $_SESSION['captcha_ans'] = $n1 + $n2;
    $_SESSION['captcha_text'] = "$n1 + $n2 = ?";
}

if (isset($_POST['login'])) {
    // 1. Cek Captcha
    if ($_POST['captcha_input'] != $_SESSION['captcha_ans']) {
        echo "<script>alert('Jawaban Captcha Salah!'); window.location='login.php';</script>";
        unset($_SESSION['captcha_ans']);
        exit();
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id_user']      = $data['id_user'];
        $_SESSION['username']     = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['level']        = $data['level'];
        $_SESSION['status']       = "login";

        unset($_SESSION['captcha_ans']); // Hapus captcha setelah berhasil

        if ($data['level'] == 'admin') {
            header("Location: admin/validasi_admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo "<script>alert('Username/Password salah!'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #ce2127 0%, #8b151a 100%); height: 100vh; display: flex; align-items: center; font-family: 'Inter', sans-serif; }
        .login-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-card text-center">
                    <h3 class="fw-bold mb-4">SI-PENGADUAN</h3>
                    <form method="POST">
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">USERNAME</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">PASSWORD</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4 text-start bg-light p-2 rounded">
                            <label class="form-label small fw-bold text-danger">Keamanan: <?= $_SESSION['captcha_text']; ?></label>
                            <input type="number" name="captcha_input" class="form-control" placeholder="Jawaban..." required>
                        </div>
                        <button name="login" class="btn btn-danger w-100 fw-bold py-2 mb-3">MASUK</button>
                        <a href="register.php" class="text-danger small text-decoration-none">Daftar Akun Baru</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>