<?php include 'koneksi.php' ?>
<?php include 'component.php';
// Mengambil nilai parameter id dari URL menggunakan $_GET['id'] dan menyimpannya dalam variabel $pembelian.
$pembelian = $_GET ['id'];

// Memulai session PHP untuk mengakses variabel session.
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
</head>
<body>
    <?php include 'header.php'?>
    <div class="container">
    <br><h1><center>Detail Pesanan<center></h1><br><br>
</form>	
<table class="table table-bordered">
	<tr>
		<th>Sparepart</th>
		<th>Jumlah</th>
		<th>Harga</th>
		<th>Total</th>
	</tr>
	<!-- Inisialisasi variabel $totalbelanja dan $nomor. Jika parameter cari dalam URL kosong, maka ambil data detail pembelian dan mobil dari database berdasarkan id_pembelian yang sesuai dengan $pembelian. -->
	<?php $totalbelanja =0 ?>
	<?php $nomor=1; ?>
	<?php if (empty($_GET['cari'])) {
		$ambil = $koneksi->query("SELECT * FROM detail_pembelian JOIN mobil on detail_pembelian.id_mobil=mobil.id  WHERE id_pembelian = '$pembelian'");
	}?>
	<!-- : Loop while digunakan untuk menampilkan baris-baris data dari hasil query. Setiap baris menampilkan 
	nama sparepart, jumlah, harga, dan total harga. -->
	<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
            <td><?php echo $pecah["nama"]?></td>
			<td><?php echo $pecah['jumlah'] ?>x</td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td>Rp. <?php echo number_format($pecah['total']); ?></td>
		</tr>
		<!-- Variabel $nomor digunakan untuk memberikan nomor urut pada setiap baris. -->
		<?php $nomor++; ?>
		<!-- Variabel $totalbelanja juga diupdate untuk menghitung total belanja. -->
        <?php $totalbelanja+=$pecah['total']; ?>
		<?php } ?>
        	<tfoot>
			<!-- Menampilkan total belanja dengan format harga menggunakan number_format(). -->
				<th colspan="3">Total Belanja</th>
				<th>Rp. <?php echo number_format($totalbelanja) ?></th>
			</tfoot>
</table>
<form method="post">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Username : </label>
						<input type="text"  readonly value="<?php echo $_SESSION
						["user"]['username'] ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Email : </label>
						<input type="text"  readonly value="<?php echo $_SESSION
						["user"]['email'] ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Nomor telepon : </label>
						<input type="text"  readonly value="<?php echo $_SESSION
						["user"]['telepon'] ?>" class="form-control">
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Total Pembayaran : </label>
						<input type="text"  readonly value="Rp. <?php echo number_format($totalbelanja) ?>" class="form-control">
					</div>	
				</div>
			</div>
			<!-- Mengambil data pengguna dan pembelian dari database berdasarkan id_pembelian. Variabel $pembayaran dan $pengiriman diisi dengan nilai pembayaran dan pengiriman yang ada dalam data tersebut. -->
			<?php $ambil = $koneksi->query("SELECT * FROM user JOIN pembelian ON user.id=pembelian.id_user WHERE pembelian.id='$pembelian'"); ?>
				<?php while ($pecah = $ambil->fetch_assoc()){ ?>
					
						<?php $pembayaran = $pecah['pembayaran']; ?>
						<?php $pengiriman = $pecah['pengiriman']; ?>
						
					
			<?php } ?>
			<!-- Menampilkan elemen input text yang hanya dapat dibaca (readonly) dengan nilai-nilai metode pembayaran, pengiriman, dan alamat pengiriman. -->
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
				<input type="text"  readonly value="<?php echo $_SESSION
						["user"]['alamat'] ?>" class="form-control">
			</div><br>
		</form>
    </div>
	<?php include 'footer.php'?>
</body>
</html>