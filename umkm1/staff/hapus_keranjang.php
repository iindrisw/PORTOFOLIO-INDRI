<?php
// Ambil ID dari URL
$id = $_GET['id'];

// Hapus hanya barang dengan ID tersebut dari session
if(isset($_SESSION['keranjang'][$id])) {
    unset($_SESSION['keranjang'][$id]);
}

header("Location: index.php?menu=produk_masuk");
?>