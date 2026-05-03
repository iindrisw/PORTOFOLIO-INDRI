<?php 
include '../koneksi.php';
include '../layout/header.php'; 

// Proteksi: Kalo belum login, tendang!
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Query: Ambil laporan KHUSUS milik user yang login saja
$query = "SELECT * FROM laporan WHERE id_user = '$id_user' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<style>
    .hero { background: #ce2127; padding: 60px 0 100px 0; }
    /* Style supaya baris tabel bisa diklik dan ada feedback visual */
    .clickable-row { cursor: pointer; transition: 0.2s; }
    .clickable-row:hover { background-color: #f8f9fa !important; }
    .no-click { position: relative; z-index: 5; } /* Supaya link foto gak keganggu */
</style>

<section class="hero">
    <div class="container text-center">
        <h2 class="fw-bold text-white">Riwayat Laporan Saya</h2>
        <p class="lead text-white-50">Pantau status penanganan aspirasi Anda di sini.</p>
    </div>
</section>

<div class="container" style="margin-top: -50px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card border-0 shadow rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-muted small text-uppercase" style="letter-spacing: 1px;">
                                <th class="ps-4 py-3">Tanggal</th>
                                <th>Judul Laporan</th>
                                <th>Kategori</th>
                                <th class="text-center">Status</th>
                                <th class="text-center pe-4">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result) > 0) : ?>
                                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                                <tr class="clickable-row" onclick="window.location='../detail_laporan.php?id=<?= $row['id_laporan']; ?>'">
                                    <td class="ps-4 small text-muted">
                                        <?= date('d/m/Y', strtotime($row['created_at'])); ?>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $row['judul']; ?></div>
                                        <small class="text-muted d-block text-truncate" style="max-width: 300px;">
                                            <?= $row['isi_laporan']; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-danger border border-danger small px-3" style="font-size: 0.65rem;">
                                            <?= $row['kategori']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row['status'] == 'pending'): ?>
                                            <span class="badge bg-secondary rounded-pill px-3 shadow-sm">Menunggu</span>
                                        <?php elseif($row['status'] == 'proses'): ?>
                                            <span class="badge bg-warning text-dark rounded-pill px-3 shadow-sm">Diproses</span>
                                        <?php else: ?>
                                            <span class="badge bg-success rounded-pill px-3 shadow-sm">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4 no-click" onclick="event.stopPropagation();">
                                        <?php if(!empty($row['foto'])): ?>
                                            <a href="../assets/img/<?= $row['foto']; ?>" target="_blank">
                                                <img src="../assets/img/<?= $row['foto']; ?>" width="45" height="45" class="rounded shadow-sm border object-fit-cover">
                                            </a>
                                        <?php else: ?>
                                            <div class="bg-light rounded d-inline-block border" style="width:45px; height:45px; line-height:45px;">
                                                <i class="bi bi-image text-muted small"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="opacity-25 mb-3"><br>
                                        <span class="text-muted fst-italic">Anda belum pernah mengirim laporan.</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>