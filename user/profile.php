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

$iduser = $_SESSION["iduser"];

$query = "SELECT * FROM tb_user WHERE id_user = $iduser";
$result = mysqli_query(connDB(), $query);
$row = mysqli_fetch_assoc($result);


// UPDATE
if (isset($_POST["update"])) {

  $nilaikos = 0;

  $usernamesign = strtolower(stripslashes($_POST["usernamesign"]));
  $namasign = $_POST["nama"];
  $email = $_POST["email"];

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
  }if ($nilaikos == 1) {
    //jika nilaikos = 1, halaman akan menampilkan eror
  }else {
    $hslcek = 0;
    $cekUsername = "SELECT username_user FROM tb_user WHERE username_user = '$usernamesign'";
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

      $querySign = "UPDATE tb_user SET username = '$usernamesign', nama_user='$namasign', email_user='$email' WHERE id_user = $iduser";

      mysqli_query(connDB(), $querySign);
      echo "<script>
      alert('Organizer profile has been Update !');
      </script>";

      // MAKE AUTO RELOAD AFTER INPUT
      $page = $_SERVER['PHP_SELF'];
      $sec = "0";
      header("Refresh: $sec; url=$page");
    }else {
    }
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
                <a class="nav-link" href="dashboard.php">Buat Absen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list.php">List Absen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bold" href="">Profile</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- main -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h3 class="text-center">Update Data Pribadi</h3>
          <hr>

          <div class="mt-5  container">
            <form action="" method="post">
              <div class="form-group mt-4">
                <label for="usernamesign">Username</label>
                <input type="text" name="usernamesign" id="usernamesign" class="form-control mt-2" placeholder="Input Username" value="<?php echo $row['username']; ?>">
              </div>

              <?php if (isset($namakos)) : ?>
                <p style="color: red; font-style: italic">name empty</p>
              <?php endif; ?>
              <div class="form-group mt-4">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control mt-2" placeholder="Input Nama" value="<?php echo $row['nama_user']; ?>">
              </div>

              <?php if (isset($erroremail)) : ?>
                <p style="color: red; font-style: italic">email has been registered</p>
              <?php endif; ?>
              <?php if (isset($emailkos)) : ?>
                <p style="color: red; font-style: italic">email empty</p>
              <?php endif; ?>
              <div class="form-group mt-4">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control mt-2" placeholder="Input Email" value="<?php echo $row['email_user']; ?>">
              </div>

              <button type="submit" name="update" class="btn btn-primary mt-4">Update</button>
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
