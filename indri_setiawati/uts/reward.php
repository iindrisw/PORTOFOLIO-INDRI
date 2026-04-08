<?php
include 'koneksi.php';
include 'layout/header.php';

// Proteksi: Hanya user yang bisa akses halaman reward
if (!isset($_SESSION['status']) || $_SESSION['level'] != 'user') {
    header("Location: login.php"); exit;
}

$id_user = $_SESSION['id_user'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT points, nama_lengkap FROM users WHERE id_user = '$id_user'"));
$points = $user['points'];

// Data Dummy Voucher UMKM Cirebon
$vouchers = [
    ['nama' => 'Empal Gentong H. Apud', 'poin' => 50, 'diskon' => 'Potongan 10%', 'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=100'],
    ['nama' => 'Batik Trusmi Cirebon', 'poin' => 100, 'diskon' => 'Voucher Rp 25rb', 'img' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=100'],
    ['nama' => 'Nasi Jamblang Ibu Nur', 'poin' => 30, 'diskon' => 'Gratis Es Teh Manis', 'img' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100'],
    ['nama' => 'Sirup Tjap Buah Tjampolay', 'poin' => 40, 'diskon' => 'Beli 2 Gratis 1', 'img' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=100']
];
?>

<style>
    .bg-hero-reward { background: linear-gradient(135deg, #ce2127 0%, #a51a1f 100%); color: white; padding: 60px 0; border-radius: 0 0 40px 40px; }
    .card-voucher { border: none; border-radius: 15px; transition: 0.3s; background: white; border: 1px solid #eee; overflow: hidden; }
    .card-voucher:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .icon-box { width: 50px; height: 50px; border-radius: 12px; background: #fff5f5; color: #ce2127; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
</style>

<div class="bg-hero-reward text-center shadow">
    <div class="container">
        <h6 class="text-uppercase fw-bold opacity-75 small" style="letter-spacing: 2px;">Saldo Pahlawan Anda</h6>
        <h1 class="display-3 fw-bold mb-0"><?= $points; ?> <i class="bi bi-star-fill text-warning"></i></h1>
        <p class="mt-2 opacity-75">Kumpulkan poin dengan melapor dan bangun Cirebon!</p>
    </div>
</div>

<div class="container mt-n4" style="margin-top: -30px;">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start">
                        <h5 class="fw-bold mb-1"><?= $user['nama_lengkap']; ?></h5>
                        <p class="text-muted small mb-0">Poin otomatis bertambah setiap laporan Anda diselesaikan oleh Admin.</p>
                    </div>
                    <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                        <a href="profile.php" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold">PENGATURAN AKUN</a>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold mb-3 mt-5"><i class="bi bi-gift me-2 text-danger"></i> Penukaran Voucher UMKM</h5>
            <div class="row g-3">
                <?php foreach($vouchers as $v) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-voucher p-3 h-100 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $v['img']; ?>" class="rounded-3 me-3" style="width: 55px; height: 55px; object-fit: cover; border: 1px solid #eee;">
                            <div class="text-truncate">
                                <h6 class="fw-bold mb-0 text-truncate" style="font-size: 0.85rem;"><?= $v['nama']; ?></h6>
                                <span class="badge bg-success-subtle text-success mt-1" style="font-size: 0.65rem;"><?= $v['diskon']; ?></span>
                            </div>
                        </div>
                        <div class="mt-auto border-top pt-3 d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger small"><?= $v['poin']; ?> Poin</span>
                            <button class="btn btn-danger btn-sm rounded-pill px-3 fw-bold shadow-sm" 
                                    <?= ($points < $v['poin']) ? 'disabled' : ''; ?>
                                    onclick="alert('Voucher berhasil ditukar! Kode voucher telah dikirim ke WhatsApp/Email Anda.')" 
                                    style="font-size: 0.65rem;">
                                <?= ($points < $v['poin']) ? 'POIN KURANG' : 'TUKAR SEKARANG'; ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="card border-0 rounded-4 mt-5 p-4 shadow-sm bg-white">
                <div class="d-flex align-items-start">
                    <div class="icon-box me-3 shadow-sm"><i class="bi bi-info-circle"></i></div>
                    <div>
                        <h6 class="fw-bold">Bagaimana Cara Mendapatkan Poin?</h6>
                        <ul class="text-muted small ps-3 mt-2 mb-0">
                            <li class="mb-2"><b>Lapor Keluhan:</b> Kirim laporan yang valid (disertai foto & lokasi yang jelas).</li>
                            <li class="mb-2"><b>Validasi Admin:</b> Tunggu hingga laporan Anda diproses oleh tim admin SI-PENGADUAN.</li>
                            <li class="mb-2"><b>Status Selesai:</b> Anda otomatis mendapatkan <b>+10 Poin</b> setiap kali satu laporan berubah status menjadi <span class="badge bg-success small">Selesai</span>.</li>
                            <li><b>Upvote Warga:</b> Poin tambahan diberikan jika laporan Anda dinilai bermanfaat oleh warga lain.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="mb-5 pb-5"></div> <?php include 'layout/footer.php'; ?>