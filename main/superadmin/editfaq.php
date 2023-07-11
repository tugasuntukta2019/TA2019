<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ</title>
</head>
<body>
<?php include 'headersuperadmin.php' ?>
<br><h2><center>Ubah FAQ<center></h2><br><br>
<!-- query SELECT untuk mengambil informasi faq berdasarkan id yang diterima. Data tersebut 
disimpan dalam variabel $ambil dan dipecah menjadi array menggunakan fetch_assoc(). Informasi faq seperti 
foto, judul, dan deskripsi akan ditampilkan dalam input form untuk diedit. -->
<?php 
$ambil=$koneksi->query("SELECT * FROM faq WHERE id='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();  
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Pertanyaan</label>
            <input type="text" class="form-control" name="pertanyaan" value="<?php echo $pecah['pertanyaan']; ?>">
        </div>
        <div class="form-group">
            <label>Jawaban</label>
            <input type="text" class="form-control" name="jawaban" value="<?php echo $pecah['jawaban']; ?>">
        </div>
        <br>
        <button class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah FAQ ini?')" name="ubah">Ubah</button><br>
    </form>

    <!-- data yang diubah saat tombol "Ubah" ditekan. Jika tombol "Ubah" ditekan, maka data yang diinput pada form 
    akan disimpan dalam variabel $foto, $judul, dan $deskripsi. Selanjutnya, dilakukan query UPDATE untuk mengubah data 
    faq dengan menggunakan id yang diterima. -->
    <?php 
    if (isset($_POST['ubah'])) 
    {

        $pertanyaan = $_POST['pertanyaan'];
        $jawaban = $_POST['jawaban'];

        $koneksi->query("UPDATE faq SET pertanyaan='$pertanyaan', jawaban='$jawaban' WHERE id='$_GET[id]'");

        echo "<div class='alert alert-info'>FAQ Telah Diubah</div>";
        echo "<meta http-equiv='refresh' content='1;url=datafaq.php'>";
    }
    ?>
</div>
</body>
</html>