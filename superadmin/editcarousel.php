<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Carousel</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Ubah Carousel<center></h2><br><br>
<!-- query SELECT untuk mengambil informasi carousel berdasarkan id yang diterima. Data tersebut 
disimpan dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi carousel seperti 
foto, judul, dan deskripsi akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM carousel WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Foto Carousel</label><br>
            <img src="../asets/carousel/<?php echo $pecah['foto'] ?>" width="100"><br>
            <input type="hidden" name="foto_lama" value="<?php echo $pecah['foto']; ?>">
        </div>
        <div class="form-group">
            <label>Upload Foto Baru</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" name="judul" value="<?php echo $pecah['judul']; ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" value="<?php echo $pecah['deskripsi']; ?>">
        </div>
        <br>
        <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah carousel ini?')" name="ubah">Ubah</button><br>
    </form>

    <!-- data yang diubah saat tombol "Ubah" ditekan. Jika tombol "Ubah" ditekan, maka data yang diinput pada form 
    akan disimpan dalam variabel $foto, $judul, dan $deskripsi. Selanjutnya, dilakukan query UPDATE untuk mengubah data 
    carousel dengan menggunakan id yang diterima. -->
    <?php 
    if (isset($_POST['ubah'])) 
    {
        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];

        $foto_lama = $_POST['foto_lama'];

        if (!empty($foto)) {
            move_uploaded_file($lokasi, "../asets/carousel/".$foto);
            unlink("../asets/carousel/".$foto_lama);
        } else {
            $foto = $foto_lama;
        }

        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];

        $koneksi->query("UPDATE carousel SET foto='$foto', judul='$judul', deskripsi='$deskripsi' WHERE id='$_GET[id]'");

        echo "<div class='alert alert-info'>Carousel Telah Diubah</div>";
        echo "<meta http-equiv='refresh' content='1;url=datacarousel.php'>";
    }
    ?>
</div>
</body>
</html>