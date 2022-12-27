<?php
// Fungsi untuk memulai SESSION
session_start();

// Sebelum masuk ke halaman home dicek dulu apakah user sudah login atau belum
// Jika belum maka user akan dikembalikan ke halaman login
if (!isset($_SESSION["login"])) {
    header("location: login.php"); 
    exit;
}

// Jika user berhasil login dengan permintaan ke url index.php?login=sukses, maka akan menampilkan alert Login berhasil
if (isset($_GET["login"])) {
    $login = $_GET["login"];
} else {
    $login = "";
}

if ($login == "sukses") {
    echo   "<script>
             alert('Login berhasil!');    
            </script>";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/home.css">
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark text-white"
            style=" background: -webkit-linear-gradient(left, #3498db, #f06292); box-shadow: 1px 2px 8px rgba(0, 0, 0, 65);">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">
                    <h1>MyKuota</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="transaksi.php">Transaksi Saya</a>
                        </li>
                    </ul>
                </div>

                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Akhir Navbar -->

    <!-- Form Pembelian Kuota -->
    <main>
        <div class="container mt-3">
            <form action="proses.php" method="post">
                <input type="hidden" name="kuota_name" id="kuota_name" value="" required>
                <input type="hidden" name="kuota_size" id="kuota_size" value="" required>
                <input type="hidden" name="kuota_price" id="kuota_price" value="" required>
                <div class="row g-2 mt-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInputGrid" name="nohp" required>
                            <label for="floatingInputGrid">No. Hp</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control" id="total_bayar" type="text" name="total_bayar" value="Rp 0"
                                readonly required>
                            <label for="floatingSelectGrid">Total bayar </label>
                        </div>
                    </div>
                </div>
                <dev class="row">
                    <div class="col-md-6">
                        <select class="form-select mt-4" name="provider" required>
                            <option>-- Pilih Provider --</option>
                            <option value="Telkomsel">Telkomsel</option>
                            <option value="IM3">IM3</option>
                            <option value="XL">XL</option>
                            <option value="AXIS">Axis</option>
                        </select>
                    </div>
                </dev>


                <div class="row row-cols-1 row-cols-md-3 g-4 mt-3" id="container-list">
                    <!-- Mengambil data listKuota dari folder assets/utils/data.php -->
                    <?php include("assets/utils/data.php"); ?>

                    <!-- Melakukan perulangan/menampilkan tiap2 data kuota dalam bentuk card ke layar -->
                    <?php foreach ($kuotaList as $kuota) : ?>
                    <div class="col">
                        <div class="card h-100 shadow rounded" id="kuota-item">
                            <div class="card-header">
                                <?php echo $kuota["kuota_name"]; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $kuota["kuota_size"]; ?></h5>
                                <p class="card-text">Rp <span id="cost"><?php echo $kuota["kuota_price"]; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-check mt-4">
                    <input class="form-check-input" type="radio" name="jenis_pembayaran" value="Bayar Sekarang"
                        required>
                    <label class="form-check-label" for="pembayaran">
                        Bayar Sekarang
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_pembayaran" value="Bayar Nanti" required>
                    <label class="form-check-label" for="pembayaran">
                        Bayar Nanti
                    </label>
                </div>

                <dev class="row">
                    <div class="col-md-6 mb-4 mt-3">
                        <select class="form-select" name="metode_pembayaran" required>
                            <option>-- Pilih Metode Pembayaran --</option>
                            <option value="Gopay">Gopay</option>
                            <option value="OVO">OVO</option>
                            <option value="ShopeePay">ShopeePay</option>
                            <option value="DANA">DANA</option>
                        </select>
                    </div>
                </dev>


                <button type="submit" class="btn btn-primary mb-5 btn-lg" name="beli">BELI</button>
            </form>

        </div>
    </main>
    <!-- Akhir Form Pembelian Kuota -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="./assets/js/script.js"></script>
</body>

</html>