<?php
include 'koneksi.php';
// Query mengambil total jumlah barang masuk per produk
$data_grafik = mysqli_query($conn, "SELECT p.nama_produk, SUM(d.jumlah) as total 
                                    FROM produk_masuk_detail d 
                                    JOIN produk p ON d.id_produk = p.id 
                                    GROUP BY d.id_produk");

$labels = [];
$values = [];

while($row = mysqli_fetch_assoc($data_grafik)){
    $labels[] = $row['nama_produk'];
    $values[] = $row['total'];
}
?>

<div class="card card-custom p-4 border-0 shadow-sm">
    <h4 class="fw-bold mb-4 text-center">Grafik Pembelian Barang Masuk</h4>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Jumlah Barang Masuk (Pcs)',
            data: <?= json_encode($values) ?>,
            backgroundColor: 'rgba(78, 115, 223, 0.5)',
            borderColor: 'rgba(78, 115, 223, 1)',
            borderWidth: 2
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>