<?php 
// ob_start();
session_start();
require_once 'dbconnect.php';

// f(!isset($_SESSION["admin"])){
//   header("Location: login.php");
// }

// if(isset($_SESSION["user"])){
//   header("Location: home.php");
// }
if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM location WHERE id = {$id}" ;
   $result = $conn->query($sql);
   $data = $result->fetch_assoc();

   $conn->close();
?>

<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Blog</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link href="signin.css" rel="stylesheet">

</head>
<body >
  <div class="col-12 border-1 " >
     <img src="uploads/background.jpg" height="200px" class=" w-100">
   </div><!-- /header -->

           Hi <?php echo $userRow['userName' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a>
           

<h3>Do you really want to delete this item?</h3>
<form action ="actions/a_delete.php" method="post">

   <input type="hidden" name= "id" value="<?php echo $data['id'] ?>" />
   <button type="submit">Yes, delete it!</button >
   <a href="index.php"><button type="button">No, go back!</button ></a>
</form>

</body>
</html>

<?php
}
?>