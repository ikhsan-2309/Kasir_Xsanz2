<nav class="side-nav">
  <a href="" class="intro-x flex items-center pl-5 pt-4">
    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
    <span class="hidden xl:block text-white text-lg ml-3"><span class="font-medium">Xsanz Store</span> </span>
  </a>
  <div class="side-nav__devider my-6"></div>
  <?php function active($link, $halaman)
  {
    if ($halaman == $link) {
      return "active";
    }
  } ?>
  <ul>
    <li>
      <a href="index.php" class="side-menu side-menu--<?= active("index", $halaman); ?>">
        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
        <div class="side-menu__title"> Dashboard </div>
      </a>
    </li>
    <li>
      <a href="produk.php" class="side-menu side-menu--<?= active("Produk", $halaman); ?>">
        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
        <div class="side-menu__title"> Produk </div>
      </a>
    </li>
    <li>
      <a href="transaksi.php" class="side-menu side-menu--<?= active("Transaksi", $halaman); ?>">
        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
        <div class="side-menu__title"> Transaksi </div>
      </a>
    </li>
    <li>
      <a href="laporan_transaksi.php" class="side-menu side-menu--<?= active("LaporanTransaksi", $halaman); ?>">
        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
        <div class="side-menu__title"> Laporan Transaksi </div>
      </a>
    </li>
  </ul>
</nav>