<?php 

include "includes/config.php";
session_start();

if(isset($_SESSION['token'])){
	$tokenlizer = $_SESSION['token'];

	$tokensql = "SELECT * FROM user WHERE username = '".$tokenlizer."' ";

	$query = mysqli_query($dbc, $tokensql);
	$row = mysqli_num_rows($query);
	$dataarray = mysqli_fetch_array($query);


	if($row == 0){
		header('Location: login.php');
	}

}

?>
