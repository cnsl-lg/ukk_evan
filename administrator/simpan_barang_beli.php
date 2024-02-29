<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_detail = $_POST['id_detail'];
$id_pelanggan = $_POST['id_pelanggan'];
$id_produk = $_POST['id_produk'];

// menginput data ke database
mysqli_query($koneksi, "UPDATE detailpenjualan SET id_produk='$id_produk' WHERE id_detail='$id_detail'");

// redirect ke halaman data barang
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");