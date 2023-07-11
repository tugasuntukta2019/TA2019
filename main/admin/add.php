<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'headeradmin.php' ?>
<br><h2><center>Tambah Produk<center></h2><br><br>

<div class="container">
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Id</label>
		<input type="number" class="form-control" name="id">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Merk</label>
		<input type="text" class="form-control" name="merk">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>cc</label>
		<input type="number" class="form-control" name="cc">
	</div>
	<div class="form-group">
		<label>Tipe BBM</label>
		<input type="text" class="form-control" name="tipe_bbm">
	</div>
	<div class="form-group">
		<label>Jarak Tempuh</label>
		<input type="number" class="form-control" name="jarak_tempuh">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<select class="form-control" name="kategori">
			<option selected disabled>Pilih Kategori</option>
			<option value="2">Sparepart</option>
			<option value="3">Mobil</option>
			<option value="1">Service</option>
		</select>
	</div>
    <br>
	<div class="form-grup">
		<label class="foto"></label>
		<input type="file" name="foto" class="form-control">
	</div><br>
	<button class="btn btn-primary" name="save">Simpan</button><br>
</form>

<!-- Menangani logika pemrosesan form. Jika tombol "Simpan" ditekan, data dari form akan diambil menggunakan 
metode $_POST. Data tersebut akan dimasukkan ke dalam variabel yang sesuai. Kemudian, file foto akan diunggah 
ke direktori "asets/mobil" menggunakan fungsi move_uploaded_file(). Setelah itu, dilakukan penambahan data 
produk ke dalam tabel "mobil" menggunakan pernyataan SQL INSERT INTO. Jika penambahan berhasil, maka akan 
ditampilkan pesan sukses dan halaman akan di-refresh. Jika gagal, akan ditampilkan pesan error. -->
<?php
if (isset($_POST['save'])) 
{
	$id  = $_POST['id'];
  	$nama  = $_POST['nama'];
  	$merk  = $_POST['merk'];
  	$harga  = $_POST['harga'];
  	$cc  = $_POST['cc'];
  	$tipe_bbm  = $_POST['tipe_bbm'];
  	$jarak_tempuh  = $_POST['jarak_tempuh'];
  	$kategori  = $_POST['kategori'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  $stok = $_POST['stok'];
  move_uploaded_file($lokasi, "../asets/mobil/".$foto);
  $mysqli  = "INSERT INTO mobil (id, nama, merk, harga, cc, tipe_bbm, jarak_tempuh, foto, kategori, stok) VALUES
  							('$id', '$nama', '$merk', '$harga', '$cc', '$tipe_bbm', '$jarak_tempuh', '$foto', '$kategori', '$stok')";
  $result  = mysqli_query($koneksi, $mysqli);
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Produk Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php'>";
  } else {
    echo "<script>alert('Produk Gagal Di Tambah Ke Database Anda !');</script>";
  }
  mysqli_close($koneksi);
 }
?>
</div>
</body>
</html>