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
    <title>services</title>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <br>
        <div class="services">
            <div align="center">
                <h1>Service</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
        <!-- Membuat konten utama halaman yang berisi daftar layanan service. Terdapat loop while untuk mengambil data dari tabel services dengan kategori 1. Setiap data akan ditampilkan dalam kolom dengan menggunakan Bootstrap grid system. Gambar, nama jenis service, kategori service, dan tombol "Booking" akan ditampilkan untuk setiap layanan. -->
            <?php 
            $ambil = $koneksi->query("SELECT * FROM services WHERE kategori = 1"); 
            while ($perproduk = $ambil->fetch_assoc()) { 
            ?>
            <div class="col-md-3">    
                <div class="thumbnail">
                    <img src="asets/services/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
                    <div class="caption">
                    <h6>Jenis Service: <?php echo $perproduk['nama']; ?></h6>
                    <h6>Kategori Service: <?php echo $perproduk['kategori_services']; ?></h4>
                    <a href="https://wa.me/0895365253632" class="btn btn-primary">Reserve</a>
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
