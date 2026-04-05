<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']); // Mengikuti standar video 4
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $role = $_POST['role'];

    $query = "INSERT INTO staff (username, password, nama, role) VALUES ('$user', '$pass', '$nama', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Staff berhasil ditambah'); window.location='index.php?menu=staff';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>