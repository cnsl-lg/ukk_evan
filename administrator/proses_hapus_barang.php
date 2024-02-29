<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_produk = $_POST['id_produk'];

// menginput data ke database
mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");

// redirect ke halaman data barang
header('location:data_barang.php?pesan=hapus');