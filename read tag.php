<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
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
	<script src="jquery.min.js"></script>
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


	<title>Read Tag : Website Rekam Medis</title>
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
						<a class="overlay" href="read tag.php"><span class="texts">Read Card</span></a>
					</li>
					<li>
						<a class="overlay" href="antrian/index.php?page=queue_registration"><span class="texts">Antrian</span></a>
					</li>
				</ul>
			</div>
		</div>

		<br>

		<h3 align="center" id="blink">Please Scan Tag to Display ID or User Data</h3>

		<p id="getUID" hidden></p>
		<div class="homepages__main">
			<div class="input__main">
				<div id="show_user_data">
					<form>
						<table bgcolor="#E7A0B1" align="center" cellpadding="0" cellspacing="1" style="padding: 2px">
							<tr>
								<td bgcolor="#CF7070" height="40" align="center">
									<font color="#FFFFFF">
										<b>User Data</b>
									</font>
								</td>
							</tr>
							<tr>
								<td>
									<table class="table_dua" align="left" cellpadding="5" cellspacing="0">
										<tr bgcolor="#E7A0B1">
											<td width="24%" align="left" class="lf">ID</td>
											<td width="24%" style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr bgcolor="#CF7070">
											<td align="left" class="lf">Name</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr>
											<td align="left" class="lf">Gender</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr bgcolor="#CF7070">
											<td align="left" class="lf">Age</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr>
											<td align="left" class="lf">Validation</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr bgcolor="#CF7070">
											<td align="left" class="lf">Address</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
										<tr>
											<td align="left" class="lf">Phone Number</td>
											<td style="font-weight:bold">:</td>
											<td align="left">--------</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		var myVar = setInterval(myTimer, 1000);
		var myVar1 = setInterval(myTimer1, 1000);
		var oldID = "";
		clearInterval(myVar1);

		function myTimer() {
			var getID = document.getElementById("getUID").innerHTML;
			oldID = getID;
			if (getID != "") {
				myVar1 = setInterval(myTimer1, 500);
				showUser(getID);
				clearInterval(myVar);
			}
		}

		function myTimer1() {
			var getID = document.getElementById("getUID").innerHTML;
			if (oldID != getID) {
				myVar = setInterval(myTimer, 500);
				clearInterval(myVar1);
			}
		}

		function showUser(str) {
			if (str == "") {
				document.getElementById("show_user_data").innerHTML = "";
				return;
			} else {
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("show_user_data").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "read tag user data.php?id=" + str, true);
				xmlhttp.send();
			}
		}

		var blink = document.getElementById('blink');
		setInterval(function() {
			blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
		}, 750);
	</script>
</body>

</html>