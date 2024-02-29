<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$nomor_telepon = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];
$tanggal_penjualan = $_POST['tanggal_penjualan'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO pelanggan VALUES('$id_pelanggan', '$nama_pelanggan', '$alamat', '$nomor_telepon')");
mysqli_query($koneksi, "INSERT INTO penjualan VALUES('', '$tanggal_penjualan', '', '$id_pelanggan')");

// redirect ke halaman data barang
header('location:pembelian.php?pesan=simpan');