<?php 
// ob_start();
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION["admin"])) {
  header("Location: login.php");
}
$id = $_GET['id'];
echo $id;

if(isset($_POST["submit"])) {
   
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
}
if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM location WHERE id = {$id}" ;
 
   $result = $conn->query($sql);

   $data = $result->fetch_assoc();

   }
//Check that we have a file and i don't have any error
if((!empty($_FILES["file"])) && ($_FILES['file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);

  if (($ext == "jpg") && ($_FILES["file"]["type"] == "image/jpeg") && 
  ($_FILES["file"]["size"] < 35000000)) {
    //Determine the path to which we want to save this file
    $newnameoftheimage = basename($_FILES['file']['name']);
    $filename = dirname(FILE).'/uploads/'.$filename;
    // !!!  "uploads" is a folder inside of the main folder
    //Check if the file with the same name is already exists on the server
    if (!file_exists($filename)) {
      //Attempt to move the uploaded file to it's new place
      if ((move_uploaded_file($_FILES['file']['tmp_name'],$filename))) {


                 
            
        $sql = "UPDATE location SET 
        name = '$name', 
        image = '$newnameoftheimage', 
        type = '$type', 
        city = '$city', 
        zip = '$zip', 
        address = '$add', 
        tel = '$tel',
        web = '$web',
        style = '$style',
        price = '$price',
        locdate = '$locdate' WHERE id= {$id}" ;

        if($conn->query($sql) === TRUE) {
          echo  "<p>Successfully Updated</p>";
          echo "<a href='update.php?id=" .$id."'><button type='button'>Back</button></a>";
          echo  "<a href='index.php'><button type='button'>Home</button></a>";
        } else {
          echo "Error while updating record : ". $conn->error;
        }
      }
    }
    $conn->close();
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

    
 </head>
<body >
  <div class="col-12 border-1 " >
     <img src="uploads/background.jpg" height="200px" class="w-100">
   </div><!-- /header -->
<!-- 
           Hi <?php echo $userRow['userName' ]; ?> -->
           
           <a  href="logout.php?logout">Sign Out</a>
           


   <div class="container d-flex ">
    <div class="row">
    
           
      <div class="card " >
      <form class="form-group" action="actions/a_update.php"  method="post">
      
    <input type ="file" name= "file"  value="<?php echo $file['image'] ?>" />
      
  
  <div class="card-body"><h4><input type="text" name="name" placeholder="name"  value="<?php echo $data['name']?>" class="form-control"></h4>

    <p class="card-text"><input type="text" name="type" id="type" placeholder="type" value="<?php echo $data['type']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="city" id=" " placeholder="city" value="<?php echo $data['city']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="zip" id=" " placeholder="zip" value="<?php echo $data['zip']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="address" id=" " placeholder="address" value="<?php echo $data['address']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="tel" id=" " placeholder="tel" value="<?php echo $data['tel']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="web" id=" " placeholder="web" value="<?php echo $data['web']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="style" id=" " placeholder="style" value="<?php echo $data['style']?>" class="form-control"></p>

    <p class="card-text"><input type="text" name="price" id=" " placeholder="price" value="<?php echo $data['price']?>" class="form-control"></p>

    <p class="card-text"><input type="datetime-local" name="locdate" id="locdate" value="<?php echo $data['locdate']?>" placeholder="select time" class="form-control"></p>

   
    </div>

     <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
      <input type="hidden" name="id" value="<?php echo $data['id']?>" />
      <button  type="sumbit" class="btn btn-info">save change</button>
      <a href="index.php" class="btn btn-info">back</a>

      </div>
  
  </form>


  </div>

 </div>     
</div>  

</body >
</html >