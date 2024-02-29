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
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM produk");
        while ($d = mysqli_fetch_array($data)) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $d['nama_produk'] ?></td>
          <td><?php echo $d['harga'] ?></td>
          <td><?php echo $d['stok'] ?></td>
          <td>
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data-<?php echo $d['id_produk']; ?>">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data-<?php echo $d['id_produk']; ?>">Hapus</button>
          </td>
        </tr>

        <!-- modal edit data -->
        <div class="modal fade" id="edit-data-<?php echo $d['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_update_barang.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="hidden" id="id_produk" name="id_produk" value="<?php echo $d['id_produk']; ?>" class="form-control">
                    <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $d['nama_produk']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="stok">Stok Produk</label>
                    <input type="number" id="stok" name="stok" value="<?php echo $d['stok']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="harga">Harga Produk</label>
                    <input type="number" id="harga" name="harga" value="<?php echo $d['harga']; ?>" class="form-control">
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
        <div class="modal fade" id="hapus-data-<?php echo $d['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_hapus_barang.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <input type="hidden" id="id_produk" name="id_produk" value="<?php echo $d['id_produk']; ?>" class="form-control">
                    Apakah anda yakin ingin menghapus data <?php echo $d['nama_produk']; ?> 
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
      <form action="proses_simpan_barang.php" method="post">
        <div class="modal-body">
          <div class="form-group mt-3">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="stok">Stok Produk</label>
            <input type="number" id="stok" name="stok" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="harga">Harga Produk</label>
            <input type="number" id="harga" name="harga" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>