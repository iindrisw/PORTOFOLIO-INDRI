<?php 
include 'koneksi.php';
include 'layout/header.php'; 

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT laporan.*, users.nama_lengkap 
          FROM laporan 
          JOIN users ON laporan.id_user = users.id_user 
          WHERE id_laporan = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(!$data) { echo "Laporan tidak ditemukan"; exit; }

// QUERY AMBIL BALASAN ADMIN + DATA VOTE
$query_balasan = mysqli_query($conn, "SELECT comments.*, users.nama_lengkap as nama_admin 
                                      FROM comments 
                                      JOIN users ON comments.id_users = users.id_user 
                                      WHERE id_posts = '$id' 
                                      ORDER BY created_at DESC LIMIT 1");
$balasan = mysqli_fetch_assoc($query_balasan);
?>

<style>
    .box-tanggapan {
        background-color: #f0fff4;
        border: 1px solid #c6f6d5;
        border-radius: 15px;
        padding: 25px;
    }
    .img-detail {
        max-height: 500px;
        object-fit: contain;
        background: #f8f9fa;
    }
    .vote-btn {
        transition: 0.3s;
        font-weight: 600;
    }
    .vote-btn:hover {
        transform: scale(1.05);
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="fw-bold text-dark mb-3"><?= $data['judul']; ?></h1>
            
            <div class="d-flex align-items-center mb-4 text-muted border-bottom pb-3">
                <span class="me-3"><i class="bi bi-person"></i> Pelapor: <strong><?= $data['nama_lengkap']; ?></strong></span>
                <span class="me-3"><i class="bi bi-calendar-event"></i> <?= date('d F Y', strtotime($data['created_at'])); ?></span>
                <span class="badge bg-danger rounded-pill px-3"><?= $data['kategori']; ?></span>
            </div>

            <?php if($data['foto']) : ?>
                <img src="assets/img/<?= $data['foto']; ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100 img-detail border">
            <?php endif; ?>

            <?php if(!empty($data['lokasi'])) : ?>
                <div class="mb-4 p-3 bg-light rounded border-start border-4 border-danger">
                    <h6 class="fw-bold mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Lokasi Kejadian:</h6>
                    <p class="small mb-0 text-dark"><?= $data['lokasi']; ?></p>
                    <a href="https://www.google.com/maps?q=<?= $data['lokasi']; ?>" target="_blank" class="small fw-bold text-decoration-none">Buka di Maps →</a>
                </div>
            <?php endif; ?>

            <div class="isi-laporan lead text-secondary mb-5" style="line-height: 1.8; font-size: 1.1rem;">
                <?= nl2br($data['isi_laporan']); ?>
            </div>

            <?php if($balasan) : ?>
                <div class="box-tanggapan shadow-sm mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <h5 class="fw-bold text-success mb-0">Tanggapan Resmi Admin</h5>
                    </div>
                    <div class="text-dark mb-3" style="line-height: 1.7;">
                        <?= nl2br($balasan['comment_text']); ?>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top border-success border-opacity-10">
                        <span class="small fw-bold text-muted">Membantu?</span>
                        <a href="proses_vote.php?id=<?= $balasan['id_comment']; ?>&type=like" class="btn btn-sm btn-success rounded-pill px-3 vote-btn">
                            <i class="bi bi-hand-thumbs-up-fill"></i> Ya (<?= $balasan['likes']; ?>)
                        </a>
                        <a href="proses_vote.php?id=<?= $balasan['id_comment']; ?>&type=dislike" class="btn btn-sm btn-outline-danger rounded-pill px-3 vote-btn">
                            <i class="bi bi-hand-thumbs-down-fill"></i> Tidak (<?= $balasan['dislikes']; ?>)
                        </a>
                    </div>

                    <hr class="opacity-10">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Dijawab oleh: <strong><?= $balasan['nama_admin']; ?></strong></small>
                        <small class="text-muted"><?= date('d/m/Y H:i', strtotime($balasan['created_at'])); ?> WIB</small>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-warning border-0 rounded-4 p-3 shadow-sm">
                    <i class="bi bi-info-circle me-2"></i> Laporan ini sedang dalam proses verifikasi dan belum ada tanggapan resmi.
                </div>
            <?php endif; ?>

            <div class="d-grid mt-5">
                <a href="index.php" class="btn btn-light border py-3 fw-bold rounded-pill shadow-sm"> 
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Mading
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>