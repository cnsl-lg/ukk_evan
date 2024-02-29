<?php
// koneksi databse
include '../koneksi.php';

// menangkap data dari form
$id_detail = $_POST['id_detail'];
$id_pelanggan = $_POST['id_pelanggan'];

// menginput data ke database
mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE id_detail='$id_detail'");

// redirect ke halaman data barang
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");