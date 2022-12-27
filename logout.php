<?php

// ketika user menekan tombol logout maka fungsi di bawah akan dijalankan

// Fungsi2 ini akan menghapus SESSION login dari user sehigga user akan diarahkan lagi ke halaman login
session_start();
$_SESSION = [];
session_unset(); 
session_destroy();

header("location: login.php"); 
exit;


?>