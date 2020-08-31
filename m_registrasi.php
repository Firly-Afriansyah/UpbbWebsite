<?php

session_start();

if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

require 'functions.php';

if (isset($_POST['signup'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'm_login.php';
        </script>";
    } else {
        echo "<script>
        alert('Data tidak berhasil ditambahkan!');
        document.location.href = 'm_registrasi.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - UPB Bojongmangu</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

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
    <div class="container-fluid" style="height: 100vh;">
        <div class="row px-4" style="height: 100%;">
            <div class="col py-3">
                <h2 style="font-family: 'MuseoModerno', cursive;" class="mb-3 mt-3">Registrasi</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputText">Nama Lengkap</label>
                        <input type="text" class="form-control" id="exampleInputText" name="nama" placeholder="Nama Lengkap . . ." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJurusan">Jurusan</label>
                        <select class="custom-select" id="exampleInputJurusan" name="jurusan" required>
                            <option selected>--- Pilih Jurusan ---</option>
                            <optgroup label="FATEK">
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                                <option value="Arsitektur">Arsitektur</option>
                                <option value="Teknik Sipil">Teknik Sipil</option>
                                <option value="Teknik Industri">Teknik Industri</option>
                                <option value="Teknik Hasil Panen">Teknik Hasil Panen</option>
                            </optgroup>
                            <optgroup label="FEBIS">
                                <option value="Manajemen">Manajemen</option>
                                <option value="Akuntansi">D-III Akuntansi</option>
                                <option value="Hukum">Hukum</option>
                                <option value="PGSD">PGSD</option>
                                <option value="PGPAUD">PGPAUD</option>
                            </optgroup>
                            <optgroup label="STAI">
                                <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKelas">Tipe Kelas</label>
                        <select class="custom-select" id="exampleInputKelas" name="kelas" required>
                            <option selected>--- Pilih Tipe Kelas ---</option>
                            <option value="Reguler Pagi">Reguler Pagi</option>
                            <option value="Reguler Malam">Reguler Malam</option>
                            <option value="Reguler Weekend">Reguler Weekend</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSemester">Semester</label>
                        <select class="custom-select" id="exampleInputSemester" name="semester" required>
                            <option selected>--- Pilih Semester ---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="Lulus">Lulus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTelepon">Nomor HP / WA</label>
                        <input type="text" class="form-control" id="exampleInputTelepon" name="telepon" minlength="10" maxlength="12" placeholder="Nomor HP / WA . . ." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Baru</label>
                        <input type="password" minlength="6" class="form-control" id="exampleInputPassword1" name="password1" placeholder="Password Baru . . ." required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword2" name="password2" placeholder="Konfirmasi Password . . ." required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-3 mt-5" name="signup">DAFTAR</button>
                    <p class="text-center" style="display: block;">Sudah punya akun? <a href="m_login.php">Klik disini!</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>