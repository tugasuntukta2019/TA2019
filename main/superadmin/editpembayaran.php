<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Ubah Metode Pembayaran<center></h2><br><br>
<?php 
// Query SQL ini akan mengambil data produk dari tabel "metode_pembayaran" berdasarkan ID yang diperoleh dari parameter id. Hasil query akan disimpan dalam variabel $ambil.
$ambil=$koneksi->query("SELECT * FROM metode_pembayaran WHERE id='$_GET[id]'");

// mengambil hasil query yang disimpan dalam variabel $ambil dan menyimpannya dalam array $pecah. Array ini akan berisi informasi metode yang akan diedit.
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <!-- <form action="" method="post"> Ini adalah formulir untuk mengirimkan data yang diubah. Metode post digunakan untuk mengirimkan data ke halaman itu sendiri. -->
    <form action="" method="post">
    <div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama']; ?>">
	</div>
    <br>
    <!-- name="ubah" tombol untuk mengirimkan perubahan data produk yang telah diedit. -->
    <button class="btn btn-primary" name="ubah">Edit</button><br>
    </form>
<?php 
// dieksekusi ketika tombol "Edit" ditekan. Kode di dalamnya akan mengambil nilai yang diinputkan oleh pengguna 
// untuk nama kemudian melakukan query untuk mengubah data metode pembayaran dalam database berdasarkan ID yang diperoleh dari parameter id
if (isset($_POST['ubah'])) 
{
    $nama  = $_POST['nama'];
	$koneksi->query("UPDATE metode_pembayaran SET nama='$nama' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Pengiriman Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=pembayaran.php'>";
}
 ?>
</div>
</body>
</html>