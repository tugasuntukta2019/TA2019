<?php 
include '../koneksi.php';
// query SQL dieksekusi untuk mengambil data mobil dengan ID tertentu dari tabel mobil. ID mobil yang diambil berasal dari parameter yang diterima melalui URL $_GET[id].
$ambil = $koneksi->query("SELECT * FROM mobil WHERE id='$_GET[id]'");

// query yang diperoleh disimpan dalam variabel $pecah menggunakan fungsi fetch_assoc(). 
// Variabel ini akan berisi array asosiatif dengan data mobil yang diambil dari database.
$pecah = $ambil->fetch_assoc();
// file gambar mobil tersebut ada di direktori ../asets/mobil/ dengan menggunakan fungsi file_exists(). 
// Jika file gambar tersebut ada, maka dilakukan penghapusan file tersebut dengan fungsi unlink().
$fotoproduk =$pecah['foto'];
if (file_exists("../asets/mobil$fotoproduk"))
{
	unlink("../asets/mobil/$foto");
}
// query SQL untuk menghapus data mobil dari tabel mobil dengan menggunakan ID tertentu yang diperoleh dari URL.
$koneksi->query("DELETE FROM mobil WHERE id='$_GET[id]'");

;
 ?>
<script>alert('Produk Telah Terhapus Di Database Anda !');</script>
<script>location='view.php?cari=3';</script>

