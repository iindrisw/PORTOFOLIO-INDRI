<?php
include 'koneksi.php';
session_start();

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $type = $_GET['type']; // 'like' atau 'dislike'

    if ($type == 'like') {
        $query = "UPDATE comments SET likes = likes + 1 WHERE id_comment = '$id'";
    } else {
        $query = "UPDATE comments SET dislikes = dislikes + 1 WHERE id_comment = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        // Balik ke halaman sebelumnya
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
?>