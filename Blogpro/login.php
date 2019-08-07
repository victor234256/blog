<?php 
require_once("connection.php");
include_once("session.php");
include("timezone.php");
//include("errorfuction.php");
if(isset($_POST["submit"])){
$Username=mysqli_real_escape_string($connection,$_POST["username"]);
$Password=mysqli_real_escape_string($connection,$_POST["password"]);
if(empty($Username || $Password)){
    $_SESSION["ErrorMessage"]="All field must be Filled";
//    echo '<script>window.open("category.php","_self")</script>';
}


else{
    global $connection;
    $Query="SELECT * FROM admins WHERE username='$Username' AND password='$Password'";
    $Execute=mysqli_query($connection,$Query);
    if(mysqli_fetch_assoc($Execute)){//this command mean if it matches the associated array of username index and password;
        $_SESSION["SuccessMessage"]="Login successful";

      echo '<script>window.open("dashboard.php","_self")</script>';

    
}
    else{
        $_SESSION["ErrorMessage"]="Invalid Username/Password";

      //echo '<script>window.open("login.php","_self")</script>';
    }
    
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body style="background-color:white;">
  
   <div>
        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="login.php"><img src="images/customize.png" style="width:50px;margin-top:-15px;"></a>

                 </div>
        </div>
        <div style="height:7px;background-color:red;"></div>
    </div>
   <div class="container-fluid">
       <div class="row">
          
           <div class="col-sm-offset-4 col-sm-4">
              <div class="content p-5">
                <div><?php echo errormessage();
                 
                     echo successmessage();?></div>
                <div>
                <h2 class="mb-5">Welcome Back !</h2>
                    <form action="login.php" method="post" class="mb-5">
                        <div class="form-group">
                            <label for="username" class="text-danger">Username:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-envelope text-info"></span>
                            </span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-danger">Password:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-lock text-info"></span>
                            </span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        
                        <div>
                        <input type="submit" class="btn btn-info form-control mt-4" name="submit" value="Login">
                        </div>
                        
                    </form>
                </div>
              
                 
                  
              </div>
               
           </div>
       </div>
   </div>
   
</body>

