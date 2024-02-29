<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO produk VALUES('', '$nama_produk', '$harga', '$stok')");

// redirect ke halaman data barang
header('location:data_barang.php?pesan=simpan');