<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['user']))
{
  echo"<script>alert('Anda harus login')</script>";
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
    <title>FAQ</title>
    <?php include '../koneksi.php' ?>
    <?php include '../component.php' ?>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media (max-width: 767px) {
            table.responsive-table {
                display: block;
                width: 100%;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
<?php include 'headeradmin.php' ?>
<div class="container">
    <br><h1><center>FAQ</center></h1><br>
    <div class="table-responsive">
        <table class="table table-bordered responsive-table">
            <thead>
                <tr> 
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM faq"); ?>
                <?php while ($pecah = $ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['pertanyaan']; ?></td>
                        <td><?php echo $pecah['jawaban']; ?></td>
                        <td>
                            <a href="editfaq.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
