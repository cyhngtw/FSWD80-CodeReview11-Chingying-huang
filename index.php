<!DOCTYPE html>
<html>
<head>
   <title>Travel-o-matic </title>
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


   <script src="https://kit.fontawesome.com/473562d7d7.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="col-12 border-1 " >
     <img src="uploads/background.jpg" height="200px" class=" w-100">
   </div><!-- /header -->

<!-- hero  start-->
<div class ="container">

  
<!-- nav start-->
  <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php?logout"><i class="fas fa-user-check"></i>logout</a>
        </li>
  </ul>
<!-- nav end-->
  <br>
  <a href= "create.php"><button type="button" >Add item</button></a>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-responsive">
      <thead>
               <th>Item ID</th>
               <th>Name</th>
               <th>Image</th>
               <th>Type</th>
               <th>City</th>
               <th>Zip</th>
               <th>Address</th>
               <th>Tel</th>
               <th>Web</th>
               <th>Style</th>
               <th>Price</th>
               <th>Date</th>
               <th>Edit</th>
      </thead>
      <tbody>
      <?php
           $con = mysqli_connect('localhost','root',"","cr11_ching_travelmatic");

        if($_POST){
            
         $id = $_POST['id'];
         $name = $_POST['name'];
         $files =$_FILES['file'];
         $type =$_POST['type'];
         $city =$_POST['city'];
         $zip =$_POST['zip'];
         $add =$_POST['address'];
         $tel =$_POST['tel'];
         $web =$_POST['web'];
         $style =$_POST['style'];
         $price =$_POST['price'];
         $locdate =$_POST['locdate'];

          print_r($name);
          print_r($type);
          print_r($city);
          print_r($zip);
          print_r($address);
          print_r($tel);
          print_r($web);
          print_r($style);
          print_r($price);
          print_r($locdate);
      

          echo "<br>";

          $filename =$files['name'];
          $fileerror =$files['error'];
          $filetmp =$files['tmp_name'];

          $fileext = explode('.',$filename);
          $filecheck = strtolower(end($fileext));

          $fileextstored = array('jpg','png','jpeg','gif');

          if(in_array($filecheck, $fileextstored)){
           $destinationfile = 'uploads/'.$filename;
           move_uploaded_file($filetmp,$destinationfile);

           $sql = "INSERT INTO location (id,  file, type, city, zip, address, tel, web, style, price, locdate ) VALUES ('$id', '$filename', '$type', '$city','$zip','$add','$tel','$web','$style','$price','$locdate')";

           $query = mysqli_query($con, $sql);
         }
       }
     
           $displayquery = "select * from location" ;
           $querydisplay = mysqli_query($con, $displayquery );

           $row = $querydisplay->fetch_all(MYSQLI_ASSOC);
           foreach ($row as $result) {
            
            ?>

            <tr>
              <td><?php echo $result['id']; ?> </td>
              <td><?php echo $result['name']; ?> </td>
              <td><img src="uploads/<?php echo $result['image']; ?>" height="100px" width="100px"></td>
              <td><?php echo $result['type']; ?></td>
              <td><?php echo $result['city']; ?></td>
              <td><?php echo $result['zip']; ?> </td>
              <td><?php echo $result['address']; ?> </td>
              <td><?php echo $result['tel']; ?> </td>
              <td><?php echo $result['web']; ?> </td>
              <td><?php echo $result['style']; ?> </td>
              <td><?php echo $result['price']; ?> </td>
              <td><?php echo $result['locdate']; ?> </td>
              <td><a href="update.php?id=<?= $result['id'] ?>"><button type='button'>Edit</button></a>
                  <a href="delete.php?id=<?php echo $result['id'] ?>"><button type='button'>Delete</button></a>
              </td>


            </tr>
            <?php

          }

?>
      </tbody>
    </table>
     
  </div>
  
           

</div>
       
       
 <!-- Footer Links -->

  <div class="footer-copyright text-center py-3 bg-info">© 2019 Copyright:Travel-o-Matic</a>
  </div>


</footer>
<!-- Footer -->
   


</body>
</html>