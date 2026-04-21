<?php
include 'koneksi.php';
include 'layout/header.php';

// 1. TANGKAP DATA PENCARIAN & FILTER
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($conn, $_GET['kategori']) : '';

// 2. QUERY DINAMIS (Hanya menampilkan yang statusnya 'selesai')
$query = "SELECT laporan.*, users.nama_lengkap, 
          (SELECT comment_text FROM comments WHERE comments.id_posts = laporan.id_laporan ORDER BY created_at DESC LIMIT 1) as balasan_admin,
          (SELECT id_comment FROM comments WHERE comments.id_posts = laporan.id_laporan ORDER BY created_at DESC LIMIT 1) as id_comment,
          (SELECT likes FROM comments WHERE comments.id_posts = laporan.id_laporan ORDER BY created_at DESC LIMIT 1) as jml_likes,
          (SELECT dislikes FROM comments WHERE comments.id_posts = laporan.id_laporan ORDER BY created_at DESC LIMIT 1) as jml_dislikes
          FROM laporan 
          JOIN users ON laporan.id_user = users.id_user 
          WHERE laporan.status = 'selesai'";

if ($keyword != '') { $query .= " AND (laporan.judul LIKE '%$keyword%' OR laporan.isi_laporan LIKE '%$keyword%')"; }
if ($kategori != '') { $query .= " AND laporan.kategori = '$kategori'"; }

$query .= " ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// 3. LOGIC HERO POINTS (Hanya jika user login)
$show_hero = false;
if (isset($_SESSION['status']) && $_SESSION['level'] == 'user') {
    $show_hero = true;
    $id_me = $_SESSION['id_user'];
    $me = mysqli_fetch_assoc(mysqli_query($conn, "SELECT points, nama_lengkap FROM users WHERE id_user = '$id_me'"));
    $my_points = $me['points'];

    // Leveling System
    if ($my_points < 50) { 
        $rank = "Warga Biasa"; $c = "secondary"; $next = 50; $next_rank = "Relawan Kota";
    } elseif ($my_points < 150) { 
        $rank = "Relawan Kota"; $c = "primary"; $next = 150; $next_rank = "Pahlawan Cirebon";
    } else { 
        $rank = "Pahlawan Cirebon"; $c = "danger"; $next = 1000; $next_rank = "Level Maksimal";
    }
    
    $progress = ($my_points / $next) * 100;
    if($progress > 100) $progress = 100;
    $kurang = $next - $my_points;

    // --- POPUP INFO ALA MYTELKOMSEL ---
    $level_info = "
    <div class='small'>
        <div class='mb-2 pb-2 border-bottom'><b>Tingkatan Badge:</b></div>
        <div class='d-flex justify-content-between mb-1 " . ($my_points < 50 ? 'text-danger fw-bold' : 'text-muted') . "'>
            <span>1. Warga Biasa</span> <span>0-49</span>
        </div>
        <div class='d-flex justify-content-between mb-1 " . ($my_points >= 50 && $my_points < 150 ? 'text-primary fw-bold' : 'text-muted') . "'>
            <span>2. Relawan Kota</span> <span>50-149</span>
        </div>
        <div class='d-flex justify-content-between " . ($my_points >= 150 ? 'text-success fw-bold' : 'text-muted') . "'>
            <span>3. Pahlawan Cirebon</span> <span>150+</span>
        </div>
        <hr class='my-2'>
        <p class='mb-0' style='font-size: 0.7rem;'>
            " . ($my_points < 150 ? "Butuh <b>$kurang poin</b> lagi buat ke <b>$next_rank</b>" : "Level Maksimal Tercapai!") . "
        </p>
    </div>";
}
?>

