<?php
require_once('_koneksi.php');
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * from admin where username='$username'";
  $hasil = mysqli_query($conn, $query);
  $login = mysqli_fetch_array($hasil);
  if($login==NULL){
    echo"
    <script> 
      alert('Username Tidak Ditemukan');
      window.location.replace('login.php');
    </script>";
  }else if ($password<>$login['password']) {
    echo"
    <script> 
      alert('Password Salah');
      window.location.replace('login.php');
    </script>";
  }else {
    session_start();
    $_SESSION['username'] = $login['username'];
    header("Location: index.php");
  }
} else {
  header("Location: login.php");
}