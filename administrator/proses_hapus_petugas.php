<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_petugas = $_POST['id_petugas'];

// menginput data ke database
mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");

// redirect ke halaman data barang
header('location:data_pengguna.php?pesan=hapus');