<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id    = $_POST['id'];
    $user  = mysqli_real_escape_string($conn, $_POST['username']);
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $role  = $_POST['role'];
    $pass  = $_POST['password'];

    // Cek apakah password diganti atau tidak
    if (!empty($pass)) {
        $pass_hash = md5($pass); // Sesuai standar Video 4
        $query = "UPDATE staff SET 
                  username='$user', 
                  password='$pass_hash', 
                  nama='$nama', 
                  role='$role' 
                  WHERE id=$id";
    } else {
        $query = "UPDATE staff SET 
                  username='$user', 
                  nama='$nama', 
                  role='$role' 
                  WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data staff berhasil diupdate'); window.location='index.php?menu=staff';</script>";
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>