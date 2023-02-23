<?php

function connDB()
{

      $dbServer = 'localhost';
      $dbUser = 'root';
      $dbPass = '';
      $dbName = "yuk-absen";

      $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

      if (!$conn) {
            die('Connection Failled: ' . mysqli_connect_error());
      }

      mysqli_select_db($conn, $dbName);

      return $conn;
}
