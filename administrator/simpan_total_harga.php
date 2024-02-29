<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$total_harga = $_POST['total_harga'];
$penjualan_id = $_POST['penjualan_id'];
$id_pelanggan = $_POST['id_pelanggan'];

// menginput data ke database
mysqli_query($koneksi, "UPDATE penjualan SET total_harga='$total_harga' WHERE penjualan_id='$penjualan_id'");

// redirect ke halaman data barang
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan&pesan=simpan");