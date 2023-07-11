<?php 
// Mengecek apakah pengguna telah login atau belum dengan memeriksa keberadaan variabel $_SESSION['user']. Jika pengguna belum login, maka akan ditampilkan pesan alert dan pengguna akan diarahkan ke halaman "login.php". 
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) 
{
  echo"<script>alert('anda harus login')</script>";
  echo"<script>location='indextes.php';</script>";
  header('location:indextes.php');
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header.php'?>
    <div class="container">
		<br></br>
		<!-- Menampilkan carousel (slideshow) dengan menggunakan komponen Carousel dari Bootstrap. -->
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
			</div>
			<div class="carousel-inner">
			<!-- Gambar dan teks untuk setiap slide diambil dari database menggunakan query SELECT * FROM carousel. 
			Setiap item slide diproses dalam loop while dan dilakukan pengulangan untuk setiap item menggunakan 
			variabel $active yang mengatur slide pertama sebagai slide aktif. -->
				<?php
					$ambil = $koneksi->query("SELECT * FROM carousel");
					$active = "active";
					while ($carousel = $ambil->fetch_assoc()) {
				?>
				<div class="carousel-item <?php echo $active; ?>">
					<img src="asets/carousel/<?php echo $carousel['foto']; ?>" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5><?php echo $carousel['judul']; ?></h5>
						<p><?php echo $carousel['deskripsi']; ?></p>
					</div>
				</div>
				<?php
					$active = "";
					}
				?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
		<br></br>

		<div class="mobil">
			<h1>Mobil</h1>
			<div align="right">
				<a href="mobil.php" class="btn btn-primary">Selanjutnya</a>
			</div>
			<br>
		</div>
		<div class="row">
		<!-- Data mobil diambil dari database menggunakan query SELECT * FROM mobil where kategori=3 and id between 1 and 4 AND stok > 0. -->
			<?php $ambil=$koneksi->query("SELECT * FROM mobil where kategori=3 and id between 1 and 4 AND stok > 0"); ?>

			<!-- Setiap mobil ditampilkan dalam loop while dan informasi seperti nama, harga, dan tombol "Beli" ditampilkan. -->
			<?php while($perproduk=$ambil->fetch_assoc()){ ?>
			<div class="col-md-3">	
				<div class="thumbnail">
					<img src="asets/mobil/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
					<div class="caption">
						<h4><?php echo $perproduk['nama'] ?></h4>
						<h5>Rp <?php echo number_format($perproduk['harga']) ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id']; ?>" class="btn btn-primary">Add</a>
					</div>
				</div> <br>
			</div>
			<?php } ?>
		</div>	
		<br>
		<div class="Service">
			<h1>Service</h1>
			<div align="right">
				<a href="Service.php" class="btn btn-primary">Selanjutnya</a>
			</div>
		</div><br>
		<div class="row">
			<!-- Data layanan diambil dari database menggunakan query SELECT * FROM services where kategori=1 and id between 1 and 4. -->
			<?php $ambil=$koneksi->query("SELECT * FROM services where kategori=1 and id between 1 and 4"); ?>
			<!-- Setiap layanan ditampilkan dalam loop while dan informasi seperti nama dan tombol "Booking" ditampilkan. Tombol "Booking" mengarahkan pengguna ke halaman WhatsApp untuk melakukan booking layanan.  -->
			<?php while($perproduk=$ambil->fetch_assoc()){ ?>
			<div class="col-md-3">	
				<div class="thumbnail">
					<img src="asets/services/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
					<div class="caption">
						<h4><?php echo $perproduk['nama'] ?></h4>
						<a href="https://wa.me/0895365253632" class="btn btn-primary">Reserve</a>
					</div>
				</div> 
				</div>
			<?php } ?>
		</div>	<br>
		<div class="sparepart">
			<h1>Sparepart</h1>
			<div align="right">
				<a href="sparepart.php" class="btn btn-primary">Selanjutnya</a>
			</div>
		</div><br>
		<div class="row">
			<!-- Data sparepart diambil dari database menggunakan query SELECT * FROM sparepart where kategori=2 and id between 1 and 4 AND stok > 0. -->
			<?php $ambil=$koneksi->query("SELECT * FROM sparepart where kategori=2 and id between 1 and 4 AND stok > 0"); ?>
			<!-- Setiap sparepart ditampilkan dalam loop while dan informasi seperti nama dan stok ditampilkan.  -->
			<?php while($perproduk=$ambil->fetch_assoc()){ ?>
			<div class="col-md-3">	
				<div class="thumbnail">
					<img src="asets/sparepart/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
					<div class="caption">
						<h4><?php echo $perproduk['nama'] ?></h4>
						<h5>Stok: <?php echo $perproduk['stok']; ?></h5>
					</div>
				</div> 
			</div>
			<?php } ?>
		</div>	
	</div><br><br>
	<?php include 'footer.php'?>
	<script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
