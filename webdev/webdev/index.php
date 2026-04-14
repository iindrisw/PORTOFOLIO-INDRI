<?php 
include 'header.php'; 

// 1. Logika Filter & Urutkan Berdasarkan Rating Tertinggi
if (isset($_GET['kategori'])) {
    $kat = mysqli_real_escape_string($conn, $_GET['kategori']);
    $query = mysqli_query($conn, "SELECT d.*, AVG(r.rating) as rata_rating, COUNT(r.id_review) as total_rev 
                                  FROM destinasi d 
                                  LEFT JOIN review r ON d.id_destinasi = r.id_destinasi 
                                  WHERE d.kategori = '$kat'
                                  GROUP BY d.id_destinasi 
                                  ORDER BY rata_rating DESC");
    $title_section = "Wisata " . $kat . " Terbaik";
} else {
    $query = mysqli_query($conn, "SELECT d.*, AVG(r.rating) as rata_rating, COUNT(r.id_review) as total_rev 
                                  FROM destinasi d 
                                  LEFT JOIN review r ON d.id_destinasi = r.id_destinasi 
                                  GROUP BY d.id_destinasi 
                                  ORDER BY rata_rating DESC LIMIT 6");
    $title_section = "⭐ Destinasi Rating Tertinggi";
}
?>

<div id="hero" class="carousel slide shadow" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="foto/p1.JPG" class="d-block w-100" onerror="this.src='https://via.placeholder.com/1200x500?text=Jelajahi+Keindahan+Alam'">
      <div class="carousel-caption">
        <h1 class="fw-bold text-white">Jelajahi Keindahan Alam</h1>
        <p class="text-white">Booking tiket wisata Ciayumajakuning lebih mudah dan cepat.</p>
        <a href="#destinasi" class="btn btn-pink px-4">Cari Wisata</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="foto/g1.JPG" class="d-block w-100" onerror="this.src='https://via.placeholder.com/1200x500?text=Petualangan+Menantimu'">
      <div class="carousel-caption">
        <h1 class="fw-bold text-white">Petualangan Menantimu</h1>
        <p class="text-white">Nikmati momen tak terlupakan bersama orang tersayang.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<section id="kategori" class="container my-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold">Pilih Kategori Wisata</h3>
    </div>
    <div class="row g-3 justify-content-center text-center">
        <div class="col-6 col-md-3">
            <a href="index.php?kategori=Pantai#destinasi" class="text-decoration-none">
                <div class="card card-kategori shadow-sm p-3">
                    <h5 class="fw-bold mb-0" style="color: var(--pink-dark);">🏖️ Pantai</h5>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="index.php?kategori=Gunung#destinasi" class="text-decoration-none">
                <div class="card card-kategori shadow-sm p-3">
                    <h5 class="fw-bold mb-0" style="color: var(--pink-dark);">⛰️ Gunung</h5>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="index.php?kategori=Alam#destinasi" class="text-decoration-none">
                <div class="card card-kategori shadow-sm p-3">
                    <h5 class="fw-bold mb-0" style="color: var(--pink-dark);">🌿 Alam</h5>
                </div>
            </a>
        </div>
    </div>
</section>

<div class="container"><hr></div>

<div id="destinasi" class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0"><?= $title_section; ?></h3>
        <?php if(isset($_GET['kategori'])): ?>
            <a href="index.php" class="btn btn-sm btn-outline-secondary rounded-pill">Lihat Semua</a>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <?php 
        if(mysqli_num_rows($query) > 0) {
            while($d = mysqli_fetch_array($query)): 
                $rating = round($d['rata_rating'], 1) ?: '0.0';
        ?>
        <div class="col-md-4">
            <div class="card card-destinasi shadow-sm h-100 position-relative">
                <div class="badge-hot">
                    ★ <?= $rating; ?> (<?= $d['total_rev']; ?>)
                </div>
                <img src="foto/<?= $d['gambar']; ?>" class="card-img-top img-card" onerror="this.src='https://via.placeholder.com/400x250'">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold mb-2"><?= $d['nama_wisata']; ?></h5>
                    <p class="text-muted small"><?= substr($d['deskripsi'], 0, 80); ?>...</p>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5 text-dark">Rp <?= number_format($d['harga_tiket']); ?></span>
                        <a href="detail.php?id=<?= $d['id_destinasi']; ?>" class="btn btn-pink btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; } else { echo "<p class='text-center text-muted'>Belum ada data untuk kategori ini.</p>"; } ?>
    </div>
</div>

<?php include 'footer.php'; ?>