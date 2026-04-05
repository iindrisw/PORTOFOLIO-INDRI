<?php
include 'koneksi.php';
// Ambil data produk untuk pilihan di dropdown
$produk_query = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="container mt-4">
    <div class="card card-custom p-4 shadow-sm border-0 mb-4">
        <h4 class="fw-bold mb-4"><i class="fas fa-truck-loading me-2 text-primary"></i> Input Transaksi Barang Masuk</h4>
        
        <form action="tambah_keranjang.php" method="POST" class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Pilih Produk</label>
                <select name="id_produk" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    <?php while($p = mysqli_fetch_assoc($produk_query)) { ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama_produk'] ?> (Stok: <?= $p['stok'] ?>)</option>
    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Jumlah Masuk</label>
                <input type="number" name="jumlah" class="form-control" placeholder="0" min="1" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" name="tambah" class="btn btn-primary w-100 fw-bold">+ Keranjang</button>
            </div>
        </form>
    </div>

    <div class="card card-custom p-4 shadow-sm border-0">
        <h5 class="fw-bold mb-3">Isi Keranjang Transaksi</h5>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if (!empty($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $id => $val) {
            // Kita bungkus query-nya supaya kalau gagal nggak bikin error fatal
            // PASTIKAN: Kalau di tabel produk kolomnya 'id', pakai 'id'. Kalau 'id_produk', pakai 'id_produk'.
            $res = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
            
            // Cek apakah datanya beneran ketemu
            if ($res && mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $nama_tampil = $row['nama_produk'];
            } else {
                $nama_tampil = "Produk Hilang (ID: $id)";
            }
    ?>
        <tr>
            <td><?= $nama_tampil ?></td>
            <td class="text-center"><?= $val ?></td>
            <td class="text-center">
                <a href="hapus_keranjang.php?id=<?= $id ?>" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
</a>
            </td>
        </tr>
    <?php 
        } 
    } else {
        echo "<tr><td colspan='3' class='text-center text-muted italic'>Keranjang masih kosong</td></tr>";
    }
    ?>
</tbody>
        </table>

        <?php if (!empty($_SESSION['keranjang'])) { ?>
            <div class="text-end mt-3">
                <a href="simpan_transaksi.php" class="btn btn-success btn-lg fw-bold" onclick="return confirm('Simpan transaksi ini?')">
                    <i class="fas fa-save me-2"></i> Simpan & Update Stok
                </a>
            </div>
        <?php } ?>
    </div>
</div>