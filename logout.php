<?php
// mengaktifkan session
session_start();

// menghapus semua sesion
session_destroy();

// redirect ke halaman login
header('location:index.php');