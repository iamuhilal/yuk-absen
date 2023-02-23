<?php
session_start();


//koneksi ke database
require '../configDB.php';
include '../function.php';
cekstatus();

$idmaker = $_SESSION["idmaker"];
$user = $_SESSION["user"];

$queryabs = "SELECT * FROM tb_absen WHERE id_maker = $idmaker";
$resultabs = mysqli_query(connDB(), $queryabs);

$querymkr = "SELECT * FROM tb_maker WHERE id_maker = $idmaker";
$resultmkr = mysqli_query(connDB(), $querymkr);
$rowmaker = mysqli_fetch_assoc($resultmkr)

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>List Mahasiswa</title>
  </head>
  <body>

    <!-- container -->
    <div class="">
      <div class="row">

        <!-- main -->
        <main role="main" class="col-md-9 mx-auto col-lg-10 px-4">
          <h3 class="text-center mt-5">List Mahasiswa Yang Telah Absen</h3>
          <hr class="container">
          <div class="container row mx-auto">
            <div class="col">
              <p>Nama Absen </p>
              <p>Keterangan Absen </p>
              <p>Dosen Penanggung Jawab </p>
            </div>
            <div class="col">
              <p>: <?php echo $rowmaker["title_absen"]; ?></p>
              <p>: <?php echo $rowmaker["desc_absen"]; ?></p>
              <p>: <?php echo $user ?></p>
            </div>
          </div>

          <div class="mt-5 container">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">NPM Mahasiswa</th>
                  <th scope="col">Nama Mahasiswa</th>
                </tr>
              </thead>
              <tbody>

              <?php $i = 1; ?>
              <?php while ( $row = mysqli_fetch_assoc($resultabs) ) : ?>
                <tr>
                  <th class="align-middle"><?= $i ?></th>
                  <td class="align-middle"><?php echo $row["npm_mhs"]; ?></td>
                  <td class="align-middle"><?php echo $row["nama_mhs"]; ?></td>


                <?php $i++; ?>
              <?php endwhile; ?>
              </tbody>
            </table>
            <div class="d-grid gap-2">
              <a href="list.php"><button class="btn btn-primary" type="button">Back</button></a>

            </div>
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
