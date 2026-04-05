if(isset($_POST['submit'])){
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    if($_FILES['gambar']['name'] != ""){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, "gambar/".$gambar);

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

    header("Location: index.php?menu=produk");
}