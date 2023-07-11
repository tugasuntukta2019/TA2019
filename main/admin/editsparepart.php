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
<!-- query SELECT untuk mengambil informasi sparepart berdasarkan id yang diterima. Data tersebut disimpan 
dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi sparepart seperti 
nama, harga, dan stok akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM sparepart WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label>Foto Sparepart</label><br>
            <img src="../asets/sparepart/<?php echo $pecah['foto'] ?>" width="100"><br>
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
		<label>Harga (Rp)</label>
		<input type="number"class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
	</div>

    <div class="form-group">
		<label>Stok</label>
		<input type="number"class="form-control" name="stok" value="<?php echo $pecah['stok']; ?>">
	</div>
    
    <br>
    <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah sparepart ini?')" name="ubah">Edit</button><br>
    </form>

<!-- data yang diubah saat tombol "Edit" ditekan. Jika tombol "Edit" ditekan, maka data yang diinput pada form 
akan disimpan dalam variabel $nama, $harga, dan $stok. Selanjutnya, dilakukan query UPDATE untuk mengubah data 
sparepart dengan menggunakan id yang diterima. -->
<?php 
if (isset($_POST['ubah'])) 
{
    $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];

        $foto_lama = $_POST['foto_lama'];

        if (!empty($foto)) {
            move_uploaded_file($lokasi, "../asets/sparepart/".$foto);
            unlink("../asets/sparepart/".$foto_lama);
        } else {
            $foto = $foto_lama;
        }
    $nama  = $_POST['nama'];
    $harga  = $_POST['harga'];
    $stok  = $_POST['stok'];
	$koneksi->query("UPDATE sparepart SET nama='$nama', harga='$harga', stok='$stok', foto='$foto' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Sparepart Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=2'>";
}
 ?>
</div>
</body>
</html>