<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['user']))
{
  echo"<script>alert('anda harus login')</script>";
  echo"<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aplikasi</title>
    <?php include '../component.php' ?>
</head>
<body>
    <?php include 'headerkelolasuperadmin.php'?>
    <!-- php include 'headersuperadmin.php'?> -->
    <br><br>
    <h1><center>Kelola Aplikasi Super Admin</center></h1>
    <br><br>
    <div class="buton">
        <div align="center" class="container">
         <div class="row justify-content-between">
            <div class="col-2">
                <a href="dataadmin.php" class="btn btn-primary btn-lg">Data Admin</a>
            </div>
            <div class="col-2">
                <a href="datauser.php" class="btn btn-primary btn-lg">Data User</a>
            </div>
            <div class="col-3">
                <a href="riwayatadmin.php" class="btn btn-primary btn-lg">Riwayat Pembelian</a>
            </div>
            <div class="col-2">
                <a href="pembayaran.php" class="btn btn-primary btn-lg">Pembayaran</a>
            </div>
            <div class="col-2">
                <a href="view.php?cari=1" class="btn btn-primary btn-lg">Kelola Data</a>
            </div>
            <div class="col-2 mt-5">
                <a href="datacarousel.php" class="btn btn-primary btn-lg">Carousel</a>
            </div>
            <div class="col-2 mt-5">
                <a href="datafaq.php" class="btn btn-primary btn-lg">FAQ</a>
            </div>
         </div>
        </div><br><br>
    </div>       
</body>
</html>