<?php  
	ob_start();
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION["admin"])){
	header("Location: login.php");
}

if(isset($_SESSION["user"])){
	header("Location: home.php");
}

if($_POST){
	$city = $_POST["city"];
	$zipcode = $_POST["zipcode"];
	$street_name = $_POST["street_name"];

	$sql = "INSERT INTO address (city, street_name, zipcode) VALUES ('$city','$street_name','$zipcode')";

	if(mysqli_query($conn, $sql)){
		echo 'created successfully <br><a href="adminpanel.php">Home</a>';
	}


}

?>