<style>
    .hero-slim { background: #ce2127; padding: 40px 0 80px 0; color: white; border-radius: 0 0 30px 30px; }
    .card-hero { margin-top: -60px; border: none; border-radius: 20px; transition: 0.3s; border: 1px solid transparent; }
    .card-hero:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important; border-color: #ce2127; }
    
    /* Popover Styling */
    .popover { border: none; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.2); font-family: 'Inter', sans-serif; min-width: 200px; }
    .popover-header { background: #f8f9fa; font-weight: bold; border-radius: 12px 12px 0 0; }
    .badge-clickable { cursor: pointer; transition: 0.2s; border: 1px solid currentColor; }

    /* Feed List */
    .search-box-slim { margin-top: 20px; }
    .slim-row { background: white; border-bottom: 1px solid #eee; transition: 0.2s; cursor: pointer; padding: 18px 25px; }
    .slim-row:hover { background-color: #fcfcfc; }
    .tag-admin { font-size: 0.65rem; font-weight: 800; color: #198754; text-transform: uppercase; display: block; margin-bottom: 4px; }
    .img-mini { width: 55px; height: 55px; object-fit: cover; border-radius: 10px; }
    .no-click { position: relative; z-index: 5; }
</style>

<section class="hero-slim text-center shadow-sm">
    <div class="container">
        <h4 class="fw-bold">Layanan Pengaduan Cirebon</h4>
        <p class="small opacity-75">Sampaikan aspirasi Anda untuk Cirebon yang lebih baik.</p>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <?php if($show_hero) : ?>
                <div class="card card-hero p-4 bg-white mb-4 shadow-sm">
                    <div class="row align-items-center text-center text-md-start">
                        <div class="col-md-7 border-md-end">
                            <small class="text-muted fw-bold text-uppercase">Profil</small>
                            <h4 class="fw-bold m-0"><?= $me['nama_lengkap']; ?></h4>
                            <div class="mt-2">
                                <span class="badge bg-<?= $c; ?>-subtle text-<?= $c; ?> rounded-pill px-3 py-2 text-uppercase badge-clickable" 
                                      data-bs-toggle="popover" 
                                      data-bs-trigger="click"
                                      data-bs-html="true"
                                      data-bs-title="<i class='bi bi-trophy me-1'></i> Tingkatan Level" 
                                      data-bs-content="<?= htmlspecialchars($level_info); ?>" 
                                      data-bs-placement="bottom">
                                    <i class="bi bi-patch-check-fill me-1"></i> <?= $rank; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-5 ps-md-4 mt-3 mt-md-0">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-bold">Poin: <span class="text-danger"><?= $my_points; ?></span></span>
                                <span class="small text-muted" style="font-size: 0.65rem;"><?= round($progress); ?>% Progress</span>
                            </div>
                            <div class="progress mb-2" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar bg-<?= $c; ?> progress-bar-striped progress-bar-animated" style="width: <?= $progress; ?>%"></div>
                            </div>
                            <a href="reward.php" class="btn btn-danger btn-sm w-100 mt-1 rounded-pill fw-bold py-2 shadow-sm" style="font-size: 0.75rem;">TUKAR VOUCHER</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm rounded-pill p-2 search-box-slim">
                <form action="index.php" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm border-0">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-danger"></i></span>
                        <input type="text" name="keyword" class="form-control border-0 shadow-none" placeholder="Cari laporan..." value="<?= htmlspecialchars($keyword); ?>">
                    </div>
                    <select name="kategori" class="form-select form-select-sm border-0 shadow-none w-auto fw-bold text-muted me-2">
                        <option value="">KATEGORI</option>
                        <option value="PENGADUAN" <?= ($kategori == 'PENGADUAN') ? 'selected' : ''; ?>>PENGADUAN</option>
                        <option value="ASPIRASI" <?= ($kategori == 'ASPIRASI') ? 'selected' : ''; ?>>ASPIRASI</option>
                    </select>
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold">FILTER</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h6 class="fw-bold mb-3 text-muted text-uppercase small"><i class="bi bi-database-check me-2"></i> Database Aspirasi Selesai</h6>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <?php if(mysqli_num_rows($result) > 0) : ?>
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="slim-row" onclick="window.location='detail_laporan.php?id=<?= $row['id_laporan']; ?>'">
                        <div class="row align-items-center">
                            <div class="col-md-6 border-md-end">
                                <div class="d-flex align-items-center">
                                    <?php if($row['foto']) : ?>
                                        <img src="assets/img/<?= $row['foto']; ?>" class="img-mini me-3 shadow-sm border">
                                    <?php else : ?>
                                        <div class="img-mini bg-light border d-flex align-items-center justify-content-center text-muted me-3 small">No Pic</div>
                                    <?php endif; ?>
                                    <div class="flex-grow-1 text-truncate">
                                        <p class="mb-0 fw-bold"><?= $row['judul']; ?></p>
                                        <small class="text-muted" style="font-size: 0.7rem;">
                                            <?= explode(' ', $row['nama_lengkap'])[0]; ?> • <?= date('d M Y', strtotime($row['created_at'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-4 mt-2 mt-md-0">
                                <span class="tag-admin"><i class="bi bi-patch-check-fill me-1"></i> Solusi Admin</span>
                                <div class="small text-success text-truncate mb-2">
                                    "<?= !empty($row['balasan_admin']) ? $row['balasan_admin'] : 'Laporan telah selesai ditindaklanjuti.'; ?>"
                                </div>
                                <div class="no-click" onclick="event.stopPropagation();">
                                    <div class="d-flex gap-3 text-muted" style="font-size: 0.75rem;">
                                        <span class="text-success-emphasis fw-bold"><i class="bi bi-hand-thumbs-up"></i> <?= $row['jml_likes']; ?></span>
                                        <span class="text-danger-emphasis fw-bold"><i class="bi bi-hand-thumbs-down"></i> <?= $row['jml_dislikes']; ?></span>
                                        <span class="ms-auto badge bg-light text-dark border rounded-pill"><?= $row['kategori']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="p-5 text-center bg-white text-muted">Belum ada laporan selesai.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        document.addEventListener('click', function (e) {
            popoverTriggerList.forEach(function (el) {
                if (!el.contains(e.target) && !document.querySelector('.popover')?.contains(e.target)) {
                    bootstrap.Popover.getInstance(el).hide();
                }
            });
        });
    });
</script>

<?php include 'layout/footer.php'; ?>