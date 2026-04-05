<!-- CONTENT -->
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar">
            <h5 class="text-center mb-4">Menu</h5>
            <a href="index.php?menu=dashboard">Dashboard</a>
            <a href="index.php?menu=produk">Produk</a>
            <a href="index.php?menu=staff">Staff</a>
            <a href="#">Laporan</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            <h3>Dashboard</h3>
            <p>Selamat datang, <?php echo $_SESSION['username']; ?> 👋</p>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card card-box shadow p-3">
                        <h5>Produk</h5>
                        <p>Kelola data produk</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box shadow p-3">
                        <h5>Staff</h5>
                        <p>Kelola data staff</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box shadow p-3">
                        <h5>Laporan</h5>
                        <p>Melihat laporan sistem</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>