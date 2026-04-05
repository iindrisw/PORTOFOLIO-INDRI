<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {

    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    // upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // rename file biar unik
    $nama_file_baru = time() . "_" . $gambar;

    // FIX 1: Mundur satu folder ke folder admin/gambar
    if (move_uploaded_file($tmp, "../admin/gambar/" . $nama_file_baru)) {
        
        // FIX 2: Jalankan query dengan mysqli_query
        $sql = "INSERT INTO produk (nama_produk, harga, stok, gambar)
                VALUES ('$nama', '$harga', '$stok', '$nama_file_baru')";
        
        $eksekusi = mysqli_query($conn, $sql);

        if ($eksekusi) {
            // FIX 3: Redirect ke index agar tampilan tetap cantik
            echo "<script>
                    alert('Data Berhasil Disimpan!');
                    window.location='index.php?menu=produk'; 
                  </script>";
        } else {
            echo "Gagal Simpan ke Database: " . mysqli_error($conn);
        }
        
    } else {
        echo "Gagal Upload Gambar! Pastikan folder ../admin/gambar/ tersedia.";
    }
}
?>