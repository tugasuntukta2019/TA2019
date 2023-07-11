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
disimpan dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi produk seperti 
nama, merk, harga, cc, tipe BBM, tahun, jarak tempuh, dan kondisi akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM mobil WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
	<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label>Foto Mobil</label><br>
            <img src="../asets/mobil/<?php echo $pecah['foto'] ?>" width="100"><br>
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
		<label>Merk</label>
		<input type="text" class="form-control" name="merk" value="<?php echo $pecah['merk']; ?>">
	</div>

	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number"class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
	</div>

    <div class="form-group">
		<label>CC</label>
		<input type="number"class="form-control" name="cc" value="<?php echo $pecah['cc']; ?>">
	</div>

    <div class="form-group">
		<label>Tipe BBM</label>
		<input type="text" class="form-control" name="tipe_bbm" value="<?php echo $pecah['tipe_bbm']; ?>">
	</div>

    <div class="form-group">
		<label>Tahun</label>
		<input type="number"class="form-control" name="tahun" value="<?php echo $pecah['tahun']; ?>">
	</div>

    <div class="form-group">
		<label>Jarak Tempuh</label>
		<input type="number"class="form-control" name="jarak_tempuh" value="<?php echo $pecah['jarak_tempuh']; ?>">
	</div>

    <div class="form-group">
		<label>Kondisi</label>
		<select class="form-control" name="kondisi" value="<?php echo $pecah['kondisi']; ?>">
        <option selected disabled>Kondisi</option>
        <option value="baru">Baru</option>
        <option value="bekas">Bekas</option>
      </select>
	</div>
    
    <br>
    <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah mobil ini?')" name="ubah">Edit</button><br>
    </form>

	<!-- data yang diubah saat tombol "Edit" ditekan. Jika tombol "Edit" ditekan, maka data yang diinput pada 
	form akan disimpan dalam variabel sesuai dengan nama input form yang bersesuaian. Selanjutnya, dilakukan 
	query UPDATE untuk mengubah data produk mobil dengan menggunakan id mobil yang diterima -->
<?php 
if (isset($_POST['ubah'])) 
{
	$foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];

        $foto_lama = $_POST['foto_lama'];

        if (!empty($foto)) {
            move_uploaded_file($lokasi, "../asets/mobil/".$foto);
            unlink("../asets/mobil/".$foto_lama);
        } else {
            $foto = $foto_lama;
        }
    $nama  = $_POST['nama'];
    $merk  = $_POST['merk'];
    $harga  = $_POST['harga'];
    $cc  = $_POST['cc'];
    $tipe_bbm  = $_POST['tipe_bbm'];
    $tahun  = $_POST['tahun'];
    $jarak_tempuh  = $_POST['jarak_tempuh'];
    $kondisi  = $_POST['kondisi'];
	$koneksi->query("UPDATE mobil SET nama='$nama', merk='$merk', harga='$harga', cc='$cc', tipe_bbm='$tipe_bbm', tahun='$tahun', jarak_tempuh='$jarak_tempuh', kondisi='$kondisi', foto='$foto' WHERE id='$_GET[id]'");

    echo "<div class='alert alert-info'>Mobil Telah Diubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=3'>";
}
 ?>
</div>
</body>
</html>