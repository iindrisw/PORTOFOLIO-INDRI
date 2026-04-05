<?php
include 'koneksi.php'; // Memanggil koneksi yang ada di folder admin
$data = mysqli_query($conn, "SELECT * FROM staff");
?>

<div class="container mt-4">
    <h3>Data Staff</h3>
    <a href="index.php?menu=tambah_staff" class="btn btn-primary mb-3">+ Tambah Staff</a>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <table id="tabelStaff" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr class="text-center">
            <td><?= $no++ ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><span class="badge bg-info text-dark"><?= $row['role'] ?></span></td>
            <td>
                <a href="index.php?menu=edit_staff&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus_staff.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#tabelStaff').DataTable();
});
</script>