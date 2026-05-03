<?php 
include '../koneksi.php';
session_start();

// 1. PROTEKSI ADMIN
if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") {
    header("Location: ../login.php");
    exit();
}

// 2. TANGKAP ID & AMBIL DATA LENGKAP
$id_laporan = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT laporan.*, users.nama_lengkap 
                              FROM laporan 
                              JOIN users ON laporan.id_user = users.id_user 
                              WHERE id_laporan = '$id_laporan'");
$data = mysqli_fetch_assoc($query);

if (!$data) { echo "Laporan tidak ditemukan!"; exit; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Balas Laporan | Admin SI-PENGADUAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .header-red { background-color: #ce2127; color: white; padding: 20px; }
        .detail-box { background: #f8f9fa; border-radius: 12px; padding: 20px; border: 1px solid #eee; }
        .img-preview { max-height: 300px; object-fit: contain; border-radius: 10px; background: #eee; }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-custom">
                    <div class="header-red">
                        <h5 class="mb-0 fw-bold">Berikan Tanggapan Resmi</h5>
                    </div>

                    <div class="card-body p-4">
                        <div class="detail-box mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <small class="text-muted text-uppercase fw-bold">Dari:</small>
                                    <h6 class="fw-bold mb-0 text-danger"><?= $data['nama_lengkap']; ?></h6>
                                    <small class="text-muted"><?= date('d F Y - H:i', strtotime($data['created_at'])); ?> WIB</small>
                                </div>
                                <span class="badge bg-danger rounded-pill px-3"><?= $data['kategori']; ?></span>
                            </div>

                            <hr>

                            <h5 class="fw-bold mb-3 text-dark"><?= $data['judul']; ?></h5>
                            <p class="text-secondary mb-4" style="line-height: 1.6; white-space: pre-line;"><?= $data['isi_laporan']; ?></p>

                            <div class="row g-3">
                                <?php if(!empty($data['foto'])): ?>
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted d-block mb-2">Lampiran Bukti:</label>
                                    <img src="../assets/img/<?= $data['foto']; ?>" class="img-fluid img-preview w-100 border">
                                </div>
                                <?php endif; ?>

                                <?php if(!empty($data['lokasi'])): ?>
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted d-block mb-2">Lokasi Kejadian:</label>
                                    <div class="p-3 bg-white border rounded">
                                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                        <span class="small fw-bold text-dark"><?= $data['lokasi']; ?></span>
                                        <hr class="my-2">
                                        <a href="https://www.google.com/maps?q=<?= $data['lokasi']; ?>" target="_blank" class="btn btn-sm btn-info text-white w-100 rounded-pill">
                                            <i class="bi bi-map"></i> Lihat di Google Maps
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <form action="proses_balas.php" method="POST">
                            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Isi Tanggapan/Jawaban</label>
                                <textarea name="tanggapan" class="form-control shadow-none border-2" rows="6" placeholder="Tulis solusi atau jawaban resmi di sini..." required></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" name="kirim_balasan" class="btn btn-danger px-4 py-2 fw-bold rounded-3">Kirim Tanggapan</button>
                                <a href="validasi_admin.php" class="btn btn-light border px-4 py-2 rounded-3">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>