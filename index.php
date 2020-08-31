<?php

session_start();

$id = $_SESSION['uid'];

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}


require 'functions.php';


$mhs = singleQuery("SELECT * FROM mahasiswa WHERE id = '" . $id . "'");
$btn = singleQuery("SELECT * FROM admin");

if ($mhs['role_id'] == 1) {
  $m = query("SELECT * FROM mahasiswa");
  $member = "Admin";
} else {
  $m = query("SELECT * FROM mahasiswa WHERE activation != 'Not'");
  $member = "Anggota";
}

if ($mhs['gambar'] == "nophoto.png") {
  echo "<script>
    if (confirm('Anda belum mengupload foto! Upload foto sekarang?')) {
      alert('Siapkan Foto anda! pastikan upload dengan foto nampak wajah pribadi!');
      document.location.href = 'upload_ava.php';
  }
  </script>";
}

if (isset($_POST['active'])) {
  if (aktivasi($_POST) >= 0) {
    echo "<script>
    alert('Aktivasi atau Nonaktivasi Berhasil!');
    document.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
    alert('Aktivasi atau Nonaktivasi Gagal!');
    document.location.href = 'index.php';
    </script>";
  }
}

if (isset($_POST['hapus'])) {
  if (hapus($_POST) >= 0) {
    echo "<script>
        alert('Akun berhasil dihapus!');
        document.location.href = 'index.php';
      </script>";
  } else {
    echo "<script>
      alert('Akun gagal dihapus!');
      document.location.href = 'index.php';
      </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Anggota UPB Bojongmangu</title>
  <link rel="stylesheet" href="css/style_main.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">

    <div class="row">
      <div class="col-1 px-0 side">
        <a href="#sidebar" class="sidebar">
          <i class="material-icons md-dark">
            apps
          </i>
        </a>
        <div class="overlay" id="sidebar">
          <div class="container-fluid">
            <a href="#">
              <i class="material-icons md-dark">
                apps
              </i>
            </a>
            <div class="py-3 px-5">
              <div style="width: 100%;">
                <div class="image text-center ">
                  <img src="img/<?= $mhs['gambar']; ?>" alt="" width="100" class="mb-2">
                  <div class="tombol mb-3">
                    <a href="upload_ava.php" type="button" class="btn btn-outline-secondary btn-sm">Ganti Foto</a>
                  </div>
                </div>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item" style="padding-left: 0 !important;">
                  <div class="row">
                    <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">face</i></div>
                    <div class="col my-1">
                      <p style="display: inline;"><?= $mhs['nama']; ?></p>
                    </div>
                  </div>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important;">
                  <div class="row">
                    <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">book</i></div>
                    <div class="col my-1">
                      <p style="display: inline;"><?= $mhs['jurusan']; ?></p>
                    </div>
                  </div>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important;">
                  <div class="row">
                    <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">domain</i></div>
                    <div class="col my-1">
                      <p style="display: inline;">Universitas Pelita Bangsa</p>
                    </div>
                  </div>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important;">
                  <div class="row">
                    <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">date_range</i></div>
                    <div class="col my-1">
                      <p style="display: inline;">Semester <?= $mhs['semester']; ?></p>
                    </div>
                  </div>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important;">
                  <div class="row">
                    <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">verified_user</i></div>
                    <div class="col my-1">
                      <p style="display: inline;"><?= $member; ?></p>
                    </div>
                  </div>
                </li>
              </ul>
              <a href="edit_profile.php" class="btn btn-outline-secondary mt-1" style="width: 100%;">EDIT PROFILE</a>
              <hr>
              <div class="text-center">
                <a href="logout.php" class="btn btn-danger" style="width: 70%;">LOGOUT</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col px-4">
        <h3 class="title">WEBSITE DATA ANGGOTA UPB BOJONGMANGU &copy</h3>
      </div>
    </div>

    <!-- Sider Profile -->
    <div class="row">
      <div class="col-2 py-3 border profile">
        <div style="width: 100%;">
          <div class="image text-right ">
            <img src="img/<?= $mhs['gambar']; ?>" alt="" width="100%" class="mb-2">
            <div class="tombol">
              <a href="upload_ava.php" type="button" class="btn btn-outline-secondary btn-sm">Ganti Foto</a>
            </div>
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item" style="padding-left: 0 !important;">
            <div class="row">
              <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">face</i></div>
              <div class="col my-1">
                <p style="display: inline;"><?= $mhs['nama']; ?></p>
              </div>
            </div>
          </li>
          <li class="list-group-item" style="padding-left: 0 !important;">
            <div class="row">
              <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">book</i></div>
              <div class="col my-1">
                <p style="display: inline;"><?= $mhs['jurusan']; ?></p>
              </div>
            </div>
          </li>
          <li class="list-group-item" style="padding-left: 0 !important;">
            <div class="row">
              <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">domain</i></div>
              <div class="col my-1">
                <p style="display: inline;">Universitas Pelita Bangsa</p>
              </div>
            </div>
          </li>
          <li class="list-group-item" style="padding-left: 0 !important;">
            <div class="row">
              <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">date_range</i></div>
              <div class="col my-1">
                <p style="display: inline;">Semester <?= $mhs['semester']; ?></p>
              </div>
            </div>
          </li>
          <li class="list-group-item" style="padding-left: 0 !important;">
            <div class="row">
              <div class="col-2 my-auto"><i class="material-icons mr-2 my-auto">verified_user</i></div>
              <div class="col my-1">
                <p style="display: inline;"><?= $member; ?></p>
              </div>
            </div>
          </li>
        </ul>
        <a href="edit_profile.php" class="btn btn-outline-secondary mt-1" style="width: 100%;">EDIT PROFILE</a>
        <hr>
        <div class="text-center">
          <a href="logout.php" class="btn btn-danger" style="width: 70%;">LOGOUT</a>
        </div>
      </div>
      <div class="col utama">
        <h4 class="text-center mb-4 mt-3 sub-judul">DATA ANGGOTA UPB BOJONGMANGU</h4>
        <div class="container">
          <div class="row">
            <div class="col-1 span-offset"></div>
            <div class="col py-3 px-0">
              <form action="" method="POST">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Cari</span>
                  </div>
                  <input type="text" class="form-control keyword" aria-label="Text input with dropdown button" placeholder="Masukan Nama, Jurusan, Tipe Kelas, atau Nomor Telepon">
                </div>
              </form>
            </div>
            <div class="col-1 span-offset"></div>
          </div>
          <div class="search">
            <?php foreach ($m as $m) : ?>
              <div class="row mb-2">
                <div class="col-1 span-offset"></div>
                <div class="col-3 px-0 text-center con-img">
                  <div class="ava">
                    <img src="img/<?= $m['gambar']; ?>" class="py-auto foto">
                  </div>
                </div>
                <div class="col py-3 px-4 data-main">
                  <div class="row ">
                    <div class="col-5 px-2 my-auto">
                      <ul class="list-group judul">
                        <li class="list-group-item borderless py-1 px-0">
                          <h5>Nama Lengkap</h5>
                        </li>
                        <li class="list-group-item borderless py-1 px-0">
                          <h5>Jurusan</h5>
                        </li>
                        <li class="list-group-item borderless py-1 px-0">
                          <h5>Semester</h5>
                        </li>
                        <li class="list-group-item borderless py-1 px-0">
                          <h5>Tipe Kelas</h5>
                        </li>
                        <li class="list-group-item borderless py-1 px-0">
                          <h5>Nomor HP / WA</h5>
                        </li>
                      </ul>
                    </div>
                    <div class="col px-0">
                      <ul class="list-group data">
                        <li class="list-group-item borderless py-1 ">
                          <h5 class="font-weight-light"><b>:</b> <?= $m['nama']; ?></h5>
                        </li>
                        <li class="list-group-item borderless py-1 font-weight-lighter">
                          <h5 class="font-weight-light"><b>:</b> <?= $m['jurusan']; ?></h5>
                        </li>
                        <li class="list-group-item borderless py-1 font-weight-lighter">
                          <h5 class="font-weight-light"><b>:</b> <?= $m['semester']; ?></h5>
                        </li>
                        <li class="list-group-item borderless py-1 font-weight-lighter">
                          <h5 class="font-weight-light"><b>:</b> <?= $m['kelas']; ?></h5>
                        </li>
                        <li class="list-group-item borderless py-1 font-weight-lighter">
                          <h5 class="font-weight-light"><b>:</b> <?= $m['telepon']; ?></h5>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col px-2 mt-2">
                      <?php if ($mhs['role_id'] == 1) : ?>
                        <form action="" method="POST">
                          <input type="hidden" name="id" value="<?= $m['id']; ?>">
                          <?php if ($m['activation'] == "Active" && $m['role_id'] != 1) {
                            echo $btn['btn_active'] . " ";
                            echo $btn['btn_hapus'];
                          } else if (($m['activation'] == "Not" && $m['role_id'] != 1)) {
                            echo $btn['btn_notActive'] . " ";
                            echo $btn['btn_hapus'];
                          } else {
                            echo "<button type='button' class='btn btn-info' disabled>Admin</button>";
                          } ?>
                        </form>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="col-1 span-offset"></div>
              </div>
            <?php endforeach; ?>
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