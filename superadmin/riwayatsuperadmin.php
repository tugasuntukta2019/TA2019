<?php
session_start();
include '../koneksi.php';
// memeriksa apakah variabel $_SESSION['user'] benar. Jika variabel tersebut tidak benar, artinya pengguna belum login,
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Anda harus login')</script>";
  echo "<script>location='../login.php';</script>";
  header('location:../login.php');
  exit();
} 

// Filter tanggal
// $tanggal = '';
// if (isset($_GET['tanggal'])) {
//   $tanggal = $_GET['tanggal'];
//   $query_filter = "WHERE DATE(pembelian.tanggal) = '$tanggal'";
// } else {
//   $query_filter = '';
// }

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
<?php include 'headersuperadmin.php' ?>
<div class="container">
    <br><h1><center>Riwayat Pembelian</center></h1><br>

    <!-- Filter tanggal -->
    <!-- orm untuk melakukan filter berdasarkan tanggal. Pengguna dapat memilih tanggal pada input type "date" dan mengklik tombol "Filter" untuk mengirimkan permintaan filter tanggal. -->
    <!-- <form action="" method="GET">
      <div class="mb-3">
        <label for="tanggal" class="form-label">Filter Tanggal:</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
    </form> -->

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
      <?php 
      // query SQL yang digunakan untuk mengambil data dari tabel pembelian, detail_pembelian, user, dan mobil. Query ini menggunakan JOIN untuk menggabungkan tabel-tabel tersebut berdasarkan relasi antar tabel
      // Variabel $query_filter digunakan sebagai bagian dari query untuk memfilter data berdasarkan tanggal yang dipilih (jika ada).
      $query = "SELECT * FROM pembelian 
                  JOIN detail_pembelian ON pembelian.id = detail_pembelian.id_pembelian 
                  JOIN user ON pembelian.id_user = user.id 
                  JOIN mobil ON detail_pembelian.id_mobil = mobil.id 
                  GROUP BY detail_pembelian.id_pembelian";

        // -- $query_filter 

          // query yang telah dibuat sebelumnya untuk mengambil data dari database. Hasil query disimpan dalam variabel $ambil.
        $ambil = $koneksi->query($query); 
      ?>
      <!-- perulangan while yang akan berjalan selama masih ada baris data yang diambil dari hasil query. Setiap baris data akan disimpan dalam array asosiatif $pecah. -->
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
          <!-- "Detail" yang mengarahkan pengguna ke halaman detailriwayatadmin.php dengan menyertakan parameter id_pembelian. -->
            <a href="detailriwayatadmin.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Detail</a>
            <!-- Hapus" yang mengarahkan pengguna ke halaman deleteriwayatadmin.php dengan menyertakan parameter id_pembelian.  -->
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
