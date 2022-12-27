<?php 
// Fungsi untuk menajalankan SESSION
session_start();

// Sebelum user menghapus data dicek dulu apakah user sudah login atau belum
// Jika belum maka user akan dikembalikan ke halaman login
if (!isset($_SESSION["login"])) {
    header("location: login.php"); 
    exit;
}

include("koneksi.php");
// Mendapatkan kuota_id dari url
$kuota_id   = $_GET["kuota_id"];

// Melakukan perintah sql untuk menghapus data berdasarkan kuota_id
$sql        = "DELETE FROM pembelian_kuota WHERE kuota_id='$kuota_id'";
$query      = mysqli_query($conn, $sql);

// Jika berhasil akan diarahkan ke halaman transaksi.php dan menampilkan pesan berhasil
if ($query) {
    header("location: transaksi.php?delete=sukses");
    exit;
} else {
    header("location: transaksi.php?delete=error");
}








require("koneksi.php");

// Perintah sql untuk menampilkan data default inputannya berdasarkan id data yang dipilih
$noanggota  = $_GET["noanggota"];
$sql1       = "SELECT FROM anggota WHERE noanggota = '$noanggota'";
$q1         = mysqli_query($conn, $sql1);
$r1         = mysqli_fetch_array($q1);
$nama       = $r1["nama"];
$alamat     = $r1["alamat"];
$nohp       = $r1["nohp"];


// Perintah untuk mengupdate data berdasarkan noanggota
if ($nama && $alamat && $nohp) {
    $sql1   = "UPDATE anggota SET nama = '$nama', alamat = '$alamat', nohp = '$nohp' WHERE noanggota = '$noanggota'";
    $q1     = mysqli_query($conn, $sql);

    if ($q1) {
        echo    "<script>
                    alert('Data berhasil diupdate)
                </script>";
    } else {
        echo    "<script>
                    alert('Data gagal diupdate)
                 </script>";
    }
}









?>