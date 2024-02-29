<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_petugas = $_POST['id_petugas'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

// menginput data ke database
if (!$password) {
  mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', level='$level' WHERE id_petugas='$id_petugas'");
} else {
  mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', password='$password', level='$level' WHERE id_petugas='$id_petugas'");
}

// redirect ke halaman data barang
header('location:data_pengguna.php?pesan=update');