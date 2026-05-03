<?php 
include '../koneksi.php';
session_start();

// Proteksi Admin
if (!isset($_SESSION['status']) || $_SESSION['level'] != "admin") {
    header("Location: ../login.php");
    exit();
}

// 1. TANGKAP FILTER (PENTING: Gunakan format date 'm' dan 'Y' sebagai default)
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        /* Trik agar saat di-print (Save PDF) tombol-tombol tidak ikut terbawa */
        @media print {
            .no-print, .btn, .sidebar, form { display: none !important; }
            body { background-color: white !important; padding: 0; }
            .card { border: none !important; box-shadow: none !important; }
            .container { width: 100% !important; max-width: 100% !important; }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <div class="card shadow-sm mb-4 no-print border-0">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-filter-left"></i> Filter Periode Laporan</h6>
                    <form action="" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="small fw-bold">BULAN</label>
                            <select name="bulan" class="form-select">
                                <?php foreach($nama_bulan as $m => $nm) : ?>
                                    <option value="<?= $m; ?>" <?= ($bulan == $m) ? 'selected' : ''; ?>><?= $nm; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold">TAHUN</label>
                            <input type="number" name="tahun" class="form-control" value="<?= $tahun; ?>">
                        </div>
                        <div class="col-md-5 d-flex gap-2">
                            <button type="submit" class="btn btn-danger flex-grow-1 fw-bold">TAMPILKAN</button>
                            <button type="button" onclick="window.print()" class="btn btn-dark fw-bold"><i class="bi bi-printer"></i> CETAK / SAVE</button>
                            <a href="validasi_admin.php" class="btn btn-outline-secondary">KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark m-0">REKAPITULASI PENGADUAN MASYARAKAT</h2>
                        <h5 class="text-muted fw-normal">Laporan Masuk Periode: <?= $nama_bulan[$bulan]; ?> <?= $tahun; ?></h5>
                        <hr style="border: 2px solid black; opacity: 1; width: 100%;">
                    </div>

                    <table class="table table-bordered align-middle">
                        <thead class="table-light text-center small fw-bold">
                            <tr>
                                <th width="50">NO</th>
                                <th width="120">TANGGAL</th>
                                <th width="150">PELAPOR</th>
                                <th>JUDUL LAPORAN</th>
                                <th width="100">KATEGORI</th>
                                <th width="100">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            // QUERY DENGAN FILTER BULAN & TAHUN
                            $sql = mysqli_query($conn, "SELECT laporan.*, users.nama_lengkap 
                                                        FROM laporan 
                                                        JOIN users ON laporan.id_user = users.id_user 
                                                        WHERE MONTH(laporan.created_at) = '$bulan' 
                                                        AND YEAR(laporan.created_at) = '$tahun' 
                                                        ORDER BY created_at ASC");
                            
                            if(mysqli_num_rows($sql) > 0) :
                                while($row = mysqli_fetch_assoc($sql)) :
                            ?>
                                <tr class="small">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($row['created_at'])); ?></td>
                                    <td><?= $row['nama_lengkap']; ?></td>
                                    <td><?= $row['judul']; ?></td>
                                    <td class="text-center text-danger fw-bold"><?= $row['kategori']; ?></td>
                                    <td class="text-center text-uppercase fw-bold" style="font-size: 0.7rem;">
                                        <?= $row['status']; ?>
                                    </td>
                                </tr>
                            <?php 
                                endwhile; 
                            else :
                                echo "<tr><td colspan='6' class='text-center py-5 text-muted'>Tidak ada data ditemukan untuk periode ini.</td></tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>

                    <div class="row mt-5">
                        <div class="col-8"></div>
                        <div class="col-4 text-center">
                            <p class="mb-5">Cirebon, <?= date('d F Y'); ?><br>Petugas Admin,</p>
                            <br><br>
                            <p class="fw-bold text-decoration-underline mb-0"><?= $_SESSION['nama_lengkap']; ?></p>
                            <small class="text-muted text-uppercase"><?= $_SESSION['level']; ?></small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>