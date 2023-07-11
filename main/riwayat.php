<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user']))
{
  echo"<script>alert('anda harus login')</script>";
  echo"<script>location='login.php';</script>";
  header('location:login.php');
  exit();
} 
// Mendapatkan ID pengguna dari session untuk digunakan dalam query.
$id=$_SESSION["user"]['id']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <?php include 'koneksi.php' ?>
    <?php include 'component.php' ?>
</head>
<body>
<?php include 'header.php' ?>
<div class="container">
    <br><h1><center>Riwayat Pesanan</center></h1><br>
    <table class="table table-bordered">
	<thead>
    <tr> 
		<th>No</th>
		<th>Username</th>
		<th>Alamat</th>
		<th>Telepon</th>
		<th>Tanggal</th>
		<th>Pembayaran</th>
		<th>Pengiriman</th>
		<th>Sparepart</th>
		<th>Total_Harga</th>
        <th>Action</th>
	</tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
    <!-- Mengambil data riwayat pesanan dari tabel pembelian, detail_pembelian, user, dan mobil dengan menggunakan query JOIN. Data yang diambil terkait dengan ID pengguna yang sedang login. Hasil query akan diperoleh dalam variabel $ambil. -->
    <?php $ambil = $koneksi->query("SELECT * FROM pembelian join detail_pembelian on pembelian.id=detail_pembelian.id_pembelian
                    join user on pembelian.id_user=user.id join mobil on detail_pembelian.id_mobil=mobil.id where id_user='$id' group by detail_pembelian.id_pembelian"); ?>

    <!-- Menggunakan perulangan while untuk menampilkan setiap data riwayat pesanan dalam tabel. Data yang ditampilkan meliputi nomor, username, alamat, telepon, tanggal, pembayaran, pengiriman, daftar sparepart, total harga, dan tombol "Hapus" untuk menghapus riwayat pesanan. -->
    <?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
        <td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['username']; ?></td>
            <td><?php echo $pecah['alamat']; ?></td>
            <td><?php echo $pecah['telepon']; ?></td>
            <td><?php echo $pecah['tanggal']; ?></td>
			<td><?php echo $pecah['pembayaran']; ?></td>
			<td><?php echo $pecah['pengiriman']; ?></td>
            <?php $mobilmobil=""; ?>
            <?php $idnya=$pecah['id_pembelian']; ?>
            <?php $ambilmobil = $koneksi->query("SELECT * FROM detail_pembelian join mobil on detail_pembelian.id_mobil=mobil.id where detail_pembelian.id_pembelian=$idnya"); ?>
            <td>
            <?php while ($pecahlagi = $ambilmobil->fetch_assoc()){
                $mobilmobil = $mobilmobil . ', ' . $pecahlagi['nama'];
            }
                echo substr($mobilmobil, 2) ?>
            </td>
            <td><?php echo $pecah['subtotal']; ?></td>
            <td>
				<a href="deleteriwayat.php?id=<?php echo $pecah['id_pembelian'] ?>"  class="btn-danger btn">Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
    </tbody>
	
</table>
</div>
</body>
</html>