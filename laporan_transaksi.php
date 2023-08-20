<?php
require_once '_koneksi.php';
$halaman = "LaporanTransaksi";
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
  <title>Kasir - Transaksi</title>
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
      <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
          <h2 class="text-lg font-medium truncate mr-5 mb-10">Laporan Transaksi</h2>
          <div class="flex items-center sm:ml-auto mb-5 sm:mt-0">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button w-24 rounded-full shadow-md mr-2 ml-3 mb-2 bg-theme-1 text-white">+ Tambah Transaksi</a> </div>
            <div class="modal" id="header-footer-modal-preview">
              <div class="modal__content">
                <div class="flex items-center mr-5 px-5 py-5 sm:py-3 border-b border-gray-200">
                  <h2 class="font-medium text-base mr-auto">Transaksi</h2>
                </div>
                <form action="auth_model.php" method="post">
                  <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                      <label>Nama Barang</label>
                      <select name="nama_produk" class="input w-full border mt-2 js-example-basic-multiple" required>
                        <?php
                        $query = "select * from produk";
                        $ambilproduk = mysqli_query($conn, $query);
                        while ($fetcharray = mysqli_fetch_array($ambilproduk)) {
                          $nama_produk = $fetcharray['nama_produk'];
                          $id_produk = $fetcharray['id_produk'];
                        ?>
                          <option value="<?= $id_produk; ?>"><?= $nama_produk; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Jumlah</label>
                      <input name="jumlah" type="number" class="input w-full border mt-2 flex-1" placeholder="Jumlah" required>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Total Bayar</label>
                      <input name="bayar" type="number" class="input w-full border mt-2 flex-1" placeholder="Total Bayar" required>
                    </div>
                  </div>
                  <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button name="transaksi" type="submit" class="button w-20 bg-theme-1 text-white">Transaksi</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible sm:mt-0">
          <table class="table table-report" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>ID laporan</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ambildatastock = mysqli_query($conn, "select * from laporan inner join produk on laporan.id_produk=produk.id_produk order by tanggal DESC");
              $i = 1;
              while ($data = mysqli_fetch_array($ambildatastock)) {
                $total = $data['total'];
                $nama_produk = $data['nama_produk'];
                $id_produk = $data['id_produk'];
                $id_laporan = $data['id_laporan'];
                $jumlah = $data['jumlah'];
                $tanggal = $data['tanggal'];
              ?>
                <tr class="intro-x">
                  <td><?= $i++ ?></td>
                  <td><?= $id_laporan ?></td>
                  <td><?= $id_produk ?></td>
                  <td><?= $nama_produk ?></td>
                  <td><?= $jumlah ?></td>
                  <td>Rp. <?= number_format($total)  ?></td>
                  <td><?= $tanggal ?></td>
                </tr>
              <?php
              };
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- END: Content -->
  </div>
  <!-- BEGIN: JS Assets-->
  <?php require_once 'layout/js.php' ?>
  <!-- END: JS Assets-->
</body>

</html>