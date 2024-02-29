<?php
session_start();

if (isset($_SESSION['username'])) {
  header('location:administrator/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./bootstrap-5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="content">
      <div class="card mt-5">
        <div class="row">
          <div class="col-md-6">
            <div class="card-body">
              <p class="text-center mt-5">Silahkan masukkan username dan password</p>
              <?php
              if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == 'gagal') {
                  echo "<div class='alert alert-danger'> username dan password tidak sesuai</div>";
                }
              }
              ?>
              <form action="cek_login.php" method="post">
                <div class="form-group mt-3">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group mt-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group mt-3">
                  <button type="submit" class="btn btn-primary form-control">login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <img src="login.png" alt="login" width="500">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./bootstrap-5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="./bootstrap-5.3.2/js/dist/popover.js"></script>
</body>
</html>