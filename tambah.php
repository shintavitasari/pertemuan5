<html>
	<body>
		<?php
			include "koneksi.php";
			if (isset($_POST['nim'])){
				$url = "http//localhost/mhs/mhs.php";

				$data = "<data><mahasiswa>
				<nim>" . $_POST['nim'] . "</nim>
				<nama>" . $_POST['nama'] . "</nama>
				<alamat>" . $_POST['alamat'] . "</alamat>
				<prodi>" . $_POST['prodi'] . "</prodi>
				</mahasiswa></data>";
			
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

				$response = curl_exec($ch);

				curl_close($ch);
			}
		?>

		<a href="view_mahasiswa.php">Lihat Mahasiswa</a>
		<form method="POST" action="tambah.php">
			<table>
				<tr>
					<td>NIM</td>
					<td><input type="text" name="nim" id="nim"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" id="nama"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" id="alamat"></td>
				</tr>
				<tr>
					<td>Prodi</td>
					<td><input type="text" name="prodi" id="prodi"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="tambah"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
