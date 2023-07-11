<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Ubah Admin<center></h2><br><br>
<?php 
// Query SQL ini akan mengambil data produk dari tabel "user" berdasarkan ID yang diperoleh dari parameter id. Hasil query akan disimpan dalam variabel $ambil.
$ambil=$koneksi->query("SELECT * FROM user WHERE id='$_GET[id]' ");

// mengambil hasil query yang disimpan dalam variabel $ambil dan menyimpannya dalam array $pecah. Array ini akan berisi informasi admin yang akan diedit.
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <!-- <form action="" method="post"> Ini adalah formulir untuk mengirimkan data yang diubah. Metode post digunakan untuk mengirimkan data ke halaman itu sendiri. -->
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
	<!-- name="ubah" tombol untuk mengirimkan perubahan data produk yang telah diedit. -->
    <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah user ini?')" name="ubah">Ubah</button><br>
    </form>
<?php 
//  dieksekusi ketika tombol "Edit" ditekan. Kode di dalamnya akan mengambil nilai yang diinputkan oleh pengguna 
// untuk nama dan harga produk, kemudian melakukan query untuk mengubah data admin dalam database berdasarkan 
// ID yang diperoleh dari parameter id.
if (isset($_POST['ubah'])) 
{
    $username  = $_POST['username'];
    $email  = $_POST['email'];
    $password  = $_POST['pass'];
    $telepon  = $_POST['telepon'];
    $alamat  = $_POST['alamat'];
	$koneksi->query("UPDATE user SET username='$username', email='$email', password='$password', telepon='$telepon', alamat='$alamat' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Admin Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=dataadmin.php'>";
}
 ?>
</div>
</body>
</html>