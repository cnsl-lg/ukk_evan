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
    <table class="table teble-responsive">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Pelanggan</th>
          <th>Nama Pelanggan</th>
          <th>No. Telepon</th>
          <th>Alamat</th>
          <th>Total Pembayaran</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.id_pelanggan=penjualan.id_pelanggan");
        while ($d = mysqli_fetch_array($data)) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $d['id_pelanggan'] ?></td>
          <td><?php echo $d['nama_pelanggan'] ?></td>
          <td><?php echo $d['nomor_telepon'] ?></td>
          <td><?php echo $d['alamat'] ?></td>
          <td><?php echo $d['total_harga'] ?></td>
          <td>
            <a href="detail_pembelian.php?id_pelanggan=<?php echo $d['id_pelanggan']; ?>" class="btn btn-info btn-sm">Detail</a>
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data-<?php echo $d['id_pelanggan']; ?>">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data-<?php echo $d['id_pelanggan']; ?>">Hapus</button>
          </td>
        </tr>

        <!-- modal edit data -->
        <div class="modal fade" id="edit-data-<?php echo $d['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_update_pembelian.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <input type="text" id="id_pelanggan" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
                  </div>
                  <div class="form-group mt-3">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="nomor_telepon">No. Telepon</label>
                    <input type="number" id="nomor_telepon" name="nomor_telepon" value="<?php echo $d['nomor_telepon']; ?>" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $d['alamat']; ?>" class="form-control">
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
        <div class="modal fade" id="hapus-data-<?php echo $d['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses_hapus_pembelian.php" method="post">
                <div class="modal-body">
                  <div class="form-group mt-3">
                    <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" class="form-control">
                    Apakah anda yakin ingin menghapus data <?php echo $d['nama_pelanggan']; ?> 
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
      <form action="proses_pembelian.php" method="post">
        <div class="modal-body">
          <div class="form-group mt-3">
            <label for="id_pelanggan">ID Pelanggan</label>
            <input type="text" id="id_pelanggan" name="id_pelanggan" value="<?php echo date('dmHis'); ?>" class="form-control" readonly>
          </div>
          <div class="form-group mt-3">
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="nomor_telepon">No. Telepon</label>
            <input type="number" id="nomor_telepon" name="nomor_telepon" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control" required>
            <input type="hidden" id="tanggal_penjualan" name="tanggal_penjualan" value="<?php echo date('Y-m-d'); ?>" class="form-control">
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