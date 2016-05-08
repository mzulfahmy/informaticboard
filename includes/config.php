<?php
//configuration

$username = "root";
$password = "";
$host = "localhost";
$database = "infomatic";

$dbc = new mysqli($host, $username, $password, $database);

if($_SERVER['REQUEST_URI'] == '/config.php'){
	header('Location: index.php');

	if(!$dbc){
	$dberror = "Could not connect to database";

	}
}

$settingsql = 'SELECT * FROM settings';
$querysetting = mysqli_query($dbc, $settingsql);
$arraysetting = mysqli_fetch_array($querysetting);

$siteName = $arraysetting['sitename'];
?>