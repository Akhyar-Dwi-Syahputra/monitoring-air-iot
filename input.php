<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input Data</title>
</head>

<body>

	<?php
	include('koneksi.php');

	date_default_timezone_set('Asia/Makassar'); // Mengatur timezone ke WITA (Waktu Indonesia Tengah)
	$tanggal = date("Y-m-d H:i:s"); // Menyimpan tanggal dan waktu saat ini dengan format datetime
	$kekeruhan = $_GET['kekeruhan'];
	$garam = $_GET['garam'];
	$keasaman = $_GET['keasaman'];

	$kirim = mysqli_query($koneksi, "INSERT INTO tbmonitor (tanggal, kekeruhan, garam, keasaman) VALUES ('$tanggal', '$kekeruhan', '$garam', '$keasaman')");

	if ($kirim) {
		echo "Data berhasil diinputkan...!";
	} else {
		echo "Gagal di inputkan...!";
	}

	?>

</body>

</html>