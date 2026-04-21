<?php
include 'koneksi.php';
include 'layout/header.php';

// Pastikan user login
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// 1. Ambil data poin terbaru
$user_query = mysqli_query($conn, "SELECT points FROM users WHERE id_user = '$id_user'");
$user_data = mysqli_fetch_assoc($user_query);
$points = $user_data['points'];

// 2. Ambil Voucher yang sudah dimiliki
$my_vouchers = mysqli_query($conn, "SELECT * FROM voucher_saya WHERE id_user = '$id_user' ORDER BY tgl_tukar DESC");

// 3. Katalog Voucher
$vouchers = [
    ['nama' => 'Empal Gentong H. Apud', 'poin' => 50, 'diskon' => 'Potongan 10%', 'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=100'],
    ['nama' => 'Batik Trusmi Cirebon', 'poin' => 100, 'diskon' => 'Voucher Rp 25rb', 'img' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=100'],
    ['nama' => 'Nasi Jamblang Ibu Nur', 'poin' => 30, 'diskon' => 'Gratis Es Teh Manis', 'img' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100']
];
?>

<style>
    .bg-reward { background: #ce2127; color: white; padding: 60px 0; border-radius: 0 0 40px 40px; }
    .nav-pills .nav-link { color: white; border-radius: 50px; font-weight: bold; border: 1px solid white; margin: 0 5px; }
    .nav-pills .nav-link.active { background: white !important; color: #ce2127 !important; }
    .card-v { border: none; border-radius: 20px; transition: 0.3s; height: 100%; }
    .card-v:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .ticket { background: #fff; border-left: 5px dashed #ce2127; position: relative; }
    .kode-box { background: #f8f9fa; border: 1px dashed #ccc; font-family: monospace; font-size: 1.2rem; color: #ce2127; }
</style>

<div class="bg-reward text-center shadow-sm">
    <div class="container">
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil_tukar'): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-pill mb-4" role="alert">
                <strong>Jos!</strong> Berhasil tukar voucher <b><?= htmlspecialchars($_GET['voucher']); ?></b>. Cek di tab "Voucher Saya"!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <h6 class="text-uppercase opacity-75 small fw-bold">Saldo Poin Ayes</h6>
        <h1 class="display-4 fw-bold mb-4"><?= $points; ?> <i class="bi bi-star-fill text-warning"></i></h1>
        
        <ul class="nav nav-pills justify-content-center" id="rewardTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#katalog">Katalog Voucher</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#milik-saya">Voucher Saya (<?= mysqli_num_rows($my_vouchers); ?>)</button></li>
        </ul>
    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="tab-content" id="rewardTabContent">
        
        <div class="tab-pane fade show active" id="katalog">
            <h5 class="fw-bold mb-3"><i class="bi bi-shop me-2 text-danger"></i> Penukaran UMKM Cirebon</h5>
            <div class="row g-3">
                <?php foreach($vouchers as $v) : ?>
                <div class="col-md-4">
                    <div class="card card-v shadow-sm p-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $v['img']; ?>" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0"><?= $v['nama']; ?></h6>
                                <span class="badge bg-success-subtle text-success small"><?= $v['diskon']; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-auto">
                            <span class="fw-bold text-danger"><?= $v['poin']; ?> Poin</span>
                            <form action="proses_tukar.php" method="POST">
                                <input type="hidden" name="nama_voucher" value="<?= $v['nama']; ?>">
                                <input type="hidden" name="harga_poin" value="<?= $v['poin']; ?>">
                                <button type="submit" name="tukar" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold" <?= ($points < $v['poin']) ? 'disabled' : ''; ?>>
                                    <?= ($points < $v['poin']) ? 'POIN KURANG' : 'TUKAR SEKARANG'; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="milik-saya">
            <h5 class="fw-bold mb-3 text-danger"><i class="bi bi-ticket-perforated me-2"></i> Koleksi Voucher Anda</h5>
            <div class="row g-3">
                <?php if(mysqli_num_rows($my_vouchers) > 0) : ?>
                    <?php while($mv = mysqli_fetch_assoc($my_vouchers)) : ?>
                    <div class="col-md-6">
                        <div class="card card-v shadow-sm p-4 ticket">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="fw-bold mb-1"><?= $mv['nama_voucher']; ?></h5>
                                    <small class="text-muted">Ditukar: <?= date('d M Y', strtotime($mv['tgl_tukar'])); ?></small>
                                    <div class="mt-3">
                                        <small class="text-uppercase fw-bold text-muted" style="font-size: 0.6rem;">Kode Voucher:</small>
                                        <div class="kode-box p-2 text-center fw-bold mt-1 rounded"><?= $mv['kode_voucher']; ?></div>
                                    </div>
                                </div>
                                <div class="col-4 text-center border-start">
                                    <i class="bi bi-qr-code fs-1 text-dark"></i>
                                    <p class="small mb-0 mt-2 text-success fw-bold" style="font-size: 0.6rem;">READY TO USE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="text-center p-5 bg-white rounded-4 shadow-sm">
                        <i class="bi bi-emoji-frown display-1 text-muted"></i>
                        <p class="mt-3 text-muted">Belum punya voucher nih. Yuk lapor terus biar dapet poin!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php include 'layout/footer.php'; ?>