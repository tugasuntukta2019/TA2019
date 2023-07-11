<?php 
include '../koneksi.php';
// query SQL dieksekusi untuk mengambil data admin dengan ID tertentu dari tabel user. ID admin yang diambil berasal dari parameter yang diterima melalui URL $_GET[id].
$ambil = $koneksi->query("SELECT * FROM user WHERE id='$_GET[id]'");

// query yang diperoleh disimpan dalam variabel $pecah menggunakan fungsi fetch_assoc(). Variabel ini akan berisi array asosiatif dengan data admin yang diambil dari database.
$pecah = $ambil->fetch_assoc();

// query SQL untuk menghapus data admin dari tabel user dengan menggunakan ID .
$koneksi->query("DELETE FROM user WHERE id='$_GET[id]'");
 ?>
<script>alert('Admin Telah Terhapus Di Database Anda');</script>
<script>location='dataadmin.php';</script>