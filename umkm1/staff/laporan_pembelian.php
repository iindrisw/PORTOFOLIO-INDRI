<?php
include 'koneksi.php';

// Perhatikan pm.id_stafff (f-nya tiga sesuai sebutanmu) 
// dan s.id (karena di tabel staff namanya cuma 'id')
$sql = "SELECT pm.tanggal, p.nama_produk, d.jumlah, s.nama as nama_staff
        FROM produk_masuk_detail d
        JOIN produk_masuk pm ON d.id_masuk = pm.id_masuk 
        JOIN produk p ON d.id_produk = p.id
        LEFT JOIN staff s ON pm.id_staff = s.id 
        ORDER BY pm.id_masuk DESC";
        

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Query Error: " . mysqli_error($conn) . "<br>Cek apakah kolom id_staff sudah ada di tabel produk_masuk!");
}
?>

<table class="table table-bordered" id="tabelLaporan">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Petugas (Staff)</th> </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; 
        while($row = mysqli_fetch_assoc($query)) { 
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><?= $row['nama_staff'] ?? 'Tidak Diketahui' ?></td> </tr>
        <?php } ?>
    </tbody>
</table>