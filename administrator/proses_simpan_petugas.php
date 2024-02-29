<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO petugas VALUES('', '$nama_petugas', '$username', '$password', '$level')");

// redirect ke halaman data barang
header('location:data_pengguna.php?pesan=simpan');