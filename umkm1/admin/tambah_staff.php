<div class="container mt-4">
    <h3>Tambah Staff Baru</h3>
    <form action="simpan_staff.php" method="POST">
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
        <select name="role" class="form-control mb-2" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="staf">Staf</option>
            <option value="pemilik">Pemilik/CEO</option>
        </select>
        <button name="submit" class="btn btn-success">Simpan</button>
        <a href="index.php?menu=staff" class="btn btn-secondary">Kembali</a>
		
    </form>
</div>
