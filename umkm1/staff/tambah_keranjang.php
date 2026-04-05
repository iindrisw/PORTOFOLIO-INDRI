<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $id = $_POST['id_produk']; // Pastikan name di <select> adalah id_produk
    $jml = $_POST['jumlah'];

    if (!empty($id) && $jml > 0) {
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id] += $jml;
        } else {
            $_SESSION['keranjang'][$id] = $jml;
        }
    }
    header("Location: index.php?menu=produk_masuk");
}
?>