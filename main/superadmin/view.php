<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Anda harus login')</script>";
  echo "<script>location='login.php';</script>";
  exit();
}
?>
<?php include '../koneksi.php' ?>
<?php include '../component.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data</title>
</head>
<body>
	<?php include 'headersuperadmin.php'?>
    <div class="container"><br>
    <h2><center>Kelola Data<center></h2><br><br>
    <a href="view.php?cari=1" class="btn btn-info">Service</a>
    <a href="view.php?cari=2" class="btn btn-info">Sparepart</a>
    <a href="view.php?cari=3" class="btn btn-info">Mobil</a>

    </form>
    <br><br>	
    <!-- jika cari adalah 1, maka akan memasukkan file "viewservice.php", jika cari adalah 2, maka akan memasukkan file "viewsparepart.php"
     jika cari adalah 3, maka akan memasukkan file "viewmobil.php"-->
    <?php
    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
        if ($cari == 1) {
            include 'viewservice.php';
        } elseif ($cari == 2) {
            include 'viewsparepart.php';
        } elseif ($cari == 3) {
            include 'viewmobil.php';
        }
    }
    ?>

    </div>
</body>
</html>
