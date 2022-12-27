<?php
// Fungsi untuk memulai SESSION
session_start();

// Sebelum masuk ke halaman login dicek dulu apakah user sudah login atau belum
// Jika ternyata sudah login maka user akan dikembalikan ke halaman home
if (isset($_SESSION["login"])) {
    header ("location : index.php"); 
    exit;
}

require "koneksi.php";

// Ketika tombol LOGIN diklik maka akan menjalankan fungsi di bawah
if (isset($_POST["submit"])) {
    // Mendapatkan username dan password yang diinputkan pengguna
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kemudian akan dilakukan pengecekan apakah username dan password yang diinputkan pengguna benar atau ada di database
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {

        // Cek password
        $row = mysqli_fetch_assoc($result);
        if(md5($password) === $row["password"]) {
            // Jika benar maka user akan dibuatkan SESSION untuk login dan diarahkan ke halaman home
            $_SESSION["login"] = true;
            header("location: index.php?login=sukses");
            exit;
        }    
    }

    // Jika username dan passwordnya salah akan ada pesan kesalahan
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/styles/login.css">
</head>

<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>Please login here</h2>
                <!-- Menampilkan pesan kesalahan jiak $error = true -->
                <?php if (isset($error)) : ?>
                <p style="color: red; font-style: italic; margin-top: 5px; font-weight: bold">Username / password salah!
                </p>
                <?php endif; ?>
            </div>
            <form action="" method="post" class="form">
                <label for="username" style="padding-top: 13px">&nbsp;
                    Username
                </label>
                <input type="text" id="username" name="username" class="form-content" required>
                <div class="form-border"></div>

                <label for="password" style="padding-top: 22px">&nbsp;
                    Password
                </label>
                <input type="password" id="password" name="password" class="form-content" autocomplete="on" required>
                <div class="form-border"></div>
                <br>
                <input type="submit" id="btn-submit" name="submit" value="LOGIN">
            </form>
        </div>
    </div>
</body>

</html>