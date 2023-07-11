<?php session_start();
$id=$_SESSION["user"]['id']?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <?php include 'koneksi.php' ?>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php' ?>
<div class="container">
    <br><h1><center>Keranjang<center></h1><br><br>
    <table class="table table_bordered">
	<tr>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Harga</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
	<!-- enampilkan daftar barang yang ada di keranjang belanja. Data tersebut diambil dari tabel keranjang dan 
	di-join dengan tabel mobil berdasarkan ID mobil. Query SELECT * FROM keranjang JOIN mobil ON keranjang.id_mobil=mobil.id where id_user='$id' 
	digunakan untuk mendapatkan data tersebut. Setiap barang ditampilkan dalam loop while dan informasi seperti nama barang, 
	jumlah, harga, total, dan tombol "Hapus" ditampilkan. -->
	<?php $nomor=1; ?>
	<?php $ambil = $koneksi->query("SELECT * FROM keranjang JOIN mobil ON keranjang.id_mobil=mobil.id where id_user='$id' "); ?>
	<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo number_format($pecah['harga']); ?></td>

            <!-- Menghitung total harga untuk setiap barang di keranjang dengan mengalikan jumlah barang dengan harga satuan. -->
			<?php
            $total=$pecah["jumlah"]*$pecah['harga'];
            ?>
            <td><?php echo number_format($total); ?></td>
			<!-- Menampilkan tombol "Hapus" yang mengarahkan ke halaman "hapus_keranjang.php" dengan mengirimkan parameter id untuk menghapus barang dari keranjang. -->
            <td><a href="hapus_keranjang.php?id=<?php echo $pecah['id']; ?>" class="btn btn-danger">Hapus</a></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
</table>
<!-- Menampilkan tombol "Checkout" yang mengarahkan pengguna ke halaman "checkout.php" untuk melanjutkan proses pembayaran. -->
<a href="checkout.php" class="btn btn-success" name="checkout">Checkout</a>
</div><br><br>
	<?php include 'footer.php'?>
    <script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>