<?php
// mengaktifkan session
session_start();

// menghubungkan php dengan koneksi databse
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);

// menyeleksi data user dengan username dan pasword yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang dikirim
$cek = mysqli_num_rows($login);

// cek apakah username dan pasword di temukan pada database
if ($cek > 0) {
  $data = mysqli_fetch_assoc($login);

  // cek jika user login sebagai admin
  if ($data['level'] == '1') {
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = '1';
    // alihkan ke halaman dashboard admin
    header('location:administrator/index.php');
  } elseif ($data['level'] == '2') {
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = '2';
    // alihkan ke halaman dashboard admin
    header('location:petugas/index.php');
  } else {
    // alihkan ke halaman login
    header('location:index.php?pesan=gagal');
  }
} else {
  header('location:index.php?pesan=gagal');
}
