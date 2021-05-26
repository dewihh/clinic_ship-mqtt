<?php

require 'database.php';

if (!empty($_POST)) {
	// keep track post values
	$name = $_POST['name'];
	$id = $_POST['id'];
	$gender = $_POST['gender'];
	$usia = $_POST['age'];
	$nama_kk = $_POST['validation_sheet'];
	$alamat = $_POST['adress'];
	$no_telp = $_POST['phone_numb'];

	// insert data
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO table_the_iot_mqtt (name,id,gender,age,validation_sheet,adress,phone_numb) values(?, ?, ?, ?, ?, ?, ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($name, $id, $gender, $usia, $nama_kk, $alamat, $no_telp));
	Database::disconnect();
	header("Location: read tag.php");
}
