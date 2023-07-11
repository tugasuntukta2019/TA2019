<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Tambah Admin<center></h2><br><br>

<div class="container">
<!-- form dengan metode POST dan enctype bernilai "multipart/form-data". Form ini digunakan untuk menambahkan data. -->
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="pass">
	</div>
	<div class="form-group">
		<label>No Telepon</label>
		<input type="number" class="form-control" name="telepon">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea type="text" class="form-control" name="alamat"></textarea>
	</div>
    <br>
	<button class="btn btn-primary" name="save">Simpan</button><br>
</form>

<!-- Jika tombol "Simpan" (dengan atribut name="save") ditekan, maka nilai-nilai input form akan diambil menggunakan variabel $_POST. -->
<?php
if (isset($_POST['save'])) 
{
  $username  = $_POST['username'];
  $email  = $_POST['email'];
  $password  = $_POST['pass'];
  $telepon  = $_POST['telepon'];
  $alamat  = $_POST['alamat'];
//   query INSERT INTO akan dieksekusi untuk memasukkan data admin ke dalam tabel user dan tipe 2 karena untuk user "admin" di database
  $mysqli  = "INSERT INTO user (username, email, password, telepon, alamat, tipe) VALUES 
  							('$username', '$email', '$password', '$telepon', '$alamat', '2')";
  $result  = mysqli_query($koneksi, $mysqli);
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Admin Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=dataadmin.php'>";
  } else {
    echo "<script>alert('Admin gagal di tambah ke database anda');</script>";
  }
  mysqli_close($koneksi);
 }
?>
</div>
</body>
</html>