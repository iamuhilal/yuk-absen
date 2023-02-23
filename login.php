<?php
session_start();

if (isset($_SESSION["login"])) {
  header("Location: user/dashboard.php");
  exit;
}

require 'configDB.php';
include 'function.php';
cekstatus();

if (isset($_POST["signup"])) {

  $nilaikos = 0;

  $usernamesign = strtolower(stripslashes($_POST["usernamesign"]));
  $namasign = $_POST["nama"];
  $email = $_POST["email"];
  $passwordsign = mysqli_real_escape_string(connDB(), $_POST["passwordsign"]);
  $passwordsign2 = mysqli_real_escape_string(connDB(), $_POST["passwordsign2"]);

  //var_dump($nilaikos);
  // var_dump($passwordsign2);
  if ($usernamesign == NULL) {
    $userkos = true;
    $nilaikos = 1;
  }if ($namasign == NULL) {
    $namakos = true;
    $nilaikos = 1;
  }if ($email == NULL) {
    $emailkos = true;
    $nilaikos = 1;
  }if ($passwordsign == NULL) {
    $passkos = true;
    $nilaikos = 1;
  }if ($nilaikos == 1) {
    //jika nilaikos = 1, halaman akan menampilkan eror
  }else {
    //cek confirmasi password
    if ($passwordsign !== $passwordsign2) {
      $errorpass = true;
      //jika password tidak sesuai dengan confirm passwor, halaman akan menampilkan eror
    }else {
      $hslcek = 0;
      $cekUsername = "SELECT username FROM tb_user WHERE username = '$usernamesign'";
      $hslcekusrm = mysqli_query(connDB(), $cekUsername);

      $cekEmail = "SELECT email_user FROM tb_user WHERE email_user = '$email'";
      $hslcekemail = mysqli_query(connDB(), $cekEmail);

      if (mysqli_fetch_assoc($hslcekusrm)) {
        $errorusrnm = true;
        $hslcek = 1;
      }if (mysqli_fetch_assoc($hslcekemail)) {
        $erroremail = true;
        $hslcek = 1;
      }
      if ($hslcek == 0) {
        $passwordsign = password_hash($passwordsign, PASSWORD_DEFAULT);

        $querySign = "INSERT INTO tb_user (`username`, `nama_user`, `email_user`, `pass_user`) VALUES( '$usernamesign', '$namasign', '$email', '$passwordsign')";

        mysqli_query(connDB(), $querySign);
        echo "<script>
        alert('user telah dibuat !');
        </script>";
      }else {
      }
    }
  }
} else {
  echo mysqli_error(connDB());
}


// ---------------------------LOGIN------------------------------
if(isset($_POST["login"])){

  $usernamelog = $_POST["usernamelog"];
  $passwordlog = $_POST["passwordlog"];

  $queryView = "SELECT * FROM tb_user WHERE username = '$usernamelog'";

  $result = mysqli_query(connDB(), $queryView);

  //$try = mysqli_fetch_assoc($result)
  //var_dump($try);


  // cek Username
  if (mysqli_num_rows($result) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($result);
    //var_dump($row["pass_user"]);
    if(password_verify($passwordlog, $row["pass_user"])){
    // if ($passwordlog == $row["pass_user"]) {
      $_SESSION["login"] = true;
      $_SESSION["iduser"] = $row["id_user"];
      $_SESSION["user"] = $row["nama_user"];

      header("Location: user/dashboard.php");
      exit;
    }else {
      $error = true;
    }
  }else {
    $errornodaftar = true;

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

    <title>SignUp/Login</title>
  </head>
  <body>


    <div class="container mt-5">
      <div class="row">
        <div class="col mr-5">
          <!-- SIGNUP -->
          <h2 class="text-center">SIGN UP</h2>

          <?php if (isset($errorusrnm)) : ?>
            <p style="color: red; font-style: italic">username already exists</p>
          <?php endif; ?>

          <?php if (isset($userkos)) : ?>
            <p style="color: red; font-style: italic">username empty</p>
          <?php endif; ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="usernamesign">Username</label>
              <input type="text" name="usernamesign" id="usernamesign" class="form-control" placeholder="Input Username">
            </div>

            <?php if (isset($namakos)) : ?>
              <p style="color: red; font-style: italic">name empty</p>
            <?php endif; ?>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Input Nama">
            </div>

            <?php if (isset($erroremail)) : ?>
              <p style="color: red; font-style: italic">email has been registered</p>
            <?php endif; ?>
            <?php if (isset($emailkos)) : ?>
              <p style="color: red; font-style: italic">email empty</p>
            <?php endif; ?>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Input Email">
            </div>

            <?php if (isset($passkos)) : ?>
              <p style="color: red; font-style: italic">password empty</p>
            <?php endif; ?>
            <div class="form-group">
              <label for="passwordsign">Password</label>
              <input type="password" name="passwordsign" id="passwordsign" class="form-control" placeholder="Input Password">
            </div>

            <?php if (isset($errorpass)) : ?>
              <p style="color: red; font-style: italic">password doesn't match</p>
            <?php endif; ?>
            <div class="form-group">
              <label for="passwordsign2">Confirm Password</label>
              <input type="password" name="passwordsign2" id="passwordsign2" class="form-control" placeholder="Input Password">
            </div>

            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
          </form>
        </div>
        <div class="col ml-3">
          <!-- LOGIN -->
          <h2 class="text-center">LOGIN</h2>

          <?php if (isset($errornodaftar)) : ?>
            <p style="color: red; font-style: italic">username belum terdaftar</p>
          <?php endif; ?>
          <?php if (isset($error)) : ?>
            <p style="color: red; font-style: italic">username/password salah</p>
          <?php endif; ?>

          <form action="" method="post">
            <div class="form-group">
              <label for="usernamelog">Username</label>
              <input type="text" name="usernamelog" id="usernamelog" class="form-control" placeholder="Input Username">
            </div>

            <div class="form-group">
              <label for="passwordlog">Password</label>
              <input type="password" name="passwordlog" id="passwordlog" class="form-control" placeholder="Input Password">
            </div>

            <button type="submit" name="login" class="btn btn-primary">Login</button>
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
