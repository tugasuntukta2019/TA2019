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
    <title>Pembayaran</title>
    <?php include '../koneksi.php' ?>
    <?php include '../component.php' ?>
</head>
<body>
<?php include 'headeradmin.php' ?>
<div class="container">
    <br><h1><center>Pembayaran</center></h1><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <!-- query $koneksi->query("SELECT * FROM metode_pembayaran") untuk mengambil data metode pembayaran 
        dari tabel metode_pembayaran. Melakukan perulangan while untuk menampilkan setiap baris data pada tabel. 
        Pada setiap baris, ditampilkan nomor, nama metode pembayaran, dan tombol aksi "Hapus" dan "Ubah" yang 
        mengarahkan ke halaman terkait ( "Hapus" / "Ubah") dengan menggunakan parameter id. Pada setiap perulangan, variabel $nomor 
        diincrement menggunakan $nomor++ untuk menampilkan nomor urut pada setiap baris. -->
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM metode_pembayaran"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama']; ?></td>
                <td>
                    <a href="deletepembayaran.php?id=<?php echo $pecah['id'] ?>"  class="btn-danger btn">Hapus</a>
                    <a href="editpembayaran.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
    <a href="addpembayaran.php" class="btn btn-primary">Tambah Metode Pembayaran</a><br><br>
</div>
</body>
</html>