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
// error_reporting(E_ERROR | E_PARSE);

//   $conn = mysqli_connect("localhost","root","","cr11_ching_travelmatic");

// !!! "upload" is a name of database, please create one
  if(isset($_POST["submit"])){
   
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
   
   
//Check that we have a file and i don't have any error
if((!empty($_FILES["file"])) && ($_FILES['file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if (($ext == "jpg") && ($_FILES["file"]["type"] == "image/jpeg") && 
  ($_FILES["file"]["size"] < 35000000)) {
    //Determine the path to which we want to save this file
      $filename = dirname(FILE).'/uploads/'.$filename;
// !!!  "uploads" is a folder inside of the main folder
      //Check if the file with the same name is already exists on the server
      if (!file_exists($filename)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['file']['tmp_name'],$filename))) {
           $sql = "INSERT INTO location (image, name, type, city, zip, address, tel, web, style, price, locdate ) VALUES ('$filename','$name', '$type', '$city','$zip','$add','$tel','$web','$style','$price','$locdate')";

   

    if($conn->query($sql) === TRUE) {
       echo "<p>New Record Successfully Created</p>" ;
       echo "<a href='create.php'><button type='button'>Back</button></a>";
        echo "<a href='index.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $conn->connect_error;
   }

   $conn->close();
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["file"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
 echo "Error: No file uploaded";
}
}
?>



<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Travel-o-matic</title>

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
           

<div class="container d-flex ">
    <div class="row">
    
           
      
      <div class="card form-group">
      <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"  />Select image
    <input name="file" type="file"  class="form-control" />
      
  
  <div class="card-body"><h4><input type="text" name="name" placeholder="name" class="form-control"></h4>
    <p class="card-text"><input type="text" name="type" id="type" placeholder="type" class="form-control"></p>
    <p class="card-text"><input type="text" name="city"  placeholder="city" class="form-control"></p>
    <p class="card-text"><input type="text" name="zip" id=" " placeholder="zip" class="form-control"></p>
    <p class="card-text"><input type="text" name="address" placeholder="address" class="form-control"></p>
    <p class="card-text"><input type="text" name="tel"  placeholder="tel" class="form-control"></p>
    <p class="card-text"><input type="text" name="web" id=" " placeholder="web" class="form-control"></p>
    <p class="card-text"><input type="text" name="style" id=" " placeholder="style" class="form-control"></p>
    <p class="card-text"><input type="text" name="price" id=" " placeholder="price" class="form-control"></p>
    <p class="card-text"><input type="datetime-local" name="locdate"  placeholder="select time" class="form-control"></p>
  </div>

     <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
      <input type="submit" name="submit" value="Sumbit" class="btn btn-info">
     </div>
    
  
  
  </form>
     
</div>       <!-- card -->
</div>     <!-- row -->
</div> <!-- container -->
 <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 bg-info">© 2019 Copyright: Travel-o-matic
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>