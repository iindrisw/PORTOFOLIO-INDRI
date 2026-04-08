<?php 
include '../koneksi.php';
include '../layout/header.php'; 

// 1. Proteksi Session
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

$nama_user = $_SESSION['nama_lengkap'] ?? $_SESSION['nama']; 
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    .hero { background: #ce2127; padding: 60px 0 100px 0; border-radius: 0 0 50px 50px; }
    .card-main { margin-top: -80px; border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    #map { height: 300px; border-radius: 12px; border: 1px solid #ddd; z-index: 1; }
    .step-icon { width: 50px; height: 50px; line-height: 50px; font-size: 1.2rem; }
</style>

<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold text-white">Halo, <?= explode(' ', $nama_user)[0]; ?>!</h1>
        <p class="lead text-white-50">Sampaikan aspirasi atau keluhan Anda untuk Cirebon yang lebih baik.</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-main p-4 p-md-5 bg-white mb-5">
                <h4 class="text-center fw-bold mb-4">Buat Laporan Baru</h4>
                
                <form action="simpan_laporan.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pelapor</label>
                                <input type="text" class="form-control bg-light" value="<?= $nama_user; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Klasifikasi Laporan</label>
                                <select name="kategori" class="form-select border-2" required>
                                    <option value="" selected disabled>-- Pilih Klasifikasi --</option>
                                    <option value="PENGADUAN">PENGADUAN</option>
                                    <option value="ASPIRASI">ASPIRASI</option>
                                    <option value="INFORMASI">INFORMASI</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Laporan</label>
                                <input type="text" name="judul" class="form-control border-2" placeholder="Apa inti masalahnya?" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Isi Deskripsi</label>
                                <textarea name="isi" class="form-control border-2" rows="4" placeholder="Ceritakan detail kejadian..." required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Lokasi Kejadian (Klik pada Peta)</label>
                                <div id="map" class="mb-2"></div>
                                <input type="text" name="lokasi" id="lokasi" class="form-control bg-light mb-1" placeholder="Koordinat otomatis..." readonly required>
                                <small class="text-muted" style="font-size: 0.7rem;">*Klik di peta untuk menandai lokasi tepatnya.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Lampiran Foto</label>
                                <input type="file" name="foto" class="form-control border-2" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger btn-lg fw-bold py-3 shadow">KIRIM LAPORAN SEKARANG</button>
                    </div>
                </form>
            </div>

            <div class="text-center py-4">
                <h3 class="fw-bold mb-5">Alur Pengaduan</h3>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="badge bg-danger rounded-circle step-icon mb-3">1</div>
                        <h6 class="fw-bold">Tulis Laporan</h6>
                        <p class="small text-muted">Isi form di atas dengan data yang valid.</p>
                    </div>
                    <div class="col-md-3">
                        <div class="badge bg-danger rounded-circle step-icon mb-3">2</div>
                        <h6 class="fw-bold">Verifikasi</h6>
                        <p class="small text-muted">Laporan akan dicek oleh admin kami.</p>
                    </div>
                    <div class="col-md-3">
                        <div class="badge bg-danger rounded-circle step-icon mb-3">3</div>
                        <h6 class="fw-bold">Tindak Lanjut</h6>
                        <p class="small text-muted">Laporan diteruskan ke instansi terkait.</p>
                    </div>
                    <div class="col-md-3">
                        <div class="badge bg-danger rounded-circle step-icon mb-3">4</div>
                        <h6 class="fw-bold">Selesai</h6>
                        <p class="small text-muted">Dapatkan jawaban resmi dari pemerintah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inisialisasi Peta (Cirebon)
    var map = L.map('map').setView([-6.722, 108.555], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker;
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
        document.getElementById('lokasi').value = lat + ", " + lng;
    });
</script>

<?php include '../layout/footer.php'; ?>