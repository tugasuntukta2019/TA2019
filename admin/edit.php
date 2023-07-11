<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<?php include 'headeradmin.php' ?>
<br><h2><center>Ubah Produk<center></h2><br><br>
<!-- query SELECT untuk mengambil informasi produk mobil berdasarkan id mobil yang diterima. Data tersebut 
disimpan dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi produk tersebut 
seperti nama dan harga akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM mobil WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post">
    <div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama']; ?>">
	</div>

	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number"class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
	</div>
    <br>
    <button class="btn btn-primary" name="ubah">Edit</button><br>
    </form>
<?php 
// Data yang diubah saat tombol "Edit" ditekan. Jika tombol "Edit" ditekan, maka data yang diinput pada form 
// akan disimpan dalam variabel $nama dan $harga. Selanjutnya, dilakukan query UPDATE untuk mengubah data 
// produk mobil dengan menggunakan id mobil yang diterima.
if (isset($_POST['ubah'])) 
{
    $nama  = $_POST['nama'];
    $harga  = $_POST['harga'];
	$koneksi->query("UPDATE mobil SET nama='$nama',harga='$harga' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Produk Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php'>";
}
 ?>
</div>
</body>
</html>