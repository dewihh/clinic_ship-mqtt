<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Sniglet&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Website Rekam Medis</title>
</head>

<body>
	<div class="homepages">
		<div class="homepages__title">
			<h1>Selamat Datang</h1>
			<p>Sistem Informasi Pelayanan Kesehatan</p>
		</div>
		<div class="homepages__navbar">
			<div class="navbar__menu">
				<ul>
					<li>
						<a class="overlay" href="home.php"><span class="texts">Home</span></a>
					</li>
					<li>
						<a class="overlay" href="registration.php"><span class="texts">Registration</span></a>
					</li>
					<li>
						<a class="overlay" href="read tag.php"><span class="texts">Read Tag ID</span></a>
					</li>
					<li>
						<a class="overlay" href="antrian/index.php?page=queue_registration"><span class="texts">Service</span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="homepages__main">
			<h1>Puskesmas Teknologi Rekayasa Internet</h1>
			<div class="container">
				<div class="container__title">
					<h2>Pendaftaran</h2>
				</div>
				<div class="option">
					<div class="option__satu">
						<a href="registration.php">
							<img class="gambar" src="./img/icon user.svg">
							<p class="p-size"> Pendaftaran Pasien Baru</p>
						</a>
					</div>
					<div class="option__satu">
						<a href="read tag.php">
							<img class="gambar" src="./img/icon user 2.svg">
							<p class="p-size">Pendaftaran Pasien Lama</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>