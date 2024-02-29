<?php
include 'header.php';
include 'navbar.php';
?>

<div class="card mt">
  <div class="card-body">
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">Tambah Data</button>
  </div>
  <div class="card-body">
    <?php
    if (isset($_GET['pesan'])) :
      if ($_GET['pesan'] == 'simpan') : ?>
        <div class="alert alert-success" role="alert">
          Data berhasil disimpan.
        </div>
        <?php endif ?>
        <?php if ($_GET['pesan'] == 'update') : ?>
          <div class="alert alert-success" role="alert">
            Data berhasil diubah.
          </div>
        <?php endif ?>
        <?php if ($_GET['pesan'] == 'hapus') : ?>
          <div class="alert alert-success" role="alert">
            Data berhasil dihapus.
          </div>
      <?php endif ?>
    <?php endif ?>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Petugas</th>
          <th>Username</th>
          <th>Akses Petugas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM petugas");
        while ($d = mysqli_fetch_array($data)) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $d['nama_petugas'] ?></td>
          <td><?php echo $d['username'] ?></td>
          <td>
            <?php if($d['level'] == '1') { ?>
            Administrator
            <?php } else { ?>
            Petugas
            <?php } ?>
          </td>
          <td>
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data-<?php echo $d['id_petugas']; ?>">Edit</button>
            <?php if($d['level'] == $_SESSION['level']) { ?>
            <?php } else { ?>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data-<?php echo $d['id_petugas']; ?>">Hapus</button>
            <?php } ?>
          </td>
        </tr>

        <!-- modal edit data -->
        <div class="modal fade" id="edit-data-<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_update_petugas.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <label for="nama_petugas">Nama Petugas</label>
                    <input type="hidden" id="id_petugas" name="id_petugas" value="<?php echo $d['id_petugas']; ?>" class="form-control">
                    <input type="text" id="nama_petugas" name="nama_petugas" value="<?php echo $d['nama_petugas']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $d['username']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo $d['password']; ?>" class="form-control">
                    <small class="text-danger text-sm">* Kosongkan jika tidak merubah password</small>
                  </div>
                  <div class="form-group mt-3">
                    <label for="level">Akses Petugas</label>
                    <select name="level" id="level" class="form-control">
                      <option value="">=== Pilih Akses ===</option>
                      <option value="1" <?php if($d['level'] == '1') { echo 'selected'; } ?>>Administrator</option>
                      <option value="2" <?php if($d['level'] == '2') { echo 'selected'; } ?>>Petugas</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <!-- modal hapus data -->
        <div class="modal fade" id="hapus-data-<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_hapus_petugas.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <input type="hidden" id="id_petugas" name="id_petugas" value="<?php echo $d['id_petugas']; ?>" class="form-control">
                    Apakah anda yakin ingin menghapus data <?php echo $d['nama_petugas']; ?> 
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php endwhile ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal tambah data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_simpan_petugas.php" method="post">
        <div class="modal-body">
          <div class="form-group mt-3">
            <label for="nama_petugas">Nama Petugas</label>
            <input type="hidden" id="id_petugas" name="id_petugas" class="form-control">
            <input type="text" id="nama_petugas" name="nama_petugas" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <div class="form-group mt-3">
            <label for="level">Akses Petugas</label>
            <select name="level" id="level" class="form-control">
              <option value="">=== Pilih Akses ===</option>
              <option value="1">Administrator</option>
              <option value="2">Petugas</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>