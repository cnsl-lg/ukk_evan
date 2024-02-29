<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_pelanggan = $_POST['id_pelanggan'];
$penjualan_id = $_POST['penjualan_id'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO detailpenjualan VALUES('', '$penjualan_id', '', '', '')");

// redirect ke halaman data barang
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");