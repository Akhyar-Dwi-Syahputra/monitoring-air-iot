<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitoring Kualitas Air</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#konten").load("home.php");
			var refreshId = setInterval(function() {
				$("#konten").load('home.php');
			}, 5000); // Mengubah interval reload ke 5000 ms (5 detik)
			$.ajaxSetup({
				cache: false
			});
		});
	</script>
</head>

<body>
	<center>
		<div id="konten"></div>
	</center>
</body>

</html>