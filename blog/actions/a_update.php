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

if ($_POST) {
   
   $id = $_POST['id'];
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
  

   $sql = "UPDATE location SET 
   name = '$name', 
   type = '$type', 
   city = '$city', 
   zip = '$zip', 
   address = '$add', 
   tel = '$tel',
   web = '$web',
   style = '$style',
   price = '$price',
   locdate = '$locdate' WHERE id= {$id}" ;
   if($connect->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../update.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../index.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $connect->error;
   }

   $connect->close();

}

?> 