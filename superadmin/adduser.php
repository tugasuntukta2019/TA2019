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
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Tambah User<center></h2><br><br>

<div class="container">
<!-- user  akan ditambahkan. Input form yang ada meliputi input text untuk "Username", "Email", "Password", 
input number untuk "No Telepon", dan textarea untuk "Alamat". Nilai-nilai yang diinputkan pada input field 
ini akan diambil menggunakan variabel $_POST  -->
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

<!-- "Simpan" (dengan atribut name="save") ditekan, maka nilai-nilai yang diinputkan pada input field akan diambil menggunakan $_POST.  -->
<?php
if (isset($_POST['save'])) 
{
  $username  = $_POST['username'];
  $email  = $_POST['email'];
  $password  = $_POST['pass'];
  $telepon  = $_POST['telepon'];
  $alamat  = $_POST['alamat'];

	//   query INSERT INTO akan dieksekusi untuk memasukkan data pengguna ke dalam tabel user di database
	// user ditentukan sebagai '1' customer
  $mysqli  = "INSERT INTO user (username, email, password, telepon, alamat, tipe) VALUES 
  							('$username', '$email', '$password', '$telepon', '$alamat', '1')";
  $result  = mysqli_query($koneksi, $mysqli);
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan User Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=datauser.php'>";
  } else {
    echo "<script>alert('User gagal di tambah ke database anda');</script>";
  }
//   mysqli_close($koneksi) digunakan untuk menutup koneksi ke database setelah selesai digunakan.
  mysqli_close($koneksi);
 }
?>
</div>
</body>
</html>