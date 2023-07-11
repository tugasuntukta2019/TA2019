<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Harga</th>
		<th>Stok</th>
		<th>Foto Sparepart</th>
		<th>Action</th>
	</tr>
	<!-- variabel $nomor yang akan digunakan untuk menghitung nomor urut setiap sparepart. -->
	<?php $nomor = 1; ?>
	<?php
	// Mengambil data sparepart dari database dengan melakukan query menggunakan objek $koneksi. Query ini mengambil data dari tabel "sparepart" dengan kategori yang sama dengan 2 (sparepart).
	$ambil = $koneksi->query("SELECT * FROM sparepart WHERE kategori = '2'");
	// perulangan dengan menggunakan while untuk menampilkan setiap baris data sparepart yang telah diambil. 
	// Setiap atribut mobil ditampilkan dalam elemen <td> yang sesuai dalam tabel.
	while ($pecah = $ambil->fetch_assoc()) {
	?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['stok']; ?></td>
			<td>
				<img src="../asets/sparepart/<?php echo $pecah['foto'] ?>" width="100">
			</td>
			<td>
				<!-- tombol "Hapus" yang mengarahkan ke halaman "delete.php" dengan mengirimkan parameter "id" sparepart yang akan dihapus.  -->
				<a href="deletesparepart.php?id=<?php echo $pecah['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus sparepart ini?')" class="btn-danger btn">Hapus</a>
				<!-- tombol "Ubah" yang mengarahkan ke halaman "editsparepart.php" dengan mengirimkan parameter "id" sparepart yang akan diubah. -->
				<a href="editsparepart.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
</table>
<!-- Menampilkan tombol "Tambah Sparepart" yang mengarahkan ke halaman "addsparepart.php" untuk menambahkan sparepart baru ke dalam database. -->
<a href="addsparepart.php" class="btn btn-primary">Tambah Sparepart</a>
