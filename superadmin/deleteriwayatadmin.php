<?php 
include '../koneksi.php';
// Mengambil nilai id pembelian dari parameter $_GET['id'] dan menyimpannya dalam variabel $patokan.
$patokan = $_GET['id'];
// query SELECT untuk mengambil data pembelian dan detail pembelian yang sesuai dengan id pembelian yang diterima. Data tersebut disimpan dalam variabel $ambil.
$ambil = $koneksi->query("SELECT * FROM pembelian join detail_pembelian 
        on pembelian.id=detail_pembelian.id_pembelian WHERE pembelian.id=$patokan");
// Mengambil data hasil query dalam bentuk array menggunakan metode fetch_assoc() dan menyimpannya dalam variabel $pecah.
$pecah = $ambil->fetch_assoc();
// query DELETE untuk menghapus data pembelian dari tabel pembelian berdasarkan id pembelian yang diterima.
$koneksi->query("DELETE FROM pembelian WHERE id=$patokan");
// query DELETE untuk menghapus data detail pembelian dari tabel detail_pembelian berdasarkan id pembelian yang diterima.
$koneksi->query("DELETE FROM detail_pembelian WHERE id_pembelian=$patokan");
 ?>
<script>alert('Riwayat Pembelian Telah Terhapus Di Database Anda !');</script>
<script>location='riwayatadmin.php';</script>