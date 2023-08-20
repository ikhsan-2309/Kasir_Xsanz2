<?php
require_once('_koneksi.php');
session_start();

// get_transaction_details.php
// Koneksi ke database dan inisialisasi session jika diperlukan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    // Lakukan query untuk mendapatkan detail transaksi berdasarkan ID transaksi
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi");
    // Di sini, pastikan untuk menggunakan parameterized queries untuk keamanan.
    
    if ($query) {
      $data = mysqli_fetch_assoc($query);
      // Ambil data dari hasil query dan masukkan ke dalam variabel
      $total_harga = $data['total_harga'];
      $kembalian = $data['kembalian'];
      $tanggal = $data['tanggal'];

      // Kemudian, kembalikan data transaksi dalam bentuk JSON
      $response = [
        'id_transaksi' => $id_transaksi,
        'total_harga' => $total_harga,
        'kembalian' => $kembalian,
        'tanggal' => $tanggal,
      ];

      echo json_encode($response);
      exit();
    } else {
      // Jika query gagal, berikan respon error
      $response = [
        'error' => 'Failed to fetch transaction details.'
      ];

      echo json_encode($response);
      exit();
    }
  }
}
?>
