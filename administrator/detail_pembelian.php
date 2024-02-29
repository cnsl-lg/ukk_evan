<?php
include 'header.php';
include 'navbar.php';
?>

<div class="card mt-2">
  <div class="card-body">
    <?php
    include '../koneksi.php';
    $id_pelangggan = $_GET['id_pelanggan'];
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.id_pelanggan=penjualan.id_pelanggan");
    while ($d = mysqli_fetch_array($data)) : ?>
      <?php if ($d['id_pelanggan'] == $id_pelangggan) : ?>
      <table>
        <tr>
          <td>ID Pelanggan</td>
          <td>: <?php echo $d['id_pelanggan']; ?></td>
        </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td>: <?php echo $d['nama_pelanggan']; ?></td>
        </tr>
        <tr>
          <td>No. Telepon</td>
          <td>: <?php echo $d['nomor_telepon']; ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>: <?php echo $d['alamat']; ?></td>
        </tr>
        <tr>
          <td>Total Pembelian</td>
          <td>: <?php echo $d['total_harga']; ?></td>
        </tr>
      </table>
      <form action="tambah_detail_penjualan.php" method="post">
        <input type="text" name="penjualan_id" value="<?php echo $d['penjualan_id']; ?>" hidden>
        <input type="text" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
        <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah Barang</button>
      </form>
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah Beli</th>
            <th>Total Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../koneksi.php';
          $nos = 1;
          $detailpenjualan = mysqli_query($koneksi, "SELECT * FROM detailpenjualan");
          while ($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)) : ?>        
            <?php if ($d_detailpenjualan['id_penjualan'] == $d['penjualan_id']) : ?>
            <tr>
              <td><?php echo $nos++; ?></td>
              <td>
                <form action="simpan_barang_beli.php" method="post">
                  <div class="form-group">
                    <input type="text" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
                    <input type="text" name="id_detail" value="<?php echo $d_detailpenjualan['id_detail']; ?>" hidden>
                    <select name="id_produk" id="id_produk" class="form-control" onchange="this.form.submit()">
                      <option>=== Pilih Produk ===</option>
                      <?php
                      include '../koneksi.php';
                      $no = 1;
                      $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                      while ($d_produk = mysqli_fetch_array($produk)) : ?>
                        <?php if ($d_produk['stok'] == 0) { ?>
                        <?php } else { ?>
                        <option value="<?php echo $d_produk['id_produk']; ?>" <?php if ($d_produk['id_produk'] == $d_detailpenjualan['id_produk']) { echo "selected"; } ?>><?php echo $d_produk['nama_produk']; ?></option>
                        <?php } ?>
                      <?php endwhile ?>
                    </select>
                  </div>
                </form>
              </td>
              <td>
                <form action="hitung_subtotal.php" method="post">
                  <?php
                  include '../koneksi.php';
                  $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                  while ($d_produk = mysqli_fetch_array($produk)) : ?>
                    <?php if ($d_produk['id_produk'] == $d_detailpenjualan['id_produk']) : ?>
                    <input type="number" name="harga" value="<?php echo $d_produk['harga']; ?>" hidden>
                    <input type="number" name="id_produk" value="<?php echo $d_produk['id_produk']; ?>" hidden>
                    <input type="number" name="stok" value="<?php echo $d_produk['stok']; ?>" hidden>
                    <?php endif ?>
                  <?php endwhile ?>
                  <div class="form-group">
                    <input type="number" name="jumlah_produk" value="<?php echo $d_detailpenjualan['jumlah_produk']; ?>" class="form-control">
                  </div>
                </dt>
                <td><?php echo $d_detailpenjualan['subtotal']; ?></td>
                <td>
                  <input type="number" name="id_detail" value="<?php echo $d_detailpenjualan['id_detail']; ?>" hidden>
                  <input type="number" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
                  <button type="submit" class="btn btn-warning btn-sm mt-3">Proses</button>
                </form>
                <form action="hapus_detail_pembelian.php" method="post">
                  <input type="number" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
                  <input type="number" name="id_detail" value="<?php echo $d_detailpenjualan['id_detail']; ?>" hidden>
                  <button type="submit" class="btn btn-danger btn-sm mt-3">Hapus</button>
                </form>
              </td>
            </tr>
            <?php endif ?>
          <?php endwhile ?>
        </tbody>
      </table>
      <?php
      if (isset($_GET['pesan'])) :
        if ($_GET['pesan'] == 'simpan') : ?>
          <div class="alert alert-success" role="alert">
            Berhasil melakukan pembelian.
          </div>
        <?php endif ?>
      <?php endif ?>
      <form action="simpan_total_harga.php" method="post">
        <?php
        include '../koneksi.php';
        $detailpenjualan = mysqli_query($koneksi, "SELECT SUM(subtotal) AS total_harga FROM detailpenjualan WHERE id_penjualan='$d[penjualan_id]'");
        $row = mysqli_fetch_assoc($detailpenjualan);
        $sum = $row['total_harga']; 
        ?>
        <div class="row">
          <div class="col-sm-10">
            <div class="form-group">
              <input type="number" class="form-control" name="total_harga" value="<?php echo $sum; ?>" readonly>
              <input type="text" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>" hidden>
              <input type="text" name="penjualan_id" value="<?php echo $d['penjualan_id']; ?>" hidden>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <button type="submit" class="btn btn-info btn-sm form-control">Simpan</button>
            </div>
          </div>
        </div>
      </form>
      <?php endif ?>
    <?php endwhile ?>
  </div>
</div>

<?php
include 'footer.php';
?>