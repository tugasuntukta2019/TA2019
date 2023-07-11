<?php include 'koneksi.php';
session_start();
$user=$_SESSION["user"]['id'] ?>
<?php $ambil=$koneksi->query("SELECT * FROM keranjang WHERE id_user='$user' "); ?>
<?php while($perproduk=$ambil->fetch_assoc()){ ?>
<?php
echo "<pre>";
print_r($perproduk);
print_r($_SESSION);
$id=$_SESSION["user"]['id'];
$mobil=$perproduk["id_mobil"];
echo $mobil=+1;
echo "</pre>";

$mysqli  = "INSERT INTO keranjang (id,id_user,id_mobil,jumlah) VALUES ('$username','$email','$onepass')";
$result  = mysqli_query($koneksi, $mysqli);
if ($result) {
echo "<div class='alert alert-info'>Pembuatan Email Berhasil</div>";
echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                        }
?>
<?php } ?>