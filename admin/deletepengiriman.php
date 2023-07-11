<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data pengiriman berdasarkan id yang diterima dari parameter $_GET['id'].
$ambil = $koneksi->query("SELECT * FROM pengiriman WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// query DELETE untuk menghapus data pengiriman dari database berdasarkan id yang diterima dari parameter $_GET['id'].
$koneksi->query("DELETE FROM pengiriman WHERE id='$_GET[id]'");
 ?>
<script>alert('Pengiriman Telah Terhapus Di Database Anda !');</script>
<script>location='pengiriman.php';</script>

