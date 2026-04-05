<!-- footer.php -->
<footer class="bg-dark text-light mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row">

            <!-- Sitemap -->
            <div class="col-md-4">
                <h5>Sitemap</h5>
                <ul class="list-unstyled">
                    <li><a href="dashboard.php" class="text-light text-decoration-none">Dashboard</a></li>
                    <li><a href="index.php?menu=produk" class="text-light text-decoration-none">Produk</a></li>
                    <li><a href="tambah_produk.php" class="text-light text-decoration-none">Tambah Produk</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div class="col-md-4">
                <h5>Info</h5>
                <p class="small">
                    Sistem manajemen produk sederhana berbasis PHP & MySQL.
                </p>
            </div>

            <!-- Copyright -->
            <div class="col-md-4 text-md-end">
                <h5>App</h5>
                <p class="small mb-0">
                    &copy; <?= date('Y') ?> - Dashboard Produk
                </p>
            </div>

        </div>
    </div>
</footer>