<?php
ob_start();
session_start(); // start a new session or continues the previous

if(isset($_SESSION["user"])){
  header("Location: home.php");
}
if(isset($_SESSION["admin"])){
  header("Location: adminpanel.php");
}


include_once 'dbconnect.php'; #require_once 'filename'; 
$error = false;
if ( isset($_POST['btn-signup']) ) {
 
 // sanitize user input to prevent sql injection 
 $name = trim($_POST['name']);
 # $name = $_POST["name"]

  //trim - strips whitespace (or other characters) from the beginning and end of a string
  $name = strip_tags($name);

  // strip_tags — strips HTML and PHP tags from a string

  $name = htmlspecialchars($name);

 // htmlspecialchars converts special characters to HTML entities
 $email = trim($_POST[ 'email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);

  // basic name validation
 if (empty($name)) {
  $error = true ;
  $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "Name must have at least 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true ;
  $nameError = "Name must contain alphabets and space.";
 }

 //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {
  // checks whether the email exists or not
  $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result); # $result->num_rows;
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }
 // password validation
  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "Password must have atleast 6 characters." ;
 }

 // password hashing for security
$password = hash('sha256' , $pass);

 // if there's no error, continue to signup
 if( !$error ) {
  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
  $res = mysqli_query($conn, $query);

  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($name);
    unset($email);
   unset($pass);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..." ;
  }
 
 }


}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Registration</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>

  <div class="col-12 border-1 " >
     <img src="blog/uploads/background.jpg" height="200px" class=" w-100">
   </div><!-- /header -->
      

      <div class="col-md-6 offset-md-3">
   <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
 
      <br>
            <h4 class="h4 mb-3 font-weight-normal text-center pt-2 bg-primary text-white">Registration</h4>
           
         
            <?php
   if ( isset($errMSG) ) {
 
   ?>
           <div  class="alert alert-<?php echo $errTyp ?>" >
                         <?php echo  $errMSG; ?>
       </div>

<?php
  }
  ?>
         
     
         

            <input type ="text"  name="name"  class ="form-control"  placeholder ="Enter Name"  maxlength ="50"   value = "<?php echo $name ?>"  />
     
               <span   class = "text-danger" > <?php   echo  $nameError; ?> </span >
         
   

            <input   type = "email"   name = "email"   class = "form-control"   placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>"  />
   
               <span   class = "text-danger" > <?php   echo  $emailError; ?> </span >
     
         
     
           
       
            <input   type = "password"   name = "pass"   class = "form-control"   placeholder = "Enter Password"    />
           
               <span   class = "text-danger" > <?php   echo  $passError; ?> </span >
     
           

         
            <button   type = "submit"   class = "btn btn-block btn-primary mt-2"   name = "btn-signup" >Sign Up</button >
            
            <hr>
            <a   href = "home.php" >if you have registered, please sign in here...</a>
   
 
   </form >
   </div>

   <footer>
         <div class="footer-copyright text-center py-3 bg-info fixed-bottom">© 2019 Copyright:Travel-o-Matic</a>
          </div>


    </footer>
</body >
</html >
<?php  ob_end_flush(); ?>