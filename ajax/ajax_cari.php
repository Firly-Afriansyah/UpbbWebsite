<?php

session_start();
$id = $_SESSION['uid'];
require '../functions.php';

$mhs = singleQuery("SELECT * FROM mahasiswa WHERE id = '" . $id . "'");
$btn = singleQuery("SELECT * FROM admin");
$m = cari($_GET['keyword'], $id);

?>

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
            <li class="list-group-item borderless py-1 px-0">

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
    </div>
    <div class="col-1 span-offset"></div>
  </div>
<?php endforeach; ?>