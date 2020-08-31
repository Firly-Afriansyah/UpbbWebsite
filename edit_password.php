<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$id = $_SESSION['uid'];

if (isset($_POST['password'])) {
    if (ubahPassword($_POST) >= 0) {
        echo "<script>
        alert('Password berhasil diubah!')
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Password gagal diubah!')
        document.location.href = 'edit_password.php'
        </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - UPB Bojongmangu</title>

    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h3>UBAH PASSWORD</h3>
        <div class="row mt-5">
            <!-- <div class="col-2"></div> -->
            <div class="col">
                <form action="" method="POST">
                    <input type="hidden" value="<?= $id; ?>" name="id">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Lama Anda</label>
                        <input type="password" minlength="6" class="form-control" id="exampleInputPassword1" name="password1" placeholder="Password Lama Anda . . ." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Masukan Password Baru</label>
                        <input type="password" minlength="6" class="form-control" id="exampleInputPassword2" name="password2" placeholder="Password Baru . . ." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Konfirmasi Password Baru</label>
                        <input type="password" minlength="6" class="form-control" id="exampleInputPassword3" name="password3" placeholder="Ulangi Password Baru . . ." required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-5" name="password">UBAH</button>
                    <a href="index.php" class="btn btn-secondary btn-block mb-3">BATAL</a>
                </form>
            </div>
            <!-- <div class="col-3"></div> -->
        </div>
    </div>

    <script src="js/script.js"></script>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>