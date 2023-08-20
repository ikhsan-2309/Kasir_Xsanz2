<?php
$halaman = "index";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="LEFT4CODE">
  <title>Kasir - Dashboard</title>
  <!-- BEGIN: CSS Assets-->
  <?php require_once 'layout/css.php' ?> 
  <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">
  <div class="flex">
    <!-- BEGIN: Side Menu -->
    <?php require_once 'layout/sidebar.php' ?> 
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
      <!-- BEGIN: Top Bar -->
      <?php require_once 'layout/topbar.php' ?> 
      <!-- END: Top Bar -->
      <div class="mt-5"> <a href="">Welcome to Kasir</a> </div>
    </div>
    <!-- END: Content -->
  </div>
  <!-- BEGIN: JS Assets-->
  <?php require_once 'layout/js.php' ?> 
  <!-- END: JS Assets-->
</body>

</html>