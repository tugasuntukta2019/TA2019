<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Anda harus login')</script>";
  echo "<script>location='../login.php';</script>";
  header('location:../login.php');
  exit();
} 

// Filter tanggal
$tanggal = '';
if (isset($_GET['tanggal'])) {
  $tanggal = $_GET['tanggal'];
  $query_filter = "WHERE DATE(pembelian.tanggal) = '$tanggal'";
} else {
  $query_filter = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <?php include '../koneksi.php' ?>
    <?php include '../component.php' ?>
</head>
<body>
<?php include 'headeradmin.php' ?>
<div class="container">
    <br><h1><center>Riwayat Pembelian</center></h1><br>

    <table class="table table-bordered">
	    <thead>
        <tr> 
		      <th>No</th>
		      <th>Username</th>
          <th>Waktu Transaksi</th>
		      <th>Alamat Pengiriman</th>
		      <th>Total Harga</th>
          <th>Action</th>
	      </tr>
      </thead>
      <tbody>
      <?php $nomor=1; ?>
      <!-- query yang menggabungkan tabel pembelian, detail_pembelian, user, dan mobil dengan menggunakan JOIN. -->
      <?php 
        $query = "SELECT * FROM pembelian 
                  JOIN detail_pembelian ON pembelian.id = detail_pembelian.id_pembelian 
                  JOIN user ON pembelian.id_user = user.id 
                  JOIN mobil ON detail_pembelian.id_mobil = mobil.id 
                  $query_filter 
                  GROUP BY detail_pembelian.id_pembelian";
        $ambil = $koneksi->query($query); 
      ?>
       <!-- query akan diambil menggunakan $koneksi->query($query) dan ditampilkan dalam perulangan while. Pada setiap baris, ditampilkan nomor, username, waktu transaksi, alamat pengiriman, total harga, dan tombol aksi "Detail" dan "Hapus" yang mengarahkan ke halaman terkait dengan menggunakan parameter id. -->
	    <?php while ($pecah = $ambil->fetch_assoc()){ ?>
		    <tr>
          <td><?php echo $nomor; ?></td>
			    <td><?php echo $pecah['username']; ?></td>
          <td><?php echo $pecah['tanggal']; ?></td>
          <td><?php echo $pecah['alamat']; ?></td>
          <?php $mobilmobil=""; ?>
          <?php $idnya=$pecah['id_pembelian']; ?>
          <td><?php echo $pecah['subtotal']; ?></td>
          <td>
            <a href="detailriwayatadmin.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Detail</a>
            <a href="deleteriwayatadmin.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn-danger btn">Hapus</a>
          </td>
	      </tr>
	      <?php $nomor++; ?>
      <?php } ?>
      </tbody>
    </table>
</div>
</body>
</html>
