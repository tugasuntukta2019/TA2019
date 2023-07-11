<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Kategori Service</th>
		<th>Harga</th>
		<th>Foto Service</th>
		<th>Action</th>
	</tr>
	<!-- variabel $nomor yang akan digunakan untuk menghitung nomor urut setiap service. -->
	<?php $nomor = 1; ?>
	<?php
	//  Mengambil data service dari database dengan melakukan query menggunakan objek $koneksi. Query ini mengambil data dari tabel "services" dengan kategori yang sama dengan 1 (service).
	$ambil = $koneksi->query("SELECT * FROM services WHERE kategori = '1'");
	// perulangan dengan menggunakan while untuk menampilkan setiap baris data service yang telah diambil. 
	// Setiap atribut mobil ditampilkan dalam elemen <td> yang sesuai dalam tabel.
	while ($pecah = $ambil->fetch_assoc()) {
	?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['kategori_services']; ?></td>
			<td>Rp <?php echo number_format($pecah['harga']); ?></td>
			<td>
				<img src="../asets/services/<?php echo $pecah['foto'] ?>" width="100">
			</td>
			<td>
				<!-- tombol "Hapus" yang mengarahkan ke halaman "delete.php" dengan mengirimkan parameter "id" sparepart yang akan dihapus.  -->
				<a href="deleteservice.php?id=<?php echo $pecah['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus service ini?')" class="btn-danger btn">Hapus</a>
				<!-- tombol "Ubah" yang mengarahkan ke halaman "editsparepart.php" dengan mengirimkan parameter "id" sparepart yang akan diubah. -->
				<a href="editservice.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
</table>
<!-- Menampilkan tombol "Tambah Service" yang mengarahkan ke halaman "addservice.php" untuk menambahkan service baru ke dalam database. -->
<a href="addservice.php" class="btn btn-primary">Tambah Service</a>
