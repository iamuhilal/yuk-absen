<?php
$conn = mysqli_connect("localhost", "root", "", "yuk-absen");

function timebanding($time){
  $inpdate = date('Y-m-d', strtotime($time));
  $inptime = date('H:i', strtotime($time));
  // echo $inpdate . ' OK ' . $inptime;

  date_default_timezone_set("Asia/Jakarta");
  $curdate = date("Y-m-d");
  $curtime = date("H:i");
  // echo $curdate . ' Dan ' . $curtime;
  if ($inpdate = $curdate) {
    if ($inptime >= $curtime) {
      $can = true;
    }else {
      $can = false;
    }
  }if ($inpdate >= $curdate) {
    $can = true;
  }else {
    $can = false;
  }

  return $can;
}

function genkey($l=9){
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l);
}

function cekstatus(){
  global $conn;

  // Menghitung jumlah semua colom
  $jml = "SELECT COUNT(id_maker) AS total FROM tb_maker";
  $resjml = mysqli_query($conn, $jml);
  $value = mysqli_fetch_assoc($resjml);
  $num_row = $value['total'];
  // echo $num_row;

  // $stat = true;
  // $query = "SELECT * FROM tb_maker WHERE status = $stat";
  // $result = mysqli_query(connDB(), $query);
  //
  for ($i = 1; $i <= $num_row; $i++) {
    $hslcek = 0;
    $cekAbsen = "SELECT * FROM tb_maker WHERE id_maker = '$i'";
    $hslcekabs = mysqli_query($conn, $cekAbsen);

    if (mysqli_num_rows($hslcekabs) === 1) { //kalau ada maka memasuki if state
      $row = mysqli_fetch_assoc($hslcekabs);
      $stats = $row["status"];
      if ($stats == true) {
        $thetime = $row["time_end"];
        $newtime = timebanding($thetime);
        if ($newtime == false) {
          $querySign = "UPDATE tb_maker SET status = '$newtime' WHERE id_maker = $i";
          mysqli_query($conn, $querySign);
          echo "done";
        }
      }
    }
  }

  // $queryView = "SELECT * FROM tb_user WHERE username = '$usernamelog'";
  //
  // $result = mysqli_query(connDB(), $queryView);

  //$try = mysqli_fetch_assoc($result)
  //var_dump($try);




}
