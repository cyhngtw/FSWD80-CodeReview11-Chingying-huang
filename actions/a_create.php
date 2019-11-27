<?php 
ob_start();
session_start();
require_once '../dbconnect.php';

if(!isset($_SESSION["admin"])){
  header("Location: login.php");
}

if(isset($_SESSION["user"])){
  header("Location: home.php");
}

if ($_POST) {
   
   $name = $_POST['name'];
   $type =$_POST['type'];
   $city =$_POST['city'];
   $zip =$_POST['zip'];
   $add =$_POST['address'];
   $tel =$_POST['tel'];
   $web =$_POST['web'];
   $style =$_POST['style'];
   $price =$_POST['price'];
   $locdate =$_POST['locdate'];

     $sql = "INSERT INTO location (image, name, type, city, zip, address, tel, web, style, price, locdate ) VALUES ('$filename', '$name', '$type', '$city','$zip','$add','$tel','$web','$style','$price','$locdate')";

   

    if($conn->query($sql) === TRUE) {
       echo "<p>New Record Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../index.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $conn->connect_error;
   }

   $conn->close();
}

?> 