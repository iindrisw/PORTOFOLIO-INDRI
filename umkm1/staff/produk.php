<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="card card-custom p-4 border-0 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="fas fa-box text-primary me-2"></i> Data Produk</h3>
        <a href="index.php?menu=tambah_produk" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="table-responsive">
        <table id="tabelProduk" class="table table-hover align-middle">
            <thead class="table-light">
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
                <td class="text-start fw-bold"><?= $row['nama_produk'] ?></td>
                <td>Rp <?= number_format($row['harga']) ?></td>

                <td>
                    <?php if($row['stok'] > 10){ ?>
                        <span class="badge bg-success px-3"><?= $row['stok'] ?></span>
                    <?php } else if($row['stok'] > 0){ ?>
                        <span class="badge bg-warning text-dark px-3"><?= $row['stok'] ?></span>
                    <?php } else { ?>
                        <span class="badge bg-danger px-3">Habis</span>
                    <?php } ?>
                </td>

                <td>
                    <img src="../admin/gambar/<?= $row['gambar'] ?>" width="60" class="img-thumbnail shadow-sm">
                </td>

                <td>
                    <a href="index.php?menu=edit_produk&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="hapus_produk.php?id=<?= $row['id'] ?>" 
                       class="btn btn-danger btn-sm rounded-pill"
                       onclick="return confirm('Yakin ingin hapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cek dulu apakah DataTable sudah ada untuk menghindari error "cannot reinitialise"
    if ( ! $.fn.DataTable.isDataTable( '#tabelProduk' ) ) {
        $('#tabelProduk').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    }
});
</script>