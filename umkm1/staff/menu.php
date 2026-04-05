<?php
$menu = isset($_GET['menu']) ? $_GET['menu'] : 'dashboard';

if ($menu == "dashboard") {
    include "home.php";
} else if ($menu == "produk") {
    include "produk.php";
} else if ($menu == "edit_produk") {
    include "edit_produk.php"; // WAJIB ADA AGAR BISA EDIT
} else if ($menu == "tambah_produk") {
    include "tambah_produk.php"; // WAJIB ADA AGAR BISA TAMBAH
} else if ($menu == "produk_masuk") {
    include "produk_masuk.php";
}
// Tambahkan di bawah produk_masuk:
 else if ($menu == "laporan_stok") {
    include "laporan_stok.php";
} else if ($menu == "grafik") {
    include "grafik.php";
} else if ($menu == "laporan_pembelian") {
    include "laporan_pembelian.php";
}

?>