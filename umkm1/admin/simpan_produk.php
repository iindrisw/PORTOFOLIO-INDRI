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

    move_uploaded_file($tmp, "gambar/" . $nama_file_baru);

    // simpan ke database
    $query = "INSERT INTO produk (nama_produk, harga, stok, gambar)
              VALUES ('$nama', '$harga', '$stok', '$nama_file_baru')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Produk berhasil disimpan');
                window.location='produk.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>