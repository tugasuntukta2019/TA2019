<?php include '../koneksi.php' ?>
<?php include '../component.php';
// Mengambil id pembelian dari parameter $_GET['id'] dan menyimpannya dalam variabel $pembelian.
$pembelian = $_GET ['id'];
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
</head>
<body>
    <?php include 'headeradmin.php'?>
    <div class="container">
    <br><h1><center>Detail Pembelian<center></h1><br><br>
</form>	
<table class="table table-bordered">
	<tr>
		<th>Sparepart</th>
		<th>Jumlah</th>
		<th>Harga</th>
		<th>Total</th>
	</tr>
	<!-- variabel $totalbelanja sebagai 0 untuk menghitung total belanja. -->
	<?php $totalbelanja =0 ?>
	<!-- variabel $nomor sebagai 1 untuk memberikan nomor urut pada setiap baris. -->
	<?php $nomor=1; ?>
	<!-- Mengambil data-detail pembelian dari database berdasarkan id pembelian yang diterima dan melakukan perulangan menggunakan while untuk menampilkan setiap baris data. -->
	<?php if (empty($_GET['cari'])) {
		$ambil = $koneksi->query("SELECT * FROM detail_pembelian JOIN mobil on detail_pembelian.id_mobil=mobil.id  WHERE id_pembelian = '$pembelian'");
	}?>
	<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<!-- Menampilkan data-detail pembelian seperti nama sparepart, jumlah, harga, dan total pada setiap baris tabel. -->
		<tr>
            <td><?php echo $pecah["nama"]?></td>
			<td><?php echo $pecah['jumlah'] ?>x</td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td>Rp. <?php echo number_format($pecah['total']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<!-- Menghitung total belanja dengan menambahkan total setiap baris ke variabel $totalbelanja. -->
        <?php $totalbelanja+=$pecah['total']; ?>
		<?php } ?>
        	<tfoot>
				<th colspan="3">Total Belanja</th>
				<th>Rp. <?php echo number_format($totalbelanja) ?></th>
			</tfoot>
</table>
<form method="post">
			<div class="row">
			<!-- query SELECT untuk mengambil informasi user dan pembelian berdasarkan id pembelian yang diterima. Data tersebut disimpan dalam variabel $ambil. -->
                <?php $ambil = $koneksi->query("SELECT * FROM user JOIN pembelian ON user.id=pembelian.id_user WHERE pembelian.id='$pembelian'"); ?>
				<?php while ($pecah = $ambil->fetch_assoc()){ ?>

						<?php $idd = $pecah['id_user']; ?>
						<?php $username = $pecah['username']; ?>
						<?php $email = $pecah['email']; ?>
						<?php $alamat = $pecah['alamat']; ?>
						<?php $telepon = $pecah['telepon']; ?>
						<?php $pembayaran = $pecah['pembayaran']; ?>
						<?php $pengiriman = $pecah['pengiriman']; ?>
						
					
			    <?php } ?>
				<!-- Menampilkan data informasi user dan pembelian seperti username, email, nomor telepon, 
				total pembayaran, metode pembayaran, pengiriman, dan alamat pengiriman dalam bentuk input 
				yang tidak bisa diubah (readonly). -->
				<div class="col-md-3">
					<div class="form-group">
						<label>Username : </label>
						<input type="text"  readonly value="<?php echo $username ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Email : </label>
						<input type="text"  readonly value="<?php echo $email ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Nomor telepon : </label>
						<input type="text"  readonly value="<?php echo $telepon ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Total Pembayaran : </label>
						<input type="text"  readonly value="Rp. <?php echo number_format($totalbelanja) ?>" class="form-control">
					</div>	
				</div>
			</div>
			<br><div class="form-group">
				<label>Metode Pembayaran : </label>
				<input type="text"  readonly value="<?php echo $pembayaran ?>" class="form-control">
			</div>
			<br><div class="form-group">
				<label>Pengiriman : </label>
				<input type="text"  readonly value="<?php echo $pengiriman ?>" class="form-control">
			</div><br>
			<div class="form-group">
				<label>Alamat Pengiriman : </label>
				<input type="text"  readonly value="<?php echo $alamat ?>" class="form-control">
			</div><br>
		</form>
    </div>
</body>
</html>