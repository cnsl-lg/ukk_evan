<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$stok = $_POST['stok'];
$id_produk = $_POST['id_produk'];
$jumlah_produk = $_POST['jumlah_produk'];
$harga = $_POST['harga'];
$id_detail = $_POST['id_detail'];
$id_pelanggan = $_POST['id_pelanggan'];
$subtotal = $jumlah_produk * $harga;
$stok_total = $stok - $jumlah_produk;

// menginput data ke database
mysqli_query($koneksi, "UPDATE detailpenjualan SET subtotal='$subtotal', jumlah_produk='$jumlah_produk' WHERE id_detail='$id_detail'");
mysqli_query($koneksi, "UPDATE produk SET stok='$stok_total' WHERE id_produk='$id_produk'");

// redirect ke halaman data barang
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");