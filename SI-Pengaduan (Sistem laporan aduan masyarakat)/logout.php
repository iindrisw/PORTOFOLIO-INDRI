<?php
session_start(); // Mulai session dulu biar bisa dihapus

// Hapus semua data session yang tersimpan
session_unset(); 
session_destroy(); 

// Tendang balik ke halaman landing page utama
header("Location: index.php"); 
exit();
?>