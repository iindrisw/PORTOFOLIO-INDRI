<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_pengaduan";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// TAMBAHKAN INI: Biar link di Navbar & Sidebar nggak pecah/404
$base_url = "http://localhost/uts/"; 
?>