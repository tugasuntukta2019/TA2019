<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data metode pembayaran berdasarkan id yang diterima dari parameter $_GET['id'].
$ambil = $koneksi->query("SELECT * FROM metode_pembayaran WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// query DELETE untuk menghapus data metode pembayaran dari database berdasarkan id yang diterima dari parameter $_GET['id'].
$koneksi->query("DELETE FROM metode_pembayaran WHERE id='$_GET[id]'");
 ?>
<script>alert('Metode Pembayaran Telah Terhapus Di Database Anda !');</script>
<script>location='pembayaran.php';</script>

