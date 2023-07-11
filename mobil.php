<?php 
// Memulai session PHP dan memasukkan file koneksi.php yang digunakan untuk menghubungkan ke database.
session_start();
include 'koneksi.php';

// Mendefinisikan fungsi getMobilByJarakTempuh() yang digunakan untuk mengambil mobil berdasarkan rentang jarak tempuh. Fungsi ini menerima parameter minJarak dan maxJarak, kemudian menjalankan query untuk mengambil data mobil 
function getMobilByJarakTempuh($minJarak, $maxJarak)
{
    global $koneksi;
    $query = "SELECT * FROM mobil WHERE kategori = 3 AND stok > 0 AND jarak_tempuh BETWEEN $minJarak AND $maxJarak";
    $result = $koneksi->query($query);
    return $result;
}

// Mengecek apakah pengguna telah login. Jika pengguna belum login, maka akan ditampilkan pesan peringatan dan pengguna akan diarahkan ke halaman login.
if (!isset($_SESSION['user'])) 
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Memproses form filter jika tombol submit ditekan
// fungsi getMobilByJarakTempuh() dipanggil dengan menggunakan nilai tersebut untuk mengambil mobil yang sesuai dengan rentang jarak tempuh yang dimasukkan. 
if (isset($_GET['submit'])) {
    $minJarak = $_GET['min_jarak'];
    $maxJarak = $_GET['max_jarak'];
    $ambil = getMobilByJarakTempuh($minJarak, $maxJarak);
// Jika tombol submit tidak ditekan, maka akan ditampilkan semua mobil dengan kategori 3 (mobil yang dijual) dan stok lebih dari 0.
} else {
    $ambil = $koneksi->query("SELECT * FROM mobil WHERE kategori = 3 AND stok > 0");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil</title>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <br>
        <div class="mobil">
            <div align="center">
                <h1>Mobil</h1>
            </div>
        </div>
        <br><br>

        <!-- Form filter jarak tempuh -->
        <form method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="min_jarak">Jarak Tempuh Minimum:</label>
                    <input type="number" name="min_jarak" id="min_jarak" class="form-control" placeholder="Masukkan jarak tempuh minimum" required>
                </div>
                <div class="col-md-4">
                    <label for="max_jarak">Jarak Tempuh Maksimum:</label>
                    <input type="number" name="max_jarak" id="max_jarak" class="form-control" placeholder="Masukkan jarak tempuh maksimum" required>
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <br>
        <!-- Menampilkan daftar mobil yang sesuai dengan filter jarak tempuh atau semua mobil jika filter tidak 
        digunakan. Setiap mobil ditampilkan dalam loop while dan informasi seperti nama, merk, cc, tipe bahan bakar, 
        tahun, jarak tempuh, harga, dan tombol "Beli" ditampilkan. Data mobil diambil dari query yang sesuai dengan filter. -->
        <div class="row">
            <?php 
            while ($perproduk = $ambil->fetch_assoc()) { 
            ?>
            <div class="col-md-3">    
                <div class="thumbnail">
                    <img src="asets/mobil/<?php echo $perproduk['foto']; ?>" style="width: 70%;">
                    <div class="caption">
                    <h4>Nama: <?php echo $perproduk['nama']; ?></h4>
                    <h5>Merk: <?php echo $perproduk['merk']; ?></h5>
                    <h5>cc: <?php echo number_format($perproduk['cc']); ?></h5>
                    <h5>Tipe bbm: <?php echo $perproduk['tipe_bbm']; ?></h5>
                    <h5>Tahun: <?php echo $perproduk['tahun']; ?></h5>
                    <h5>Jarak tempuh: <?php echo number_format($perproduk['jarak_tempuh']); ?> km</h5>
                    <h5>Harga: Rp <?php echo number_format($perproduk['harga']); ?></h5>
                    <a href="beli.php?id=<?php echo $perproduk['id']; ?>" class="btn btn-primary">Add</a>
                    </div>
                </div>
                <br>
            </div>
            <?php } ?>
        </div>
    </div>
    <br><br>
    <?php include 'footer.php'; ?>
    <script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>