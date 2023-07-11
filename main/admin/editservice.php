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
<!-- query SELECT untuk mengambil informasi produk/service berdasarkan id yang diterima. Data tersebut disimpan 
dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi produk/service seperti 
nama, kategori, dan harga akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM services WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label>Foto Service</label><br>
            <img src="../asets/services/<?php echo $pecah['foto'] ?>" width="100"><br>
            <input type="hidden" name="foto_lama" value="<?php echo $pecah['foto']; ?>">
        </div>
        <div class="form-group">
            <label>Upload Foto Baru</label>
            <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama']; ?>">
	</div>
    <div class="form-group">
		<label>Kategori Service</label>
        <select class="form-control" name="kategori_services" value="<?php echo $pecah['kategori_services']; ?>">
			<option selected disabled>Kategori Service</option>
			<option value="service ringan">Service Ringan</option>
			<option value="service berat">Service Berat</option>
		</select>
	</div>

	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number"class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
	</div>
    
    <br>
    <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah service ini?')" name="ubah">Edit</button><br>
    </form>

<!-- data yang diubah saat tombol "Edit" ditekan. Jika tombol "Edit" ditekan, maka data yang diinput pada form 
akan disimpan dalam variabel $nama, $kategori_services, dan $harga. Selanjutnya, dilakukan query UPDATE untuk 
mengubah data produk/service dengan menggunakan id yang diterima. -->
<?php 
if (isset($_POST['ubah'])) 
{
    $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];

        $foto_lama = $_POST['foto_lama'];

        if (!empty($foto)) {
            move_uploaded_file($lokasi, "../asets/services/".$foto);
            unlink("../asets/services/".$foto_lama);
        } else {
            $foto = $foto_lama;
        }
    $nama  = $_POST['nama'];
    $kategori_services  = $_POST['kategori_services'];
    $harga  = $_POST['harga'];
	$koneksi->query("UPDATE services SET nama='$nama', kategori_services='$kategori_services', harga='$harga', foto='$foto' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Service Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=1'>";
}
 ?>
</div>
</body>
</html>