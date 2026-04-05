if(isset($_POST['submit'])){
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    if($_FILES['gambar']['name'] != ""){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // FIX: Mundur satu folder ke folder admin/gambar
        move_uploaded_file($tmp, "../admin/gambar/".$gambar);

        mysqli_query($conn, "UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            stok='$stok',
            gambar='$gambar'
            WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            stok='$stok'
            WHERE id=$id");
    }

    // FIX: Gunakan JavaScript agar kembali ke bingkai dashboard yang benar
    echo "<script>
            alert('Data Berhasil Diupdate!');
            window.location='index.php?menu=produk';
          </script>";
}