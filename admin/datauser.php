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
    <title>Data User</title>
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
    <br><h1><center>Data User</center></h1><br>
    <div class="table-responsive">
        <table class="table table-bordered responsive-table">
            <thead>
                <tr> 
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Nomor telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM user where tipe=1"); ?>
                <?php while ($pecah = $ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['username']; ?></td>
                        <td><?php echo $pecah['password']; ?></td>
                        <td><?php echo $pecah['email']; ?></td>
                        <td><?php echo $pecah['telepon']; ?></td>
                        <td><?php echo $pecah['alamat']; ?></td>
                        <td>
                            <!-- Tambahkan konfirmasi "Yes" atau "No" menggunakan JavaScript -->
                            <a href="deleteuser.php?id=<?php echo $pecah['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="btn btn-danger">Hapus</a>
                            <a href="edituser.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <a href="adduser.php" class="btn btn-primary">Tambah User Manual</a>
</div>
<script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
