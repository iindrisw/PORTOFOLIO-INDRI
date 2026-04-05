<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM staff WHERE id=$id");
$data = mysqli_fetch_assoc($query);
?>

<div class="container mt-4">
    <h3>Edit Data Staff</h3>
    <form action="update_staff.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Username</label>
        <input type="text" name="username" class="form-control mb-2" value="<?= $data['username'] ?>" required>
        
        <label>Password (Kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control mb-2" placeholder="Isi password baru jika ingin ganti">
        
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control mb-2" value="<?= $data['nama'] ?>" required>
        
        <label>Role</label>
        <select name="role" class="form-control mb-2" required>
            <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="staf" <?= ($data['role'] == 'staf') ? 'selected' : '' ?>>Staf</option>
            <option value="pemilik" <?= ($data['role'] == 'pemilik') ? 'selected' : '' ?>>Pemilik/CEO</option>
        </select>

        <button name="submit" class="btn btn-warning">Update Data</button>
        <a href="index.php?menu=staff" class="btn btn-secondary">Kembali</a>
    </form>
</div>