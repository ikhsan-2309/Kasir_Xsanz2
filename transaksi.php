<?php
require_once '_koneksi.php';
$halaman = "Transaksi";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}
if (isset($_POST['transaksi'])) {
  // Di sini, Anda perlu mengambil data dari tabel transaksi dan memasukkannya ke dalam tabel laporan.
  $total_bayar = $_POST['total_bayar'];
  // Langkah 1: Ambil data dari tabel transaksi
  $getbrg = mysqli_query($conn, "SELECT * FROM transaksi");

  // Langkah 2: Loop melalui setiap data transaksi dan masukkan ke dalam tabel laporan
  while ($plh_brg = mysqli_fetch_array($getbrg)) {
    $id_produk = $plh_brg['id_produk'];
    $jumlah = $plh_brg['jumlah'];
    $total = $plh_brg['total'];

    $hitung1 = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stoksekarang = $hitung2['stock'];

    $kembalian = $total_bayar - $total;
    if ($total_bayar >= $total) {
      $selisih = $stoksekarang - $jumlah;
      $insert_query = "INSERT INTO laporan (id_produk, jumlah, total) VALUES ('$id_produk', '$jumlah', '$total')";
      $query_update = "UPDATE produk SET stock='$selisih' WHERE id_produk='$id_produk'";
      // Langkah 4: Jalankan query untuk memasukkan data ke dalam tabel laporan
      $insert_result = mysqli_query($conn, $insert_query);
      $update_result = mysqli_query($conn, $query_update);
      if ($insert_result && $update_result) {
        echo "<script> alert('Barang Pesanan Berhasil DiEdit'); window.location.href='transaksi.php';</script>";
      } else {
        echo "<script> alert('Gagal Mengedit barang pesanan'); window.location.href='transaksi.php';</script>";
      }
      // Langkah 3: Masukkan data ke dalam tabel laporan (contoh query)
    } else
      echo "<script> alert('Transaksi Gagal'); </script>";
    echo "<script> window.location.href = 'transaksi.php'; </script>";
  }
}
if (isset($_POST['hapus_transaksi'])) {
  $hapus = mysqli_query($conn, "delete from transaksi");
  if ($hapus) {
    echo "<script> alert('produk Berhasil di Hapus'); </script>";
    echo "<script> window.location.href = 'transaksi.php'; </script>";
  } else
    echo "<script> alert('produk Gagal di Hapus'); </script>";
  echo "<script> window.location.href = 'transaksi.php'; </script>";
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
          <h2 class="text-lg font-medium truncate mr-5 mb-10">Transaksi</h2>
          <div class="flex items-center sm:ml-auto mb-5 sm:mt-0">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button w-24 rounded-full shadow-md mr-2 ml-3 mb-2 bg-theme-1 text-white">+ Tambah Produk</a> </div>
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
                        $getbrg = mysqli_query($conn, "SELECT * FROM produk");
                        while ($plh_brg = mysqli_fetch_array($getbrg)) {
                          $id_produk = $plh_brg['id_produk'];
                          $nama_produk = $plh_brg['nama_produk'];
                          $stock = $plh_brg['stock'];
                          $deskripsi = $plh_brg['deskripsi'];
                        ?>
                          <option value="<?= $id_produk; ?>">
                            <?= $nama_produk; ?> - <?= $deskripsi; ?> ( stock: <?= $stock; ?> )
                          </option>

                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                      <label>Jumlah</label>
                      <input name="jumlah" type="number" class="input w-full border mt-2 flex-1" placeholder="Jumlah" required>
                    </div>
                  </div>
                  <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="submit" class="button w-20 mr-3 bg-theme-6 text-white" data-dismiss="modal">Batal</button>
                    <button name="add_produk_transaksi" type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="intro-y overflow-auto lg:overflow-visible sm:mt-0">
        <table class="table table-report" id="example1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total_harga = 0;
            $kembalian = 0;
            $getbrg = mysqli_query($conn, "SELECT * FROM transaksi inner join produk on transaksi.id_produk=produk.id_produk");
            $i = 1;
            while ($plh_brg = mysqli_fetch_array($getbrg)) {
              $id_transaksi = $plh_brg['id_transaksi'];
              $id_produk = $plh_brg['id_produk'];
              $nama_produk = $plh_brg['nama_produk'];
              $harga = $plh_brg['harga'];
              $jumlah = $plh_brg['jumlah'];
              $subtotal = $plh_brg['total'];
              $total_harga += $subtotal;
            ?>
              <tr class="intro-x">
                <td><?= $i++ ?></td>
                <td><?= $nama_produk; ?></td>
                <td>Rp. <?= number_format($harga); ?></td>
                <td><?= $jumlah; ?></td>
                <td>Rp. <?= number_format($subtotal); ?></td>
                <td class="table-report__action w-56">
                  <div class="flex">
                    <div class="text-center">
                      <a href="javascript:;" data-toggle="modal" data-target="#edit<?= $id_transaksi; ?>" class="button w-24 rounded-full mr-1 bg-theme-14 text-theme-10">Edit</a>
                    </div>
                    <div class="text-center">
                      <a href="javascript:;" data-toggle="modal" data-target="#delete<?= $id_transaksi; ?>" class="button w-24 rounded-full mr-1 mb-2 bg-theme-31 text-theme-6">Delete</a>
                    </div>
                  </div>
                </td>
                <div class="modal" id="edit<?= $id_transaksi; ?>">
                  <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                      <h2 class="font-medium text-base mr-auto">Mengedit Produk</h2>
                    </div>
                    <form method="post" action="auth_model.php">
                      <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12 sm:col-span-12">
                          <label>Jumlah</label>
                          <input value="<?= $jumlah; ?>" name="jumlah" type="number" class="input w-full border mt-2 flex-1" required>
                        </div>
                        <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                      </div>
                      <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button name="edit_produk_transaksi" type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal" id="delete<?= $id_transaksi; ?>">
                  <div class="modal__content">
                    <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                      <div class="text-3xl mt-5">Apakah anda yakin?</div>
                      <div class="text-gray-600 mt-2">Anda akan menghapus Produk ini dari</div>
                    </div>
                    <form action="auth_model.php" method="post">
                      <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                      <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                        <button name="hapus_produk_transaksi" type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                      </div>
                    </form>
                  </div>
                </div>
              </tr>

            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12" data-select2-id="11">
          <!-- BEGIN: Form Layout -->
          <div class="intro-y box p-5" data-select2-id="10">
            <form action="transaksi.php" method="post">
              <div class="mt-3">
                <div>
                  <label>Total Harga</label>
                  <input type="text" readonly class="input w-full border mt-2" value="Rp. <?=  number_format($total_harga) ; ?>">
                </div>
                <div class="mt-3">
                  <label>Total Bayar</label>
                  <input id="angka" name="total_bayar" type="text" class="angka input w-full border mt-2" placeholder="Rp. 0" oninput="formatAngka(this)" >
                </div>
                <div class="mt-3">
                  <label>Kembalian</label>
                  <input type="text" readonly class="input w-full border mt-2" value="Rp. <?= $kembalian; ?>">
                </div>
                <div class="text-right mt-5">
                  <button name="hapus_transaksi" type="submit" class="button w-24 border bg-theme-6 text-white mr-1">Reset</button>
                  <button id="bayar" name="transaksi" type="submit" type="button" class="button w-24 border bg-theme-1 text-white mr-1">Bayar</button>
                  <button type="button" class="button w-24 bg-theme-9 text-white">Cetak</button>
                </div>
              </div>
            </form>
            <!-- END: Form Layout -->
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