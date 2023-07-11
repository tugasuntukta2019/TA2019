<?php 
include 'koneksi.php';
// mengambil nilai parameter id dari URL menggunakan $_GET['id'] dan menyimpannya ke variabel $patokan.
$patokan = $_GET['id'];
// Query SQL SELECT * FROM pembelian join detail_pembelian on pembelian.id=detail_pembelian.id_pembelian WHERE pembelian.id=$patokan 
// digunakan untuk mengambil data pembelian dan detail pembelian yang memiliki id yang sesuai dengan nilai $patokan. Hasil query disimpan dalam variabel $ambil.
$ambil = $koneksi->query("SELECT * FROM pembelian join detail_pembelian 
        on pembelian.id=detail_pembelian.id_pembelian WHERE pembelian.id=$patokan");

// Mengambil data hasil query menggunakan $ambil->fetch_assoc() dan menyimpannya dalam variabel $pecah. Namun, dalam kodingan tersebut, variabel $pecah tidak digunakan lebih lanjut.
$pecah = $ambil->fetch_assoc();
// Query SQL DELETE FROM pembelian WHERE id=$patokan digunakan untuk menghapus data pembelian dengan id yang sesuai dengan nilai $patokan.
$koneksi->query("DELETE FROM pembelian WHERE id=$patokan");
// Query SQL DELETE FROM detail_pembelian WHERE id_pembelian=$patokan digunakan untuk menghapus data detail pembelian yang memiliki id_pembelian yang sesuai dengan nilai $patokan.
$koneksi->query("DELETE FROM detail_pembelian WHERE id_pembelian=$patokan");
 ?>
 <!-- menampilkan pesan alert yang memberi tahu pengguna bahwa riwayat pesanan telah terhapus dari database. -->
<script>alert('Riwayat Pesanan Telah Terhapus Di Database Anda !');</script>
<!-- pengguna ke halaman note.php setelah riwayat pesanan dihapus. -->
<script>location='note.php';</script>