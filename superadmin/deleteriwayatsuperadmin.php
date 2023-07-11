<?php 
include '../koneksi.php';
// parameter id yang diterima melalui URL disimpan dalam variabel $patokan. Parameter ini digunakan sebagai patokan ID pembelian yang ingin dihapus.
$patokan = $_GET['id'];

// query SQL dieksekusi untuk mengambil data pembelian dan detail pembelian dengan menggunakan JOIN antara tabel pembelian dan detail_pembelian. 
// Data yang diambil adalah data yang memiliki ID pembelian yang sama dengan $patokan.
$ambil = $koneksi->query("SELECT * FROM pembelian join detail_pembelian 
        on pembelian.id=detail_pembelian.id_pembelian WHERE pembelian.id=$patokan");

// query yang diperoleh disimpan dalam variabel $pecah menggunakan fungsi fetch_assoc(). Variabel ini akan berisi array asosiatif dengan data pembelian dan detail pembelian yang diambil dari database.
$pecah = $ambil->fetch_assoc();

// query SQL untuk menghapus data pembelian dari tabel pembelian dengan menggunakan ID pembelian yang sama dengan $patokan.
$koneksi->query("DELETE FROM pembelian WHERE id=$patokan");

// query SQL untuk menghapus data detail pembelian dari tabel detail_pembelian dengan menggunakan ID pembelian yang sama dengan $patokan.
$koneksi->query("DELETE FROM detail_pembelian WHERE id_pembelian=$patokan");
 ?>
<script>alert('Riwayat Pembelian Telah Terhapus Di Database Anda !');</script>
<script>location='riwayatsuperadmin.php';</script>