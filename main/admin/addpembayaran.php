<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Metode Pembayaran</title>
</head>
<body>
<?php include 'headeradmin.php' ?>
<br><h2><center>Tambah Metode Pembayaran<center></h2><br>

<div class="container">
<!-- Menampilkan form untuk menambahkan data metode pembayaran baru. Terdapat satu input yaitu "Nama". Ada juga 
tombol "Simpan" untuk menyimpan data metode pembayaran. -->
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
    <br>
	<button class="btn btn-primary" name="save">Simpan</button><br>
</form>

<!-- Menangani logika pemrosesan form. Jika tombol "Simpan" ditekan, data dari form akan diambil menggunakan 
metode $_POST. Data tersebut akan dimasukkan ke dalam variabel yang sesuai. Setelah itu, dilakukan penambahan 
data metode pembayaran ke dalam tabel "metode_pembayaran" menggunakan pernyataan SQL INSERT INTO. Jika 
penambahan berhasil, maka akan ditampilkan pesan sukses dan halaman akan di-refresh. Jika gagal, akan 
ditampilkan pesan error. -->
<?php
if (isset($_POST['save'])) 
{
  $nama  = $_POST['nama'];
  $mysqli  = "INSERT INTO metode_pembayaran (nama) VALUES 
  							('$nama')";
  $result  = mysqli_query($koneksi, $mysqli);
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Metode Pembayaran Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=pembayaran.php'>";
  } else {
    echo "<script>alert('Metode Pembayaran Gagal Di Tambah Ke Database Anda !');</script>";
  }
  mysqli_close($koneksi);
 }
?>
</div>
</body>
</html>