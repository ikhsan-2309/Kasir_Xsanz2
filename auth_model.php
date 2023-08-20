<?php
require_once('_koneksi.php');
session_start();

if (isset($_POST['simpan_produk'])) {
  $nama_produk  = $_POST['nama_produk'];
  $deskripsi  = $_POST['deskripsi'];
  $stock = $_POST['stock'];
  $harga = $_POST['harga'];
  $query = "INSERT INTO produk VALUES('','$nama_produk','$harga','$deskripsi','$stock')";
  mysqli_query($conn, $query);
  echo "<script> alert('Produk Berhasil di Tambahkan'); </script>";
  echo "<script> window.location.href = 'produk.php'; </script>";
}

if (isset($_POST['edit_produk'])) {
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $harga = $_POST['harga'];
  $stock = $_POST['stock'];
  $deskripsi = $_POST['deskripsi'];

  $update = mysqli_query($conn, "update produk set nama_produk='$nama_produk', harga='$harga',  deskripsi='$deskripsi', stock = '$stock' where id_produk = $id_produk");
  if ($update) {
    echo "<script> alert('Produk Berhasil di Edit'); </script>";
    echo "<script> window.location.href = 'produk.php'; </script>";
  } else
    echo "<script> alert('Barang Gagal di Edit'); </script>";
  echo "<script> window.location.href = 'produk.php'; </script>";
}

if (isset($_POST['hapus_produk'])) {
  $id_produk = $_POST['id_produk'];

  $hapus = mysqli_query($conn, "delete from produk where id_produk='$id_produk'");
  if ($hapus) {
    echo "<script> alert('produk Berhasil di Hapus'); </script>";
    echo "<script> window.location.href = 'produk.php'; </script>";
  } else
    echo "<script> alert('produk Gagal di Hapus'); </script>";
  echo "<script> window.location.href = 'produk.php'; </script>";
}

if (isset($_POST['add_produk_transaksi'])) {
  $jumlah = $_POST['jumlah'];
  $id_produk = $_POST['nama_produk'];

  //hitung stok sekarang
  $hitung1 = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
  $hitung2 = mysqli_fetch_array($hitung1);
  $stoksekarang = $hitung2['stock'];
  $harga = $hitung2['harga'];
  $total_harga = $jumlah * $harga;

  if ($stoksekarang >= $jumlah) {
    // pengurangan stok
    $selisih = $stoksekarang - $jumlah;
    // stok cukup
    $query_insert = "INSERT INTO transaksi (id_produk, jumlah, total) VALUES ('$id_produk', '$jumlah' , '$total_harga')";

    // Eksekusi query insert dan update
    $insert_result = mysqli_query($conn, $query_insert);

    if ($insert_result) {
      echo "<script> alert('Barang Pesanan Berhasil Ditambahkan'); window.location.href='transaksi.php';</script>";
    } else {
      echo "<script> alert('Gagal menambah barang pesanan'); window.location.href='transaksi.php';</script>";
    }
  } else {
    // stok tidak cukup
    echo "<script> alert('Stok tidak mencukupi'); window.location.href='transaksi.php';</script>";
  }
}
if (isset($_POST['edit_produk_transaksi'])) {
  $id_transaksi = $_POST['id_transaksi'];
  $id_produk = $_POST['id_produk'];
  $jumlah = $_POST['jumlah'];

  $hitung1 = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
  $hitung2 = mysqli_fetch_array($hitung1);
  $stoksekarang = $hitung2['stock'];
  $harga = $hitung2['harga'];
  $total = $harga * $jumlah;

  if ($stoksekarang >= $jumlah) {
    // pengurangan stok
    $selisih = $stoksekarang - $jumlah;
    // stok cukup
    $query_update_transaksi = "update transaksi set jumlah='$jumlah', total='$total' where id_transaksi = $id_transaksi";

    // Eksekusi query insert dan update
    $insert_result = mysqli_query($conn, $query_update_transaksi);

    if ($insert_result) {
      echo "<script> alert('Barang Pesanan Berhasil DiEdit'); window.location.href='transaksi.php';</script>";
    } else {
      echo "<script> alert('Gagal Mengedit barang pesanan'); window.location.href='transaksi.php';</script>";
    }
  } else {
    // stok tidak cukup
    echo "<script> alert('Stok tidak mencukupi'); window.location.href='transaksi.php';</script>";
  }
}

if (isset($_POST['hapus_produk_transaksi'])) {
  $id_transaksi = $_POST['id_transaksi'];

  $hapus = mysqli_query($conn, "delete from transaksi where id_transaksi='$id_transaksi'");
  if ($hapus) {
    echo "<script> alert('produk Berhasil di Hapus'); </script>";
    echo "<script> window.location.href = 'transaksi.php'; </script>";
  } else
    echo "<script> alert('produk Gagal di Hapus'); </script>";
  echo "<script> window.location.href = 'transaksi.php'; </script>";
}
