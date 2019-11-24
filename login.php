<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if(isset($_SESSION["user"])){
  header("Location: home.php");
}
if(isset($_SESSION["admin"])){
  header("Location: adminpanel.php");
}

$error = false;

if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST[ 'pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if (empty($pass)){
  $error = true;
  $passError = "Please enter your password." ;
 }elseif(strlen($pass) < 5){
  $error = true;
  $passError = "Must be more than 5 char";
 }

 // if there's no error, continue to login
 if (!$error) {
 
  $password = hash( 'sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT userId, userName, userPass, role FROM users WHERE userEmail='$email'" );
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row  $res->num_rows
 
  if( $count == 1 && $row['userPass']==$password ) {
    if($row["role"] == "admin"){
      $_SESSION["admin"]= $row["userId"];
      header("Location: adminpanel.php");
      exit;
    } else{
      $_SESSION['user'] = $row['userId'];
      header( "Location: home.php");
    }
   
  } else {
   $errMSG = "Incorrect Credentials, Try again..." ;
  }
 
 }

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Travel-o-Matic</title>

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="col-12 border-1 " >
     <img src="blog/uploads/background.jpg" height="200px" class=" w-100">
   </div><!-- /header -->


   <div class="col-md-6 offset-md-3">
   <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
 
   
      <br>
      <h4 class="h4 mb-3 font-weight-normal text-center pt-2 bg-primary text-white">Registration
      </h4>
           
         
     <?php
   if ( isset($errMSG) ) {
 
   ?>
           <div  class="alert alert-<?php echo $errTyp ?>" >
                         <?php echo  $errMSG; ?>
       </div>

<?php
  }
  ?>
           
         
           
            <input  type="email" name="email"  class="form-control" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40" />
       
            <span class="text-danger"><?php  echo $emailError; ?></span >
 
         
            <input  type="password" name="pass"  class="form-control" placeholder ="Your Password" maxlength="15"  />
       
           <span  class="text-danger"><?php  echo $passError; ?></span>

            <hr />
            <button  type="submit" name= "btn-login" class = "btn btn-block btn-primary mt-2">Sign In</button>
         
         
            <hr />
 
            <a  href="register.php">if you have registered, please sign in here...</a>
     
         
   </form>
   </div>


 <!-- Footer Links -->
<footer>
  <div class="footer-copyright text-center py-3 bg-info fixed-bottom">© 2019 Copyright:Travel-o-Matic</a>
  </div>


</footer>
<!-- Footer -->
</body>
</html>
<?php ob_end_flush(); ?>