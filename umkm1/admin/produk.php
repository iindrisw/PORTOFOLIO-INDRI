<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM produk");
?>


<div class="container mt-4">
    <h3>Data Produk</h3>

    <a href="tambah_produk.php" class="btn btn-primary mb-3">+ Tambah Produk</a>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <table id="tabelProduk" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr class="text-center">
            <td><?= $no++ ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td>Rp <?= number_format($row['harga']) ?></td>

            <!-- STOK -->
            <td>
                <?php if($row['stok'] > 10){ ?>
                    <span class="badge bg-success"><?= $row['stok'] ?></span>
                <?php } else if($row['stok'] > 0){ ?>
                    <span class="badge bg-warning text-dark"><?= $row['stok'] ?></span>
                <?php } else { ?>
                    <span class="badge bg-danger">Habis</span>
                <?php } ?>
            </td>

            <!-- GAMBAR -->
            <td>
                <img src="gambar/<?= $row['gambar'] ?>" width="80">
            </td>

            <!-- AKSI -->
            <td>
                <a href="index.php?menu=edit_produk&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus_produk.php?id=<?= $row['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabelProduk').DataTable();
});
</script>

