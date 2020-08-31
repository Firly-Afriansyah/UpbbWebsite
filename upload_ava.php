<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['uid'];

require 'functions.php';

if (isset($_POST['upload'])) {
    if (upload($id) > 0) {
        echo "<script>
        alert('Foto berhasil diupload!');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Foto gagal diupload!');
        document.location.href = 'upload_ava.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Foto - UPB Bojongmangu</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style_ava.css">

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

            <div class="col border py-4">
                <h2 style="font-family: 'MuseoModerno', cursive;" class="mb-4">Upload Foto</h2>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" onchange="previewImg()" class="custom-file-input gambar" id="inputGroupFile01" name="gambar" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Pilih Foto</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <img src="img/nophoto.png" width="200px" class="img-preview">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-5" name="upload">UPLOAD</button>
                    <a href="index.php" class="btn btn-secondary btn-block">LEWATI</a>
                </form>
            </div>


            <div class="col-9 border text-center py-5 contain">
                <h1 class="mt-4" style="font-family: 'Ubuntu', sans-serif;">Website</h1>
                <h1 class="mb-5" style="font-family: 'Ubuntu', sans-serif;">Data Anggota UPB Bojongmangu</h1>
                <img src="img/upbb_logo.png" width="250">
            </div>
        </div>
    </div>



    <script src="js/script.js"></script>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>