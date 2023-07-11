<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Ubah User<center></h2><br><br>
<!-- query SELECT untuk mengambil informasi pengguna (user) berdasarkan id yang diterima. Data tersebut 
disimpan dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi pengguna seperti username, email, password, nomor telepon, dan alamat akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM user WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post">
    <div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" value="<?php echo $pecah['username']; ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text"class="form-control" name="email" value="<?php echo $pecah['email']; ?>">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text"class="form-control" name="pass" value="<?php echo $pecah['password']; ?>">
	</div>
	<div class="form-group">
		<label>Nomor Telepon</label>
		<input type="number"class="form-control" name="telepon" value="<?php echo $pecah['telepon']; ?>">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text"class="form-control" name="alamat" value="<?php echo $pecah['alamat']; ?>">
	</div>
    <br>
    <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah user ini?')" name="ubah">Ubah</button><br>
    </form>

<!-- data yang diubah saat tombol "Ubah" ditekan. Jika tombol "Ubah" ditekan, maka data yang diinput pada form 
akan disimpan dalam variabel $username, $email, $password, $telepon, dan $alamat. Selanjutnya, dilakukan query 
UPDATE untuk mengubah data pengguna dengan menggunakan id yang diterima. -->
<?php 
if (isset($_POST['ubah'])) 
{
    $username  = $_POST['username'];
    $email  = $_POST['email'];
    $password  = $_POST['pass'];
    $telepon  = $_POST['telepon'];
    $alamat  = $_POST['alamat'];
	$koneksi->query("UPDATE user SET username='$username', email='$email', password='$password', telepon='$telepon', alamat='$alamat' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>User Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=datauser.php'>";
}
 ?>
</div>
</body>
</html>