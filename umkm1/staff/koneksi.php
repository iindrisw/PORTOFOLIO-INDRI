<?php

$conn = mysqli_connect("localhost", "root", "", "db_umkm");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>