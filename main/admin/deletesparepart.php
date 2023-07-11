<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data sparepart berdasarkan id yang diterima dari parameter $_GET['id'].
$ambil = $koneksi->query("SELECT * FROM sparepart WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// Mengambil nama file foto sparepart dari hasil query.
$fotoproduk =$pecah['foto'];
// Melakukan pengecekan apakah file foto sparepart tersebut ada di direktori ../asets/sparepart/ menggunakan fungsi file_exists(). Jika file tersebut ada, maka dilakukan penghapusan file menggunakan fungsi unlink().
if (file_exists("../asets/sparepart$fotoproduk"))
{
	unlink("../asets/sparepart/$foto");
}
// query DELETE untuk menghapus data sparepart dari database berdasarkan id yang diterima dari parameter $_GET['id'].
$koneksi->query("DELETE FROM sparepart WHERE id='$_GET[id]'");

;
 ?>
<script>alert('Sparepart telah terhapus di database anda');</script>
<script>location='view.php?cari=2';</script>

