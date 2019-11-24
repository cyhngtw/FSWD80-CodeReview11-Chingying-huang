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
// if session is not set this will redirect to login page

// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userName' ]; ?></title>
</head>
<body >
           Hi <?php echo $userRow['userEmail' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a>
           <br>

           <form method="POST" action="create.php">
           	<input type="text" name="street_name"> 
           	<input type="text" name="zipcode"> 
           	<input type="text" name="city"> 
           	<input type="submit">
           </form>
 
       
 
</body>
</html>
<?php ob_end_flush(); ?>