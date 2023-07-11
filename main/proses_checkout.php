<?php
session_start();
include 'koneksi.php';

if (isset($_POST['checkout'])) {
    $id = $_SESSION["user"]["id"];
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $alamat = $_POST['alamat'];
    $pengiriman = $_POST['pengiriman'];
    $pembayaran = $_POST['pembayaran'];

    // Mengambil total belanja dari tabel keranjang
    $query = "SELECT SUM(keranjang.jumlah * mobil.harga) AS totalbelanja FROM keranjang JOIN mobil ON keranjang.id_mobil = mobil.id WHERE keranjang.id_user = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("s", $id);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $totalbelanja = $row['totalbelanja'];

    // Insert data pembelian ke tabel pembelian
    $query = "INSERT INTO pembelian (id_user, subtotal, tanggal, alamat, pembayaran, pengiriman) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("ssssss", $id, $totalbelanja, $tanggal, $alamat, $pembayaran, $pengiriman);
    $statement->execute();

    // Dapatkan ID pembelian baru yang baru saja diinsert
    $id_pembelian_barusan = $statement->insert_id;

    // Mengurangi stok barang di tabel mobil
    $query = "UPDATE mobil JOIN keranjang ON mobil.id = keranjang.id_mobil SET mobil.stok = mobil.stok - keranjang.jumlah WHERE keranjang.id_user = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("s", $id);
    $statement->execute();

    // Insert data detail pembelian ke tabel detail_pembelian
    $query = "INSERT INTO detail_pembelian (id_pembelian, id_mobil, jumlah, harga, total) SELECT ?, keranjang.id_mobil, keranjang.jumlah, mobil.harga, keranjang.jumlah * mobil.harga FROM keranjang JOIN mobil ON keranjang.id_mobil = mobil.id WHERE keranjang.id_user = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("ss", $id_pembelian_barusan, $id);
    $statement->execute();

    // Menghapus data keranjang yang sudah di-checkout
    $query = "DELETE FROM keranjang WHERE id_user = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("s", $id);
    $statement->execute();

    $_SESSION["user"]["alamat"] = $alamat; // Menyimpan alamat baru ke dalam session
    header("Location: nota.php");
    exit();
}
?>
