<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$id = $_SESSION['uid'];

$mhs = singleQuery("SELECT * FROM mahasiswa WHERE id = '" . $id . "'");

if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah!');
        if(confirm('Apakah anda ingin mengupdate password juga?')) {
            document.location.href = 'edit_password.php';
        } else {
            document.location.href = 'index.php';
        };
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'edit_profile.php';
        </script>";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - UPB Bojongmangu</title>
    <link rel="stylesheet" href="css/style_profile.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h3 class="mb-3">EDIT DATA PRIBADI</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col py-3 border">
                    <input type="hidden" value="<?= $id; ?>" name="id">
                    <div class="form-group">
                        <label for="exampleInputText">Nama Lengkap</label>
                        <input type="text" class="form-control" id="exampleInputText" name="nama" placeholder="Nama Lengkap . . ." value="<?= $mhs['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJurusan">Jurusan</label>
                        <select class="custom-select" id="exampleInputJurusan" name="jurusan" required>
                            <option value="<?= $mhs['jurusan']; ?>" selected><?= $mhs['jurusan']; ?></option>
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
                            <option value="<?= $mhs['kelas']; ?>" selected><?= $mhs['kelas']; ?></option>
                            <option value="Reguler Pagi">Reguler Pagi</option>
                            <option value="Reguler Malam">Reguler Malam</option>
                            <option value="Reguler Weekend">Reguler Weekend</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSemester">Semester</label>
                        <select class="custom-select" id="exampleInputSemester" name="semester" required>
                            <option value="<?= $mhs['semester']; ?>" selected><?= $mhs['semester']; ?></option>
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
                        <input type="text" class="form-control" id="exampleInputTelepon" name="telepon" minlength="10" maxlength="12" placeholder="Nomor HP / WA . . ." value="<?= $mhs['telepon']; ?>" required>
                    </div>
                </div>
                <div class="col py-3 border confirm">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Masukan Password Anda</label>
                        <input type="password" minlength="6" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password . . ." required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1"> Apakah anda sudah yakin dengan data yang anda masukan?</label>
                        <p>Pastikan data yang anda masukan sesuai dengan data anda yang sebenar - benarnya.</p>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-5" name="ubah">UBAH</button>
                    <a href="index.php" class="btn btn-secondary btn-block mb-3">BATAL</a>
                </div>
            </div>
        </form>
    </div>



    <script src="js/script.js"></script>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>