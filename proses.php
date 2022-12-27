<?php 
// Fungsi untuk menajalankan SESSION
session_start();

// Sebelum user melakukan entrydata pembelian dicek dulu apakah user sudah login atau belum
// Jika belum maka user akan dikembalikan ke halaman login
if (!isset($_SESSION["login"])) {
    header("location: login.php"); 
    exit;
}
include("koneksi.php");

// Mendapatkan data yang diinputkan user
$nohp               = $_POST["nohp"];
$provider           = $_POST["provider"];
$kuota_name         = $_POST["kuota_name"];
$kuota_size         = $_POST["kuota_size"];
$kuota_price        = $_POST["kuota_price"];
$jenis_pembayaran   = $_POST["jenis_pembayaran"];
$metode_pembayaran  = $_POST["metode_pembayaran"];
$total_bayar        = $_POST["total_bayar"];

// Dicek apakah data yang diinputkan user terisi semua atau belum
if ($nohp && $provider != "-- Pilih Provider --" && $kuota_name && $kuota_size && $kuota_price && $jenis_pembayaran && $metode_pembayaran != "-- Pilih Metode Pembayaran --" && $total_bayar) {
    // Jika sudah terisi semua makan akan dijalankan perintah sql untuk menambahkan data ke database sesuai yang diinputkan user
    mysqli_query($conn, "INSERT INTO pembelian_kuota SET nohp='$nohp', provider='$provider', kuota_name='$kuota_name', kuota_size='$kuota_size', kuota_price='$kuota_price', jenis_pembayaran='$jenis_pembayaran', metode_pembayaran='$metode_pembayaran', total_bayar='$total_bayar'");

    // Jika berhasil akan menampilkan alert Berhasil membeli kuota dan diarahkan ke halaman home
    if (mysqli_affected_rows($conn) > 0) {
    echo '<script>
            alert("Berhasil membeli kuota")
            document.location.href = "index.php"
        </script>';
    } else {
        // Jika error akan menampilkan pesan error
        die(mysqli_error($conn));
    }
} else {
    // Jika inputannya tidak terisi semua akan menampilkan pesan kesalahan
    echo '<script>
            alert("Input harus terisi!")
            document.location.href = "index.php"
        </script>';
}
?>