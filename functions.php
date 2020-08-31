<?php

function koneksi()
{
    return mysqli_connect('localhost', 'root', '', 'pw_311910002');
}

function query($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
}

function singleQuery($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    return $rows;
}

function login($data)
{
    $conn = koneksi();

    $nama = htmlspecialchars($data['nama']);
    $password = htmlspecialchars($data['password']);
    $pass = password_verify($password, PASSWORD_DEFAULT);


    if ($user = singleQuery("SELECT * FROM mahasiswa WHERE nama = '" . $nama . "'")) {
        if (password_verify($password, $user['password'])) {
            if ($user['activation'] == "Active") {
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $user['id'];
                header("Location: index.php");
                exit;
            } else {
                return [
                    'error' => true,
                    'pesan' => "Akun anda masih ditinjau oleh admin!"
                ];
            }
        }
    }

    return [
        'error' => true,
        'pesan' => "Nama atau Nomor anda salah!"
    ];
}

function registrasi($data)
{
    $conn = koneksi();

    $nama = htmlspecialchars($data['nama']);
    $jurusan = $data['jurusan'];
    $kelas = $data['kelas'];
    $semester = $data['semester'];
    $telepon = htmlspecialchars($data['telepon']);
    $gambar = "nophoto.png";
    $activation = "Not";
    $password1 = htmlspecialchars($data['password1']);
    $password2 = htmlspecialchars($data['password2']);

    // cek nama
    if (singleQuery("SELECT nama FROM mahasiswa WHERE nama = '" . $nama . "'")) {
        echo "<script>
        alert('Nama anda sudah terdaftar!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if (
        $jurusan != "Teknik Informatika" && $jurusan != "Teknik Lingkungan" && $jurusan != "Arsitektur" && $jurusan != "Teknik Sipil" && $jurusan != "Teknik Industri" &&
        $jurusan != "Teknik Hasil Panen" && $jurusan != "Manajemen" && $jurusan != "Akuntansi" && $jurusan != "Hukum" && $jurusan != "PGSD" && $jurusan != "PGPAUD" && $jurusan != "Ekonomi Syariah"
    ) {
        echo "<script>
        alert('Silahkan pilih jurusan anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if ($kelas != "Reguler Pagi" && $kelas != "Reguler Malam" && $kelas != "Reguler Weekend") {
        echo "<script>
        alert('Silahkan pilih tipe kelas anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if ($semester != "1" && $semester != "2" && $semester != "3" &&  $semester != "4" &&  $semester != "5" &&  $semester != "6" &&  $semester != "7" &&  $semester != "8" &&  $semester != "Lulus") {
        echo "<script>
        alert('Silahkan pilih semester anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    $search = '08';
    if (!preg_match("/{$search}/i", $telepon) || strpos($telepon, $search) != 0) {
        echo "<script>
        alert('Format nomor HP / WA anda salah! (ex. 08.......)');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if (singleQuery("SELECT telepon FROM mahasiswa WHERE telepon = '" . $telepon . "'")) {
        echo "<script>
        alert('Nomor anda sudah terdaftar!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if ($password1 != $password2) {
        echo "<script>
        alert('Password tidak sama!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    $pass = password_hash($password1, PASSWORD_DEFAULT);

    $query = "INSERT INTO mahasiswa VALUES (null, '$nama', '$jurusan', '$kelas', '$semester', '$telepon', '$pass', '$gambar', '0', '$activation')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function cari($keyword, $id)
{
    $conn = koneksi();
    $user = singleQuery("SELECT role_id FROM mahasiswa WHERE id = '" . $id . "'");

    if ($user['role_id'] == 1) {
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR telepon LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR activation LIKE '%$keyword%'";
    } else {
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR telepon LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR activation LIKE '%$keyword%' AND activation != 'Not'";
    }

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload($id)
{

    $conn = koneksi();

    $data = singleQuery("SELECT gambar FROM mahasiswa WHERE id = '" . $id . "'");

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        return 'nophoto.png';
    }

    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
    alert('Format gambar tidak didukung!');
    </script>";
        return false;
    }

    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
        alert('Format gambar tidak didukung!');
        </script>";
        return false;
    }

    if ($ukuran_file > 5000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    unlink('img/' . $data['gambar']);

    mysqli_query($conn, "UPDATE mahasiswa SET gambar = '" . $nama_file_baru . "' WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    $conn = koneksi();

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $jurusan = $data['jurusan'];
    $kelas = $data['kelas'];
    $semester = $data['semester'];
    $telepon = htmlspecialchars($data['telepon']);
    $password = htmlspecialchars($data['password']);

    $mhs = singleQuery("SELECT * FROM mahasiswa WHERE id = '" . $id . "'");

    if (!password_verify($password, $mhs['password'])) {
        echo "<script>
        alert('Password yang anda masukan salah!')
        document.location.href = 'edit_profile.php'
        </script>";
    }

    if (singleQuery("SELECT nama FROM mahasiswa WHERE nama = '" . $nama . "'") && $nama != $mhs['nama']) {
        echo "<script>
        alert('Nama anda sudah terdaftar!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if (
        $jurusan != "Teknik Informatika" && $jurusan != "Teknik Lingkungan" && $jurusan != "Arsitektur" && $jurusan != "Teknik Sipil" && $jurusan != "Teknik Industri" &&
        $jurusan != "Teknik Hasil Panen" && $jurusan != "Manajemen" && $jurusan != "Akuntansi" && $jurusan != "Hukum" && $jurusan != "PGSD" && $jurusan != "PGPAUD" && $jurusan != "Ekonomi Syariah"
    ) {
        echo "<script>
        alert('Silahkan pilih jurusan anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if ($kelas != "Reguler Pagi" && $kelas != "Reguler Malam" && $kelas != "Reguler Weekend") {
        echo "<script>
        alert('Silahkan pilih tipe kelas anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if ($semester != "1" && $semester != "2" && $semester != "3" &&  $semester != "4" &&  $semester != "5" &&  $semester != "6" &&  $semester != "7" &&  $semester != "8" &&  $semester != "Lulus") {
        echo "<script>
        alert('Silahkan pilih semester anda!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    $search = '08';
    if (!preg_match("/{$search}/i", $telepon) || strpos($telepon, $search) != 0) {
        echo "<script>
        alert('Format nomor HP / WA anda salah! (ex. 08.......)');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    if (singleQuery("SELECT telepon FROM mahasiswa WHERE telepon = '" . $telepon . "'") && $telepon != $mhs['telepon']) {
        echo "<script>
        alert('Nomor anda sudah terdaftar!');
        ddocument.location.href = 'registrasi.php';
        </script>";
        return false;
    }

    mysqli_query($conn, "UPDATE mahasiswa SET nama = '" . $nama . "', jurusan = '" . $jurusan . "', kelas = '" . $kelas . "', semester = '" . $semester . "', telepon = '" . $telepon . "' WHERE id = '" . $id . "'") or die($conn);
    return mysqli_affected_rows($conn);
}

function ubahPassword($data)
{
    $conn = koneksi();

    $password_lama = htmlspecialchars($data['password1']);
    $password_baru = htmlspecialchars($data['password2']);
    $konfirmasi_password = htmlspecialchars($data['password3']);
    $id = $data['id'];
    $mhs = singleQuery("SELECT * FROM mahasiswa WHERE id = '" . $id . "'");

    if (!password_verify($password_lama, $mhs['password'])) {
        echo "<script>
        alert('Password lama salah!');
        document.location.href = 'edit_password.php'
        </script>";
    } else {
        if ($password_baru != $konfirmasi_password) {
            echo "<script>
            alert('Password tidak sama!');
            document.location.href = 'edit_password.php'
            </script>";
        } else {
            $password = password_hash($password_baru, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE mahasiswa SET password = '" . $password . "' WHERE id = '" . $id . "'") or die($conn);
            return mysqli_affected_rows($conn);
        }
    }
}


function aktivasi($data)
{
    $conn = koneksi();
    $id = $data['id'];
    $mhs = singleQuery("SELECT activation FROM mahasiswa WHERE id = '" . $id . "'");
    if ($mhs['activation'] == "Active") {
        $aktivasi = "Not";
    } else {
        $aktivasi = "Active";
    }

    mysqli_query($conn, "UPDATE mahasiswa SET activation = '" . $aktivasi . "' WHERE id = '" . $id . "'") or die($conn);
    mysqli_affected_rows($conn);
}

function hapus($data)
{
    $conn = koneksi();
    $id = $data["id"];

    $data = singleQuery("SELECT gambar FROM mahasiswa WHERE id = '" . $id . "'");
    $gambar = $data['gambar'];

    unlink('img/' . $gambar);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '" . $id . "'") or die($conn);
    mysqli_affected_rows($conn);
}
