<?php
include 'koneksi.php';
// Ambil data transaksi masuk per produk untuk grafik
$res = mysqli_query($conn, "SELECT p.nama_produk, SUM(d.jumlah) as total 
                            FROM produk_masuk_detail d 
                            JOIN produk p ON d.id_produk = p.id 
                            GROUP BY d.id_produk");

$labels = []; $values = [];
while($row = mysqli_fetch_assoc($res)){
    $labels[] = $row['nama_produk'];
    $values[] = $row['total'];
}
?>

<div class="p-3">
    <h4 class="fw-bold mb-4 text-center">Statistik Barang Masuk</h4>
    <canvas id="chartMasuk" style="max-height: 400px;"></canvas>
</div>

<script>
new Chart(document.getElementById('chartMasuk'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Total Masuk (Pcs)',
            data: <?= json_encode($values) ?>,
            backgroundColor: '#3498db'
        }]
    }
});
</script>