<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data mobil berdasarkan id yang diterima dari parameter $_GET['id'].
$ambil = $koneksi->query("SELECT * FROM mobil WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// Mengambil nama file foto mobil dari hasil query.
$fotoproduk =$pecah['foto'];
// Melakukan pengecekan apakah file foto mobil tersebut ada di direktori ../asets/mobil/ menggunakan fungsi file_exists(). Jika file tersebut ada, maka dilakukan penghapusan file menggunakan fungsi unlink().
if (file_exists("../asets/mobil$fotoproduk"))
{
	unlink("../asets/mobil/$foto");
}
// query DELETE untuk menghapus data mobil dari database berdasarkan id yang diterima dari parameter $_GET['id'].
$koneksi->query("DELETE FROM mobil WHERE id='$_GET[id]'");

;
 ?>
<script>alert('Mobil telah terhapus di database anda');</script>
<script>location='view.php?cari=3';</script>

