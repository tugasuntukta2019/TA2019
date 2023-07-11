<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
<?php include 'headeradmin.php' ?>
<br><h2><center>Tambah User<center></h2><br><br>

<div class="container">
<!-- untuk menambahkan data pengguna baru. Terdapat beberapa input seperti "Username", "Email", "Password", "No Telepon", dan "Alamat". 
Setiap input diberi atribut name untuk mengidentifikasi data saat form dikirim. Terdapat juga tombol "Simpan" 
untuk menyimpan data pengguna. -->
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

<!-- Jika tombol "Simpan" ditekan, data dari form akan diambil menggunakan metode $_POST. Data tersebut akan 
dimasukkan ke dalam variabel yang sesuai. Setelah itu, dilakukan penambahan data pengguna baru ke dalam tabel 
"user" menggunakan pernyataan SQL INSERT INTO. Jika penambahan berhasil, maka akan ditampilkan pesan sukses 
dan halaman akan di-refresh. Jika gagal, akan ditampilkan pesan error. -->
<?php
if (isset($_POST['save'])) 
{
  $username  = $_POST['username'];
  $email  = $_POST['email'];
  $password  = $_POST['pass'];
  $telepon  = $_POST['telepon'];
  $alamat  = $_POST['alamat'];

  $mysqli  = "INSERT INTO user (username, email, password, telepon, alamat, tipe) VALUES 
  							('$username', '$email', '$password', '$telepon', '$alamat', '1')";
  $result  = mysqli_query($koneksi, $mysqli);
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan User Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=datauser.php'>";
  } else {
    echo "<script>alert('User Di Tambah Ke Database Anda');</script>";
  }
  mysqli_close($koneksi);
 }
?>
</div>
</body>
</html>