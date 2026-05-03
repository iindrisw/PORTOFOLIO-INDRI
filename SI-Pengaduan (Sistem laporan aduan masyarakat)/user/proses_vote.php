<?php
include 'koneksi.php';
session_start();

// 1. CEK LOGIN
if (!isset($_SESSION['status'])) {
    echo "<script>alert('Login dulu, Yes!'); window.location='login.php';</script>";
    exit;
}

// Pastikan di login.php lo pake $_SESSION['id_user'] atau $_SESSION['id_users']
// Sesuaikan dengan variabel session yang lo punya
$user_login = $_SESSION['id_user']; 
$id_comment = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$type       = isset($_GET['type']) ? mysqli_real_escape_string($conn, $_GET['type']) : '';

if (empty($id_comment) || empty($type)) { header("Location: index.php"); exit; }

// 2. CEK APAKAH SUDAH VOTE (Pake id_users sesuai gambar database lo)
$cek = mysqli_query($conn, "SELECT * FROM comment_votes WHERE id_users = '$user_login' AND id_comment = '$id_comment'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Cukup 1x saja, Yes!'); window.location='index.php';</script>";
} else {
    // 3. PROSES INSERT
    $sql_insert = "INSERT INTO comment_votes (id_users, id_comment, vote_type) VALUES ('$user_login', '$id_comment', '$type')";
    
    if (mysqli_query($conn, $sql_insert)) {
        // 4. UPDATE TABEL COMMENTS
        $kolom = ($type == 'like') ? 'likes' : 'dislikes';
        mysqli_query($conn, "UPDATE comments SET $kolom = $kolom + 1 WHERE id_comment = '$id_comment'");
        
        header("Location: index.php");
    } else {
        die("Gagal simpan vote: " . mysqli_error($conn));
    }
}
?>