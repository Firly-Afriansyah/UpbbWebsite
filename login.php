<?php

session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST['login'])) {
    $login = login($_POST);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UPB Bojongmangu</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style_login.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">


    <style>
        body {
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid border" style="height: 100vh;">
        <div class="row" style="height: 100%;">
            <div class="col-3 border py-5 login">
                <h2 style="font-family: 'MuseoModerno', cursive;" class="mb-4 mt-5">Login</h2>
                <?php if (isset($login['error'])) : ?>
                    <p style="color: red; font-style:italic;"><?= $login['pesan']; ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputText">Nama Lengkap</label>
                        <input type="text" class="form-control" id="exampleInputText" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <p class="text-right mb-3" style="display: block;">Lupa password? <a href="lupa_password.php">Klik disini!</a></p><br>
                    <button type="submit" class="btn btn-primary btn-block mb-5" name="login">LOGIN</button>
                    <p class="text-center mb-3" style="display: block;">Belum punya akun? <a href="registrasi.php">Klik disini!</a></p>
                </form>
            </div>
            <div class="col border text-center py-5">
                <h1 class="mt-2 font-weight-bold" style="font-family: 'Ubuntu', sans-serif; font-size:30px;">Selamat Datang!</h1>
                <h1 class="mt-4" style="font-family: 'Ubuntu', sans-serif;">di Website</h1>
                <h1 class="mb-5" style="font-family: 'Ubuntu', sans-serif;">Data Anggota UPB Bojongmangu</h1>
                <img src="img/upbb_logo.png" class="mb-5" width="250">
                <div class="text-center m-login">
                    <a href="m_login.php" class="btn btn-primary ">LOGIN</a>
                    <a href="m_registrasi.php" class="btn btn-success">DAFTAR</a>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>