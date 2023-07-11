<?php 
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) 
{
  echo "<script>alert('Anda harus login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sparepart</title>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <br>
        <div class="sparepart">
            <div align="center">
                <h1>Sparepart</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
        <!-- Membuat konten utama halaman yang berisi daftar sparepart. Terdapat loop while untuk mengambil data dari tabel sparepart dengan kategori 2 dan stok lebih dari 0. Setiap data akan ditampilkan dalam kolom dengan menggunakan Bootstrap grid system. Gambar sparepart, nama sparepart, dan stok sparepart akan ditampilkan untuk setiap sparepart. -->
            <?php 
            $ambil = $koneksi->query("SELECT * FROM sparepart WHERE kategori = 2 AND stok > 0"); 
            while ($perproduk = $ambil->fetch_assoc()) { 
            ?>
            <div class="col-md-3">    
                <div class="thumbnail">
                    <img src="asets/sparepart/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
                    <div class="caption">
                        <h4>Nama: <?php echo $perproduk['nama']; ?></h4>
                        <h4>Stok: <?php echo $perproduk['stok']; ?></h4>
                    </div>
                </div>
                <br>
            </div>
            <?php } ?>
        </div>
    </div>
    <br><br>
    <?php include 'footer.php'; ?>
    <script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
