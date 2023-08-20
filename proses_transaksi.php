<?php
// proses_transaksi.php
require_once '_koneksi.php';

if (isset($_POST['total_bayar'])) {
  $total_bayar = $_POST['total_bayar'];
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
  // Mengirim respons dalam format JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
