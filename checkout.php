<!-- memulai sesi pengguna dan mengatur laporan kesalahan menjadi 0 atau tidak menampilkan pesan kesalahan. -->
<?php
session_start();
error_reporting(0);
// Variabel $id diinisialisasi dengan nilai dari $_SESSION["user"]['id']. Variabel ini digunakan untuk mengidentifikasi pengguna yang sedang aktif.
$id = $_SESSION["user"]['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <!-- Import file koneksi.php yang digunakan untuk menghubungkan halaman dengan database. 
    File ini mungkin berisi kode untuk koneksi ke database dan inisialisasi objek $koneksi yang digunakan 
    untuk menjalankan query. -->
    <?php include 'koneksi.php' ?>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Import file header.php yang mungkin berisi kode untuk menampilkan header halaman. -->
<?php include 'header.php' ?>
<div class="container">
    <h4>Checkout</h4>
    <table class="table table_bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nomor = 1;
        $totalbelanja = 0; // Inisialisasi variabel totalbelanja
        ?>
        <!-- menampilkan daftar barang yang ada dalam keranjang pengguna. Query yang digunakan adalah 
        SELECT * FROM keranjang JOIN mobil ON keranjang.id_mobil=mobil.id WHERE id_user='$id'. 
        Data tersebut ditampilkan dalam bentuk tabel dengan menggunakan tag HTML <table>. -->
        <?php $ambil = $koneksi->query("SELECT * FROM keranjang JOIN mobil ON keranjang.id_mobil=mobil.id WHERE id_user='$id'"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama']; ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td><?php echo number_format($pecah['harga']); ?></td>
                <?php
                $total = $pecah["jumlah"] * $pecah['harga'];
                ?>
                <td><?php echo number_format($total); ?></td>
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja += $total; ?>
        <?php } ?>
        </tbody>
        <tfoot>
        <!-- menampilkan total belanja pengguna dengan menjumlahkan harga total setiap barang dalam keranjang. 
        Variabel $totalbelanja digunakan untuk menyimpan total belanja. -->
        <th colspan="4">Total Belanja</th>
        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
        </tfoot>

    </table>
    <form method="post" action="proses_checkout.php">
        <div class="row">
            <!-- Informasi pengguna -->
        </div>
        <br>
        <div class="form-group">
            <label>Metode Pembayaran :</label>
            <select class="form-control" name="pembayaran" id="combo1">
                <option value="">Pilih Metode Pembayaran</option>
                <!-- menampilkan form checkout yang berisi metode pembayaran, pengiriman, dan alamat pengiriman. 
                Pilihan metode pembayaran dan pengiriman diambil dari database menggunakan query SQL. 
                Informasi pengguna seperti alamat pengiriman juga ditampilkan dalam form ini. -->
                <?php
                $query = "SELECT * FROM metode_pembayaran ORDER BY nama ASC";
                $dewan1 = $koneksi->prepare($query);
                $dewan1->execute();
                $res1 = $dewan1->get_result();
                while ($row = $res1->fetch_assoc()) {
                    echo "<option value='" . $row['nama'] . "'>" . $row['nama'] . "</option>";
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label>Pengiriman :</label>
            <select class="form-control" name="pengiriman" id="combo2">
                <option value="">Pilih Pengiriman</option>
                <?php
                $query = "SELECT * FROM pengiriman ORDER BY nama ASC";
                $dewan1 = $koneksi->prepare($query);
                $dewan1->execute();
                $res1 = $dewan1->get_result();
                while ($row = $res1->fetch_assoc()) {
                    echo "<option value='" . $row['nama'] . "'>" . $row['nama'] . "</option>";
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label>Alamat Pengiriman :</label>
            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Pengiriman" required><?php echo $_SESSION["user"]["alamat"] ?></textarea>
        </div>
        <br>
        <!-- Setelah pengguna mengisi form checkout dan menekan tombol "Checkout", data akan dikirim ke halaman proses_checkout.php untuk diproses lebih lanjut. -->
        <button class="btn btn-primary" type="submit" name="checkout">Checkout</button>
    </form>
</div>
<!-- Import file footer.php yang mungkin berisi kode untuk menampilkan footer halaman. -->
<?php include 'footer.php'?>
<!-- Bootstrap untuk memastikan tampilan halaman yang konsisten dari bootstrap tersebut. -->
<script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
