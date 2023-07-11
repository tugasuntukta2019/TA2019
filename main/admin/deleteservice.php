<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data services berdasarkan id yang diterima dari parameter $_GET['id'].
$ambil = $koneksi->query("SELECT * FROM services WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// Mengambil nama file foto services dari hasil query.
$fotoproduk =$pecah['foto'];
// Melakukan pengecekan apakah file foto services tersebut ada di direktori ../asets/services/ menggunakan fungsi file_exists(). Jika file tersebut ada, maka dilakukan penghapusan file menggunakan fungsi unlink().
if (file_exists("../asets/services$fotoproduk"))
{
	unlink("../asets/services/$foto");
}
// query DELETE untuk menghapus data services dari database berdasarkan id yang diterima dari parameter $_GET['id'].
$koneksi->query("DELETE FROM services WHERE id='$_GET[id]'");

;
 ?>
<script>alert('Service telah terhapus di database anda');</script>
<script>location='view.php?cari=1';</script>

