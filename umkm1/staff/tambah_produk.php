<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Tambah Produk</h3>

    <form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Produk" required>
        <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>
        
        <input type="hidden" name="stok" value="0">
        
        <input type="file" name="gambar" class="form-control mb-2" required>

        <button name="submit" class="btn btn-success">Simpan</button>
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>