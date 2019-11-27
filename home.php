<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if(!isset($_SESSION["user"])){
  header("Location: login.php");
}
if(isset($_SESSION["admin"])){
  header("Location: adminpanel.php");
}

// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
     <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

     <script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Travel-o-Matic</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- awsonfont -->
    <script src="https://kit.fontawesome.com/473562d7d7.js" crossorigin="anonymous"></script>

</head>
<body>
<!-- nav start-->
<nav class="navbar navbar-light bg-light fixed-top ">
  <ul class="nav  nav-tabs pt-2">
        
        <li class="nav-item text-muted">
          <a class="nav-link text-dark" href="logout.php?logout"><i class="fas fa-user-check"></i>Sign Out</a>
        </li>
        <li class="nav-item navbar-light">
          <a class="nav-link active" href="#">Restaurants</a>
        </li>
        <li class="nav-item text-muted">
          <a class="nav-link text-dark" href="#sightseeing">Sightseeing</a>
        </li>
        <li class="nav-item text-muted">
          <a class="nav-link text-dark" href="#concert">Concert</a>
        </li>

  </ul>

  <form class="form-inline border-1 ">
    <input class="form-control " type="text" placeholder="Search" aria-label="Search"  name="search_text" id="search_text">
    <button class="btn btn-outline-dark my-2"  type="submit">Search</button>
  </form>
  <div id="result"></div>
  <div style="clear:both"></div>
</nav>
<!-- nav end-->
  <div class="col-12 border-1 " >
     <img src="uploads/background.jpg" height="300px" class=" w-100">
   </div><!-- /header -->

         


<h4>Hi <?php echo $userRow['userName']; ?></h4>

<div class="container">

<div class="row d-flex justify-content-between">
        
   
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
           $destinationfile = 'blog/uploads/'.$filename;
           move_uploaded_file($filetmp,$destinationfile);

         $sql = "INSERT INTO location (id,  image, type, city, zip, address, tel, web, style, price, locdate ) VALUES ('$id', '$filename', '$type', '$city','$zip','$add','$tel','$web','$style','$price','$locdate')";


           $query = mysqli_query($con, $sql);
         }
       }
     // concert restaurant
           $displayquery = 'select id,name, city,zip, address,tel,web, style,image from location where type = "restaurant" ' ;
           $querydisplay = mysqli_query($con, $displayquery );

           $row = $querydisplay->fetch_all(MYSQLI_ASSOC);
           foreach ($row as $result) {
            ?>
           
<div class="card col-5" >
<img class="card-img-top" src="uploads/<?php echo $result['image']; ?>" height="200px" width="100px" style="object-fit:cover">
  
  <div class="card-body">
    <h4 class="card-title"><?php echo $result['name']; ?></h4>
    <p class="card-text"><?php echo $result['city']; ?></p>
    <p class="card-text"><?php echo $result['zip']; ?></p>
    <p class="card-text" ><a href="google.php?address=<?php echo $result['address']; ?>"><?php echo $result['address']; ?></a></p>
    <p class="card-text"><?php echo $result['tel']; ?></p>
    <p class="card-text"><?php echo $result['web']; ?></p>
    <p class="card-text"><?php echo $result['style']; ?></p>

    
  </div>
  
</div>
<?php 
}

// concert sightseeing
$displayquery = 'select name, city,zip, address,tel,web, image from location where type = "sightseeing" ' ;
           $querydisplay = mysqli_query($con, $displayquery );

           $row = $querydisplay->fetch_all(MYSQLI_ASSOC);
           foreach ($row as $result) {
            ?>
           
<div class="card col-5" >
  <br><a name="sightseeing"></a>
<img class="card-img-top" src="uploads/<?php echo $result['image']; ?>" height="200px" width="100px" style="object-fit:cover">
  
  <div class="card-body">
    <h4 class="card-title"><?php echo $result['name']; ?></h4>
    <p class="card-text"><?php echo $result['city']; ?></p>
    <p class="card-text"><?php echo $result['zip']; ?></p>
    <p class="card-text"><a href="google.php?address=<?php echo $result['address']; ?>"><?php echo $result['address']; ?></a></p>
    <p class="card-text"><?php echo $result['tel']; ?></p>
    <p class="card-text"><?php echo $result['web']; ?></p>
    
    
  </div>
  
</div>
<?php 
}


// concert start
$displayquery = 'select name, price, locdate ,web, image from location where type = "concert" ' ;
           $querydisplay = mysqli_query($con, $displayquery );

           $row = $querydisplay->fetch_all(MYSQLI_ASSOC);
           foreach ($row as $result) {
            ?>
           
<div class="card col-5" >
<br><a name="concert"></a>
<img class="card-img-top" src="uploads/<?php echo $result['image']; ?>" height="200px" width="100px" style="object-fit:cover">
  
  <div class="card-body">
    <h4 class="card-title"><?php echo $result['name']; ?></h4>
    <p class="card-text">price :<?php echo $result['price']; ?>&euro; </p>
    <p class="card-text"><?php echo $result['locdate']; ?></p>
    <p class="card-text"><?php echo $result['web']; ?></p>
    
    
  </div>
  
</div>
<?php 
}


?>


 </div>     
</div>   
 
 <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 bg-info">© 2019 Copyright:Travel-o-Matic</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

<!-- google -->
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
<!-- search -->
<script>
$(document).ready(function(){
  load_data();
  function load_data(query)
  {
    $.ajax({
      url:"fetch.php",
      method:"post",
      data:{query:query},
      success:function(data)
      {
        $('#result').html(data);
      }
    });
  }
  
  $('#search_text').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
    }
    else
    {
      load_data();      
    }
  });
});
</script>
<!-- search end -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- google script -->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap"
    async defer></script>
</body>
</html>


<?php ob_end_flush(); ?>