<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: index.php");
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
  <title>Inventory - Login</title>
  <!-- BEGIN: CSS Assets-->
  <?php require_once 'layout/css.php' ?>
  <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
  <div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
      <!-- BEGIN: Login Info -->
      <div class="hidden xl:flex flex-col min-h-screen">
        <a href="" class="-intro-x flex items-center pt-5">
          <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
          <span class="text-white text-lg ml-3"> Inven<span class="font-medium">tory</span> </span>
        </a>
        <div class="my-auto">
          <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
          <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
            Welcome to
            <br>
            Web Inventory
          </div>
          <div class="-intro-x mt-5 text-lg text-white">Memudahkan Pengurusan Barang Anda</div>
        </div>
      </div>
      <!-- END: Login Info -->
      <!-- BEGIN: Login Form -->
      <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
          <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Sign In
          </h2>
          <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
          <form action="login_model.php" method="post">
            <div class="intro-x mt-8">
              <input name="username" type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Username">
              <input name="password" type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
              <button name="login" type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
            </div>
          </form>
        </div>
      </div>
      <!-- END: Login Form -->
    </div>
  </div>
  <!-- BEGIN: JS Assets-->
  <?php require_once 'layout/js.php' ?>
  <!-- END: JS Assets-->
</body>

</html>