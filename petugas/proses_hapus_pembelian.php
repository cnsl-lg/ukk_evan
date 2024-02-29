<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_pelanggan = $_POST['id_pelanggan'];

// menginput data ke database
mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_pelanggan='$id_pelanggan'");

// redirect ke halaman data barang
header('location:pembelian.php?pesan=hapus');