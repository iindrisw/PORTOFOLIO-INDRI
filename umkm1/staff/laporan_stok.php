<?php
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY stok ASC");
?>
<div class="card card-custom p-4 border-0 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="fas fa-file-invoice text-primary me-2"></i> Laporan Stok Barang</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>
    
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Produk</th>
                <th class="text-center">Sisa Stok</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)) { 
                $status = ($row['stok'] < 5) ? "<span class='badge bg-danger'>Hampir Habis</span>" : "<span class='badge bg-success'>Aman</span>";
                $warna_stok = ($row['stok'] < 5) ? "text-danger fw-bold" : "text-success";
            ?>
            <tr>
                <td><?= $row['nama_produk'] ?></td>
                <td class="text-center <?= $warna_stok ?>"><?= $row['stok'] ?> Pcs</td>
                <td><?= $status ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>