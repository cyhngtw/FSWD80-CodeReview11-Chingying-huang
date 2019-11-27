<?php 

ob_start();
session_start();
require_once '../dbconnect.php';

if(!isset($_SESSION["admin"])){
  header("Location: ../login.php");
}

if(isset($_SESSION["user"])){
  header("Location:../home.php");
}

if ($_POST) {
   $id = $_POST['id'];

   $sql = "DELETE FROM location WHERE id = {$id}";
    if($conn->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>" ;
       echo "<a href='../index.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

?>
