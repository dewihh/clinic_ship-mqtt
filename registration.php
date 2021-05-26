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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<link href="css/custom.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>
	<script>
		var hostname = "broker.mqttdashboard.com";
		var port = 8000;
		var clientId = "WebSocket";
		clientId += new Date().getUTCMilliseconds();;
		var topic = "esp8266/postUid";

		mqttClient = new Paho.MQTT.Client(hostname, port, clientId);
		mqttClient.onMessageArrived = MessageArrived;
		mqttClient.onConnectionLost = ConnectionLost;
		Connect();

		/*Initiates a connection to the MQTT broker*/
		function Connect() {
			mqttClient.connect({
				onSuccess: Connected,
				onFailure: ConnectionFailed,
				keepAliveInterval: 10,
			});
		}

		/*Callback for successful MQTT connection */
		function Connected() {
			console.log("Connected to broker");
			mqttClient.subscribe(topic);
		}

		/*Callback for failed connection*/
		function ConnectionFailed(res) {
			console.log("Connect failed:" + res.errorMessage);
		}

		/*Callback for lost connection*/
		function ConnectionLost(res) {
			if (res.errorCode !== 0) {
				console.log("Connection lost:" + res.errorMessage);
				Connect();
			}
		}

		/*Callback for incoming message processing */
		function MessageArrived(message) {
			console.log(message.destinationName + " : " + message.payloadString);

			var a = parseInt(message.payloadString);
			var ht = 100 - a;
			document.getElementById("getUID").style.height = "" + ht + "%";
			document.getElementById("getUID").innerHTML = message.payloadString;
			document.getElementById("container").style.backgroundColor = "yellow";
			switch (message.payloadString) {
				case "ON":
					displayClass = "on";
					break;
				case "OFF":
					displayClass = "off";
					break;
				default:
					displayClass = "unknown";
			}
			var topic = message.destinationName.split("/");
			if (topic.length == 3) {
				var ioname = topic[1];
				UpdateElement(ioname, displayClass);
			}
		}
	</script>
	<title>Registration : Website Rekam Medis</title>
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
			<h1>Registration Form</h1>
			<div class="input__main">
				<div class="container__input">
					<form class="form-horizontal" action="insertDB.php" method="post">
						<div class="control-group">
							<label class="control-labels mrg-104">ID</label>
							<div class="controls">
								<textarea name="id" id="getUID" placeholder="Please Scan your Card to display ID" rows="1" cols="1" required></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-57">Name</label>
							<div class="controls">
								<input id="div_refresh" name="name" type="text" placeholder="Isikan Nama" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-48">Gender</label>
							<div class="controls">
								<select name="gender">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-182">Age</label>
							<div class="controls">
								<input id="tgl" name="age" type="text" placeholder="Isikan Usia" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-114">Validation</label>
							<div class="controls">
								<input name="validation_sheet" type="text" placeholder="Isikan Nama_kk" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-141">Address</label>
							<div class="controls">
								<input name="adress" type="text" placeholder="Isikan Alamat" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-labels mrg-28">Phone Number</label>
							<div class="controls">
								<input name="phone_numb" type="text" placeholder="Isikan Nomor Telepon" required>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div> <!-- /container -->
	</div>
	<script type="text/javascript">
		$(function() {
			$('#tgl').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true
			}).datepicker('update', new Date());
		});
	</script>
</body>

</html>