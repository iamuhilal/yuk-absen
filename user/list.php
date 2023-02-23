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

$query = "SELECT * FROM tb_maker WHERE id_user = $iduser";
$result = mysqli_query(connDB(), $query);

// DELETE
if (isset($_POST["delete"])) {
  $id_maker = $_POST["idmake"];
  $querydel = "DELETE FROM tb_maker WHERE id_maker=$id_maker";
  mysqli_query($conn, $querydel);

  // MAKE AUTO RELOAD AFTER INPUT
  $page = $_SERVER['PHP_SELF'];
  $sec = "0";
  header("Refresh: $sec; url=$page");
}

// DETAILS
if (isset($_POST["details"])) {
  $_SESSION["idmaker"] = $_POST["idmake"];
  header("Location: listmhs.php");
  exit;
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
    <a class="navbar-brand col-sm-7 col-md-2 mr-0" href="#">Hai <?php echo $_SESSION["user"]; ?></a>
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
              <a class="nav-link" href="dashboard.php">Make</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold" href="#">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- main -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h3 class="text-center">List Absen</h3>
        <hr>

        <div class="mt-5 container">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Absen Key</th>
                <th scope="col">Deadline</th>
                <th scope="col">Status</th>
                <th scope="col">Total Student</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <th class="align-middle"><?= $i ?></th>
                  <td class="align-middle"><?php echo $row["title_absen"]; ?></td>
                  <td class="align-middle"><?php echo $row["desc_absen"]; ?></td>
                  <td class="align-middle"><?php echo $row["absenkey"]; ?></td>
                  <td class="align-middle"><?php echo $row["time_end"]; ?></td>
                  <td class="align-middle"><?php if ($row["status"] == 1) {
                                              echo "On Proses";
                                            } else {
                                              echo "Selesai";
                                            } ?></td>
                  <?php $idmaker = $row["id_maker"];
                  $jml = "SELECT COUNT(id_absen) AS total FROM tb_absen WHERE id_maker = $idmaker";
                  $resjml = mysqli_query($conn, $jml);
                  $value = mysqli_fetch_assoc($resjml);
                  $num_row = $value['total']; ?>
                  <td class="align-middle"><?php echo $num_row ?></td>
                  <form action="" method="post">
                    <input type="hidden" id="custId" name="idmake" value="<?php echo $row["id_maker"]; ?>">
                    <td class="align-middle"><button type="submit" name="details" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-sm">Details</button></td>
                    <td class="align-middle"><button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button></td>
                  </form>


                  <?php $i++; ?>
                <?php endwhile; ?>
            </tbody>
          </table>
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