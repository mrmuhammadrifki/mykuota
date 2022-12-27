<?php
// Fungsi untuk menajalankan SESSION
session_start();

// Sebelum user masuk ke halaman transaksi dicek dulu apakah user sudah login atau belum
// Jika belum maka user akan dikembalikan ke halaman login
if (!isset($_SESSION["login"])) {
    header("location: login.php"); 
    exit;
}
include("koneksi.php");

$sukses     = "";
$error      = "";

// Untuk memberitahu user ketika data berhasil dihapus atau tidak
if (isset($_GET["delete"])) {
    $delete = $_GET["delete"];
} else {
    $delete = "";
}

if ($delete == "sukses") {
    $sukses = "Berhasil hapus data";
} 

if ($delete == "error") {
    $error = "Gagal menghapus data";
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaksi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="transaksi.php">Transaksi Saya</a>
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
    <!-- Akhr Navbar -->

    <!-- Tabel Riwayat Transaksi -->
    <main>
        <div class="container">
            <h1 class="mt-3 mb-5">Riwayat Transaksi</h1>
            <?php 
            if ($sukses) {
            ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $sukses;
            ?>
            </div>
            <?php
            header("refresh:5;url=transaksi.php");
            }
            ?>

            <?php 
            if ($error) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $error;
            ?>
            </div>
            <?php
            header("refresh:5;url=transaksi.php");
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No. HP</th>
                        <th scope="col">Provider</th>
                        <th scope="col">Nama Kuota</th>
                        <th scope="col">Besaran</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Dibuat Pada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM pembelian_kuota ORDER BY kuota_id DESC";
                    $query = mysqli_query($conn, $sql);
                    $urut = 1;

                    while($row = mysqli_fetch_array($query)) {
                        $kuota_id           = $row["kuota_id"];
                        $nohp               = $row["nohp"];
                        $provider           = $row["provider"];
                        $kuota_name         = $row["kuota_name"];
                        $kuota_size         = $row["kuota_size"];
                        $jenis_pembayaran   = $row["jenis_pembayaran"];
                        $metode_pembayaran  = $row["metode_pembayaran"];
                        $total_bayar        = $row["total_bayar"];
                        $created_at         = $row["created_at"];

                    ?>
                    <tr>
                        <th scope="row"><?php echo $urut++; ?></th>
                        <td scope="row"><?php echo $nohp ?></td>
                        <td scope="row"><?php echo $provider ?></td>
                        <td scope="row"><?php echo $kuota_name ?></td>
                        <td scope="row"><?php echo $kuota_size ?></td>
                        <td scope="row"><?php echo $jenis_pembayaran ?></td>
                        <td scope="row"><?php echo $metode_pembayaran ?></td>
                        <td scope="row"><?php echo $total_bayar ?></td>
                        <td scope="row"><?php echo date("d F Y, G:i", strtotime($created_at)) ?></td>
                        <td scope="row"><span class="badge text-bg-success">Success</span></td>
                        <td scope="row">



                            <a href="hapus.php?kuota_id=<?php echo $kuota_id ?>"
                                onclick="return confirm('Yakin ingin delete data?')"> <button type="button"
                                    class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
            <a href="index.php"> <button type="button" class="btn btn-secondary">kembali</button></a>
        </div>
    </main>
    <!-- Akhir Riwayat Transaksi -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>