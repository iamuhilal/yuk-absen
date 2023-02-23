<?php
session_start();
require 'configDB.php';
include 'function.php';
cekstatus();

// Make Absen
if (isset($_POST["check"])) {
  $absenkey = $_POST["absenkey"];
  $queryView = "SELECT * FROM tb_maker WHERE absenkey = '$absenkey'";
  $result = mysqli_query(connDB(), $queryView);

  // cek absenkey
  if (mysqli_num_rows($result) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($result);
    if ($row["status"] == true) { //jika status abesnsi masih keadaan true, maka akan masuk kedalam absensi
      $_SESSION["absen"] = true;
      $_SESSION["idmaker"] = $row["id_maker"];

      header("Location: absen.php");
      exit;
    } else {
      echo "<script>
      alert('Attendance Roll Has Done');
      </script>";
    }
  } else {
    echo "<script>
    alert('Code Invalid');
    </script>";
  }
}

?>


<!doctype html>
<html lang="en" style="height : 100%;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Yuk Absen</title>
</head>

<body style="background-color : #4A97FF; height : 100%;">
  <div class="container d-flex justify-content-center align-items-center" style="height:100%;">
    <div class="container p-5 col-4 rounded" style="background-color : white;">
      <div class="row mb-3 d-flex justify-content-between">
        <h1 class="mx-auto" style="color : #4A97FF; font-weight : bold;">YUK ABSEN</h1>
      </div>

      <div class="row d-flex justify-content-center">

        <?php if (isset($errorkey)) : ?>
          <p style="color: red; font-style: italic">Attendance Roll Code Invalid</p>
        <?php endif; ?>
        <?php if (isset($timeout)) : ?>
          <p style="color: red; font-style: italic">Attendance Roll Has Over</p>
        <?php endif; ?>
        <form action="" method="post">
          <div class="form-group">
            <input type="text" name="absenkey" id="absenkey" class="form-control" placeholder="Input Attendance Roll Code">
          </div>
          <div class=" text-center">
            <button type="submit" name="check" class="btn btn-block btn-dark" style="background-color: #4A97FF; border:none;">Check</button>
          </div>
          <div class="mt-3 mb-4" style="width: 100%; height: 15px; border-bottom: 1px solid #3E3E3E; text-align: center">
            <span style="font-size: 15px; background-color: white; color:#3E3E3E; padding: 0 10px;">
              OR
            </span>
          </div>
          <div class=" text-center">
            <a href="login.php"><button type="button" class="btn btn-block btn-dark" style="border:none;">Make Attendance Roll</button></a>

          </div>
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