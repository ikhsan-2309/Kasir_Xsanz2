<div class="top-bar">
  <!-- BEGIN: Breadcrumb -->
  <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Kasir - <?= $halaman ?></a></div>
  <!-- END: Breadcrumb -->
  <!-- BEGIN: Account Menu -->
  <div class="intro-x dropdown w-8 h-8 relative">
    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
      <img alt="Midone Tailwind HTML Admin Template" src="dist/images/profile-12.jpg">
    </div>
    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
      <div class="dropdown-box__content box bg-theme-38 text-white">
        <div class="p-4 border-b border-theme-40">
          <div class="font-medium"><?= $_SESSION['username']; ?></div>
        </div>
        <div class="p-2 border-t border-theme-40">
          <a href="logout.php" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Account Menu -->
</div>