<?php
//  fungsi session_start() yang digunakan untuk memulai sesi PHP.
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
    <title>Data Admin</title>
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
<?php include 'headersuperadmin.php' ?>
<div class="container">
    <br><h1><center>Data Admin</center></h1><br>
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
                <!-- Data admin diambil dari database dengan menggunakan query SQL yang mengambil data dari tabel user dengan tipe admin yang setara dengan 2. -->
                <?php $ambil = $koneksi->query("SELECT * FROM user where tipe=2"); ?>
                <!-- while yang akan diulang selama terdapat data yang diambil dari query $ambil->fetch_assoc(). Setiap baris data akan diambil dan disimpan dalam variabel $pecah. -->
                <?php while ($pecah = $ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['username']; ?></td>
                        <td><?php echo $pecah['password']; ?></td>
                        <td><?php echo $pecah['email']; ?></td>
                        <td><?php echo $pecah['telepon']; ?></td>
                        <td><?php echo $pecah['alamat']; ?></td>
                        <td>
                        <!-- Hapus" dan "Edit". Tautan ini akan mengarahkan ke halaman deleteadmin.php dan 
                        editadmin.php dengan mengirimkan parameter id yang bernilai $pecah['id']. 
                        parameter id dapat digunakan untuk menghapus atau mengedit data admin. -->
                            <a href="deleteadmin.php?id=<?php echo $pecah['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')" class="btn btn-danger">Hapus</a>
                            <a href="editadmin.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- "Tambah Admin Manual" yang mengarahkan ke halaman addadmin.php untuk menambahkan admin baru secara manual. -->
    <a href="addadmin.php" class="btn btn-primary">Tambah Admin Manual</a>
</div>
<script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
