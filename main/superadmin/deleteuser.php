<?php 
include '../koneksi.php';
// query SELECT untuk mengambil data user yang sesuai dengan id user yang diterima. Data tersebut disimpan dalam variabel $ambil.
$ambil = $koneksi->query("SELECT * FROM user WHERE id='$_GET[id]'");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// query DELETE untuk menghapus data user dari tabel user berdasarkan id user yang diterima.
$koneksi->query("DELETE FROM user WHERE id='$_GET[id]'");
 ?>
<script>alert('User Telah Terhapus Di Database Anda');</script>
<script>location='datauser.php';</script>