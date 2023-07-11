<?php include '../koneksi.php' ?>
<?php include '../component.php';

// variabel $pembelian diinisialisasi dengan nilai dari parameter id
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
    <?php include 'headersuperadmin.php'?>
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
	<?php $totalbelanja =0 ?>
	<?php $nomor=1; ?>
	<!-- if (empty($_GET['cari']))Ini adalah sebuah kondisi if yang memeriksa apakah parameter cari hasil kosong. Jika kosong, maka kode di dalamnya akan dijalankan. -->
	<?php if (empty($_GET['cari'])) {
		// Query SQL digunakan untuk mengambil data detail pembelian dari tabel "detail_pembelian" dengan melakukan JOIN dengan tabel "mobil" berdasarkan kolom "id_mobil" dan "id". Data yang diambil akan difilter berdasarkan ID pembelian yang disimpan dalam variabel $pembelian.
		$ambil = $koneksi->query("SELECT * FROM detail_pembelian JOIN mobil on detail_pembelian.id_mobil=mobil.id  WHERE id_pembelian = '$pembelian'");
	}?>

	<!-- Ini adalah perulangan while yang akan berjalan selama terdapat data yang diambil dari hasil query sebelumnya. Setiap baris data akan disimpan dalam array $pecah dengan metode fetch_assoc(). -->
	<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
            <td><?php echo $pecah["nama"]?></td>
			<td><?php echo $pecah['jumlah'] ?>x</td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td>Rp. <?php echo number_format($pecah['total']); ?></td>
		</tr>
		<?php $nomor++; ?>
        <?php $totalbelanja+=$pecah['total']; ?>
		<?php } ?>
        	<tfoot>
				<th colspan="3">Total Belanja</th>
				<th>Rp. <?php echo number_format($totalbelanja) ?></th>
			</tfoot>
</table>
<form method="post">
			<div class="row">
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