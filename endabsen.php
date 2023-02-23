<?php
session_start();

if (!isset($_SESSION["absensi"])) {
  header("Location: index.php");
  exit;
}
include 'function.php';
cekstatus();


// saat user menekan tombol Continue
if (isset($_POST["continue"])) {
  header("Location: doneabsen.php");
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

  <title>Thank You</title>
</head>

<body style="background-color : #4A97FF; height : 100%;">
  <div class="container d-flex justify-content-center align-items-center" style="height:100%;">
    <div class="container p-5 col-10">
      <div class="row mb-3 d-flex justify-content-between">
        <h1 class="mx-auto" style="color : white; font-weight : bold;">
          <?php if ($_SESSION["absendone"] == true) {
            echo "Attendance Roll Done";
          } else {
            echo "Attendance Roll Has Over";
          } ?>
        </h1>
      </div>

      <div class="row d-flex justify-content-center">
        <form action="" method="post">
          <div class=" text-center">
            <button type="submit" name="continue" class="btn btn-block btn-dark" style="background-color: white; color: #4A97FF; border : none;">Continue</button>
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