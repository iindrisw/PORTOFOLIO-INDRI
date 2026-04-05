<?php
include 'koneksi.php';

$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));

if (isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

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

    header("Location:  index.php?menu=produk");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Edit Produk</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" class="form-control mb-2" value="<?= $data['nama_produk'] ?>" required>
        <input type="number" name="harga" class="form-control mb-2" value="<?= $data['harga'] ?>" required>
        <input type="number" name="stok" class="form-control mb-2" value="<?= $data['stok'] ?>" required>

        <img src="gambar/<?= $data['gambar'] ?>" width="100" class="mb-2"><br>
        <input type="file" name="gambar" class="form-control mb-2">

        <button name="submit" class="btn btn-warning">Update</button>
         <a href="index.php?menu=produk" class="btn btn-secondary">Kembali</a>
    </form>
    </form>
</div>

</body>
</html>