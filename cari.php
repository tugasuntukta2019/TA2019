<!-- digunakan untuk memasukkan file koneksi.php yang berisi koneksi ke database. File ini berfungsi untuk menghubungkan halaman dengan database. -->
<?php include 'koneksi.php'; ?>
<!-- digunakan untuk memasukkan file component.php yang mungkin berisi komponen atau fungsi yang digunakan dalam halaman ini. fungsi session_start() digunakan untuk memulai sesi pengguna. -->
<?php include 'component.php';
session_start() ?>

<!-- digunakan untuk melakukan pencarian produk berdasarkan keyword yang diberikan oleh pengguna. Keyword diambil dari parameter $_GET["keyword"]. Kemudian, dilakukan query ke database untuk mencari produk yang sesuai dengan keyword pada tabel services, sparepart, dan mobil. Hasil query disimpan dalam array $semuadata1, $semuadata2, dan $semuadata3 masing-masing. -->
<?php  
$keyword = $_GET["keyword"];

$semuadata1=array();
$semuadata2=array();
$semuadata3=array();
$ambil1 = $koneksi->query("SELECT * FROM services WHERE nama LIKE '%$keyword%' ");
$ambil2 = $koneksi->query("SELECT * FROM sparepart WHERE nama LIKE '%$keyword%' ");
$ambil3 = $koneksi->query("SELECT * FROM mobil WHERE nama LIKE '%$keyword%' ");

// Digunakan untuk menampilkan hasil pencarian. Pertama, mengecek apakah array hasil pencarian kosong atau tidak 
// menggunakan empty(). Jika kosong, maka menampilkan pesan pemberitahuan bahwa produk tidak ditemukan. Jika tidak 
// kosong, maka melakukan looping untuk setiap hasil pencarian dan menampilkan informasi produk seperti nama, 
// harga, dan gambar menggunakan tag HTML.
while ($pecah = $ambil1->fetch_assoc()) 
{
	$semuadata1[]=$pecah;
}

while ($pecah = $ambil2->fetch_assoc()) 
{
	$semuadata2[]=$pecah;
}

while ($pecah = $ambil3->fetch_assoc()) 
{
	$semuadata3[]=$pecah;
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pencarian Produk</title>
</head>
<body>
	<?php include 'header.php'?>
<div class="container">
	<h3>Hasil Pencarian : "<?php echo $keyword ?>"</h3>
	<?php if (empty($semuadata1) && empty($semuadata2) && empty($semuadata3)): ?>
    <div class="alert alert-danger">Produk '<strong><?php echo $keyword ?></strong>' Tidak Ditemukan!</div>
	<?php endif; ?>

<div class="row">

		<?php foreach ($semuadata1 as $key => $value): ?>
		<div class="col-md-3">
		<div class="thumbnail ">
				<img src="asets/services/<?php echo $value ['foto']; ?>" style="width: 70%;">
				<div class="caption">
					<h4><?php echo $value ['nama'] ?></h4>
					<h5>Rp <?php echo number_format($value ['harga']) ?></h5>
					<a href="beli.php?id=<?php echo $value['id'];?>" class="btn btn-primary">Beli</a>
				</div>
			</div>
			</div>
		<?php endforeach ?>

		<?php foreach ($semuadata2 as $key => $value): ?>
		<div class="col-md-3">
		<div class="thumbnail ">
				<img src="asets/sparepart/<?php echo $value ['foto']; ?>" style="width: 70%;">
				<div class="caption">
					<h4><?php echo $value ['nama'] ?></h4>
					<h5>Rp <?php echo number_format($value ['harga']) ?></h5>
					<a href="beli.php?id=<?php echo $value['id'];?>" class="btn btn-primary">Beli</a>
				</div>
			</div>
			</div>
		<?php endforeach ?>

		<?php foreach ($semuadata3 as $key => $value): ?>
		<div class="col-md-3">
		<div class="thumbnail ">
				<img src="asets/mobil/<?php echo $value ['foto']; ?>" style="width: 70%;">
				<div class="caption">
					<h4><?php echo $value ['nama'] ?></h4>
					<h5>Rp <?php echo number_format($value ['harga']) ?></h5>
					<a href="beli.php?id=<?php echo $value['id'];?>" class="btn btn-primary">Beli</a>
				</div>
			</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

</body>
</html>