<?php
require_once '_koneksi.php';
$halaman = "Produk";
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
  <title>Kasir - Produk</title>
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
          <h2 class="text-lg font-medium truncate mr-5 mb-10">Produk</h2>
          <div class="flex items-center sm:ml-auto mb-5 sm:mt-0">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button w-24 rounded-full shadow-md mr-2 ml-3 mb-2 bg-theme-1 text-white">+ Tambah Produk</a> </div>
            <div class="modal" id="header-footer-modal-preview">
              <div class="modal__content">
                <div class="flex items-center mr-5 px-5 py-5 sm:py-3 border-b border-gray-200">
                  <h2 class="font-medium text-base mr-auto">Menambahkan Produk</h2>
                </div>
                <form action="auth_model.php" method="post">
                  <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                      <label>Nama Produk</label>
                      <input name="nama_produk" type="text" class="input w-full border mt-2 flex-1" placeholder="Nama Produk" required>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Harga</label>
                      <input name="harga" type="text" class="angka input w-full border mt-2 flex-1" placeholder="Harga" required>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Stock</label>
                      <input name="stock" type="number" class="input w-full border mt-2 flex-1" placeholder="Stock" required>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Deskripsi</label>
                      <input name="deskripsi" type="text" class="input w-full border mt-2 flex-1" placeholder="Deskripsi" required>
                    </div>
                  </div>
                  <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button name="simpan_produk" type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible sm:mt-0">
          <table class="table table-report">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stock</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ambildatastock = mysqli_query($conn, "select * from produk");
              $i = 1;
              while ($data = mysqli_fetch_array($ambildatastock)) {
                $nama_produk = $data['nama_produk'];
                $harga = $data['harga'];
                $deskripsi = $data['deskripsi'];
                $stock = $data['stock'];
                $id_produk = $data['id_produk'];
              ?>
                <tr class="intro-x">
                  <td><?= $i++ ?></td>
                  <td><?= $nama_produk ?></td>
                  <td>Rp. <?= number_format($harga) ?></td>
                  <td><?= $deskripsi ?></td>
                  <td><?= $stock ?></td>
                  <td class="table-report__action w-56">
                    <div class="flex">
                      <div class="text-center">
                        <a href="javascript:;" data-toggle="modal" data-target="#edit<?= $id_produk; ?>" class="button w-24 rounded-full mr-1 bg-theme-14 text-theme-10">Edit</a>
                      </div>
                      <div class="text-center">
                        <a href="javascript:;" data-toggle="modal" data-target="#delete<?= $id_produk; ?>" class="button w-24 rounded-full mr-1 mb-2 bg-theme-31 text-theme-6">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <div class="modal" id="edit<?= $id_produk; ?>">
                  <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                      <h2 class="font-medium text-base mr-auto">Mengedit Produk</h2>
                    </div>
                    <form method="post" action="auth_model.php">
                      <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12 sm:col-span-12">
                          <label>Nama Barang</label>
                          <input value="<?= $nama_produk; ?>" name="nama_produk" type="text" class="input w-full border mt-2 flex-1" required>
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                          <label>Harga</label>
                          <input value="<?= number_format($harga) ; ?>" name="harga" type="number" class="angka input w-full border mt-2 flex-1" required>
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                          <label>Stock</label>
                          <input value="<?= $stock; ?>" name="stock" type="number" class="input w-full border mt-2 flex-1" required>
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                          <label>Deskripsi</label>
                          <input value="<?= $deskripsi; ?>" name="deskripsi" type="text" class="input w-full border mt-2 flex-1" required>
                        </div>
                        <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                      </div>
                      <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button name="edit_produk" type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal" id="delete<?= $id_produk; ?>">
                  <div class="modal__content">
                    <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                      <div class="text-3xl mt-5">Apakah anda yakin?</div>
                      <div class="text-gray-600 mt-2">Anda akan menghapus Produk ini dari</div>
                    </div>
                    <form action="auth_model.php" method="post">
                      <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                      <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                        <button name="hapus_produk" type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                      </div>
                    </form>
                  </div>
                </div>

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