<?php
session_start();

if (!isset($_SESSION["absen"])) {
  header("Location: index.php");
  exit;
}

require 'configDB.php';
include 'function.php';
cekstatus();

if (isset($_POST["absen"])) {

  $nilaikos = 0;
  $nama = $_POST["nama"];
  $npm = $_POST["npm"];
  $idmaker = $_SESSION["idmaker"];
  $_SESSION["absensi"] = true;

  $queryView = "SELECT * FROM tb_maker WHERE id_maker = '$idmaker'";
  $result = mysqli_query(connDB(), $queryView);
  $row = mysqli_fetch_assoc($result);

  if (timebanding($row["time_end"]) == true) { //jika waktunya habis maka tidak bisa input absensi
    if ($nama == NULL) {
      $namakos = true;
      $nilaikos = 1;
    }
    if ($npm == NULL) {
      $npmkos = true;
      $nilaikos = 1;
    }
    if ($nilaikos == 1) {
      //jika nilaikos = 1, halaman akan menampilkan eror
    } else {
      $queryAbs = "INSERT INTO tb_absen (`id_maker`, `nama_mhs`, `npm_mhs`) VALUES( '$idmaker', '$nama', '$npm')";
      mysqli_query(connDB(), $queryAbs);
      $_SESSION["absendone"] = true;
      header("Location: endabsen.php");
    }
  } else {
    // Waktu habis sebelum menekan tombol absensi
    $_SESSION["absendone"] = false;
    header("Location: endabsen.php");
  }
}


?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Yuk Absen</title>
</head>

<body>


  <div class="container mt-5">
    <div class="row">
      <div class="col mr-5">
        <!-- SIGNUP -->
        <h2 class="text-center">Fill Attendance Roll</h2>
        <form action="" method="post">
          <?php if (isset($namakos)) : ?>
            <p style="color: red; font-style: italic">name empty</p>
          <?php endif; ?>
          <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="input name">
          </div>


          <?php if (isset($npmkos)) : ?>
            <p style="color: red; font-style: italic">student id empty</p>
          <?php endif; ?>
          <div class="form-group">
            <label for="npm">Studen Id</label>
            <input type="text" name="npm" id="npm" class="form-control" placeholder="input student id">
          </div>


          <button type="submit" name="absen" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>