<?php
session_start();
include 'koneksi.php';

// cek apakah form dikirim
if (!isset($_POST['username'], $_POST['password'], $_POST['captcha'])) {
    header("Location: login.php");
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5($_POST['password']);
$captcha_input = $_POST['captcha'];

// cek captcha
if (!isset($_SESSION['captcha']) || $captcha_input != $_SESSION['captcha']) {
    echo "<script>alert('Captcha salah!'); window.location='login.php';</script>";
    exit;
}

// query login
$query = mysqli_query($conn, "
    SELECT * FROM staff 
    WHERE username='$username' 
    AND password='$password'
");

// cek query error
if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

// ambil data
$data = mysqli_fetch_assoc($query);

// validasi login
if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
}
?>