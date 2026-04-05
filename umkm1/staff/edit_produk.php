<?php
include 'koneksi.php';

// 1. Menangkap ID dari URL
$id = $_GET['id']; 

// 2. Query ambil data lama
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

// 3. Logika Update (Jika tombol Update diklik)
if (isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        // Mundur ke folder admin untuk simpan gambar
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

    // Gunakan script agar kembali ke dashboard yang rapi
    echo "<script>
            alert('Data Berhasil Diupdate!');
            window.location='index.php?menu=produk';
          </script>";
}
?>

<div class="container mt-4">
    <div class="card card-custom p-4 shadow-sm border-0">
        <h3 class="fw-bold mb-4"><i class="fas fa-edit me-2"></i>Edit Produk</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="<?= $row['nama_produk'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $row['harga'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $row['stok'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Gambar Saat Ini</label><br>
                <img src="../admin/gambar/<?= $row['gambar'] ?>" width="150" class="img-thumbnail mb-2">
                <input type="file" name="gambar" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            <div class="mt-4">
                <button name="submit" class="btn btn-warning fw-bold px-4">Update Data</button>
                <a href="index.php?menu=produk" class="btn btn-secondary px-4">Kembali</a>
            </div>
        </form>
    </div>
</div>