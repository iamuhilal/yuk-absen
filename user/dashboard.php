<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
//koneksi ke database
require '../configDB.php';
include '../function.php';
cekstatus();

// $queryView = "SELECT * FROM tb_admin";
// $result = mysqli_query(connDB(), $queryView);

if (isset($_POST["make"])) {

  $error = 0;

  $nama = $_POST["nama"];
  $desc = $_POST["desc"];
  $time = $_POST["time"];
  $timebool = timebanding($_POST['time']);
  // echo $timebool;


  if ($nama == NULL) {
    $namakos = true;
    $error = 1;
  }if ($desc == NULL) {
    $desckos = true;
    $error = 1;
  }if ($timebool == false) {
    $timekos = true;
    $error = 1;
  }if ($error == 1) {
    //jika error = 1, halaman akan menampilkan eror
  }else {
    $iduser = $_SESSION["iduser"]; //mendapatkan nilai id user dari saat login
    $keyabsen = genkey().$iduser;
    // echo $keyabsen;

    $querySign = "INSERT INTO tb_maker (`id_user`, `absenkey`, `title_absen`, `desc_absen`, `time_end`, `status`)
    VALUES( '$iduser', '$keyabsen', '$nama', '$desc', '$time', '$timebool')";

    mysqli_query(connDB(), $querySign);
    echo "<script>
    alert('absensi telah dibuat ! Absen Key = $keyabsen');
    </script>";

  }
} else {
  echo mysqli_error(connDB());
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary fixed-top flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-7 col-md-2 mr-0" href="#">Hai <?php echo $_SESSION["user"];?></a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </nav>

    <!-- container -->
    <div class="container-fluid">
      <div class="row">
        <!-- sidebar -->
        <div class="col-md-2 bg-light d-none d-md-block sidebar">
          <div class="left-sidebar">
            <ul class="nav flex-column sidebar-nav">
              <li class="nav-item">
                <a class="nav-link font-weight-bold" href="#">Buat Absen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list.php">List Absen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- main -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h3 class="text-center">Buat Absen</h3>
          <hr>

          <div class="mt-5  container">
            <form action="" method="post" enctype="multipart/form-data">

<!-- NAMA -->
              <?php if (isset($namakos)) : ?>
                <p style="color: red; font-style: italic">nama kosong</p>
              <?php endif; ?>
              <div class="form-group mb-3">
                <span style="color: red;">*</span>
                <label for="nama">Nama Absensi</label>
                <input type="text" name="nama" id="nama" class="form-control">
              </div>

<!-- DESCRIPTION -->
              <?php if (isset($desckos)) : ?>
                <p style="color: red; font-style: italic">deskripsi kosong</p>
              <?php endif; ?>
              <div class="form-group mb-3">
                <span style="color: red;">*</span>
                <label for="desc">Deskripsi Absen</label>
                <textarea type="text" class="form-control" name="desc" id="desc" rows="4"></textarea>
              </div>

<!-- DATE -->
              <?php if (isset($timekos)) : ?>
                <p style="color: red; font-style: italic">deadline kosong / sudah melewati tanggal</p>
              <?php endif; ?>
              <div class="form-group mb-3">
                <span style="color: red;">*</span>
                <label for="time">Deadline Absen</label><br>
                <input type="datetime-local" name="time">
              </div>

              <button type="submit" name="make" class="btn btn-primary">Buat</button>
            </form>
          </div>
        </main>

      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
