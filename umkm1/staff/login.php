
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Staff UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
        }
        .card {
            border-radius: 15px;
        }
        .captcha-img {
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">🔐 Login Staff UMKM</h3>

        <form action="proses_login.php" method="POST">

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Captcha</label><br>
                <img src="captcha.php" id="captcha" class="captcha-img mb-2" title="Klik untuk refresh">
                <input type="text" name="captcha" class="form-control" placeholder="Masukkan captcha" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<script>
document.getElementById("captcha").onclick = function() {
    this.src = "captcha.php?" + Math.random();
}
</script>

</body>
</html>