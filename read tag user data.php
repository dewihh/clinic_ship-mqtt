<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM table_the_iot_mqtt where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

$msg = null;
if (null == $data['name']) {
	$msg = "The ID of your Card / KeyChain is not registered !!!";
	$data['id'] = $id;
	$data['name'] = "--------";
	$data['gender'] = "--------";
	$data['age'] = "--------";
	$data['validation_sheet'] = "--------";
	$data['adress'] = "--------";
	$data['phone_numb'] = "--------";
} else {
	$msg = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
	<style>
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
	</style>
</head>

<body>
	<div class="input_read">
		<form>
			<table align="center" cellpadding="0" cellspacing="1" bgcolor="#E7A0B1" style="padding: 2px">
				<tr>
					<td height="40" align="center" bgcolor="#cf7070">
						<font color="#FFFFFF">
							<b>User Data</b>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table_dua" align="center" cellpadding="5" cellspacing="0">
							<tr>
								<td width="113" align="left" class="lf">ID</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['id']; ?></td>
							</tr>
							<tr bgcolor="#CF7070">
								<td align="left" class="lf">Name</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['name']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Gender</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['gender']; ?></td>
							</tr>
							<tr bgcolor="#CF7070">
								<td align="left" class="lf">Age</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['age']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Validation</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['validation_sheet']; ?></td>
							</tr>
							<tr bgcolor="#CF7070">
								<td align="left" class="lf">Address</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['adress']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Phone Number</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['phone_numb']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<p style="color:red;"><?php echo $msg; ?></p>
</body>

</html>