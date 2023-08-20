<?php
  $namahost = "127.0.0.1"; 
  $user = "root"; 
  $password ="";
  $database = "kasir_toko";
  $conn = mysqli_connect($namahost, $user, $password, $database);
  if (!$conn) {
    echo "Database tidak terhubung";
  }
?>