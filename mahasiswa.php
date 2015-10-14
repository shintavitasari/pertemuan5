<?php 

//1.koneksi database
$konek = mysql_connect("localhost","root","");
$db = mysql_select_db("mahasiswa");
if ($konek){
		echo("sip <br>");
	}
else{
	echo("ora sip <br>");
	}

if ($db){
	echo("db ada <br>");
	}
else{
	echo("db null <br>");
	}

//2.query database
$query = "select * from mahasiswa";
	$hasil = mysql_query($query);

	$datamahasiswa = array();

	while ($data = mysql_fetch_array($hasil))
	{
		$datamahasiswa [] = array('nim' => $data['nim'], 
			'nama' => $data['nama'],
			'alamat' => $data['alamat'],
			'prodi' => $data['prodi']);
		//echo $data['nim'];
	}

//3.parsing data XML
$document = new DOMDocument();
	$document->formatOutput = true;
	$root = $document->createElement("data");
	$document->appendChild($root);
	foreach($datamahasiswa as $mahasiswa)
	{
		$block = $document->createElement("mahasiswa");

		//create element nim
		$nim = $document->createElement("nim");
		//createElment untuk membuat element baru
		$nim->appendChild($document->createTextNode($mahasiswa['nim']));
		//createTextNode untuk menampilkan isi/value
		$block->appendChild($nim);
		//appendChild untik mempersiapkan nilai dari element diatasnya

		//create element nama
		$nama = $document->createElement("nama");
		$nama->appendChild($document->createTextNode($mahasiswa['nama']));
		$block->appendChild($nama);

		//create element alamat
		$alamat = $document->createElement("alamat");
		$alamat->appendChild($document->createTextNode($mahasiswa['alamat']));
		$block->appendChild($alamat);

		//create element prodi
		$prodi = $document->createElement("prodi");
		$prodi->appendChild($document->createTextNode($mahasiswa['prodi']));
		$block->appendChild($prodi);

		$root->appendChild($block);
	}

//4.Menyimpan data dalam bentuk file XML
	$generateXML = $document->save("mahasiswa.xml");
	if($generateXML){
			echo("berhasil di generate <br>");
		}
	else{
			echo("gagal <br>");
		}

//5.Membaca file XML
	//membuka file
$url = "http://localhost/mahasiswa/mahasiswa.xml";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
curl_close($client);
	//membaca file

//6.Ditampilkan dalam bentuk HTML
$datamahasiswaxml = simplexml_load_string($response); 
//print_r($datamahasiswaxml);
	//perulangan
		echo "
			<table border='1'>
				<tr>
					<td>NIM</td>
					<td>Nama</td>
					<td>Alamat</td>
					<td>Prodi</td>
				</tr>";
			foreach($datamahasiswaxml->mahasiswa as $mahasiswa)
				{
					echo "
					<tr>
						<td>".$mahasiswa->nim."</td>
						<td>".$mahasiswa->nama."</td>
						<td>".$mahasiswa->alamat."</td>
						<td>".$mahasiswa->prodi."</td>
					</tr>";
				}
			echo "</table>"
?>