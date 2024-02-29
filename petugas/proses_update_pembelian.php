<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$nomor_telepon = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];

// menginput data ke database
mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', nomor_telepon='$nomor_telepon', alamat='$alamat' WHERE id_pelanggan='$id_pelanggan'");

// redirect ke halaman data barang
header('location:pembelian.php?pesan=update');