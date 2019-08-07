<?php 
require("connection.php");
include("session.php");
include("timezone.php");
if(isset($_POST["submit"])){
$Title=mysqli_real_escape_string($connection,$_POST["title"]);
$Name=mysqli_real_escape_string($connection,$_POST["name"]);
$Message=mysqli_real_escape_string($connection,$_POST["message"]);
$Admin = "Jimoh Victor";
$image = $_FILES['Image']['name'];// this function allow the name of the image only to save in that database and not the real image;

$img_target="uploadimg/".basename($_FILES['Image']['name']);

if(empty($Name)){
    $_SESSION["ErrorMessage"]="Name field is Required";
//    echo '<script>window.open("category.php","_self")</script>';
}
elseif(strlen($Name)<2){
//    echo '<script>window.open("category.php","_self")</script>';
    $_SESSION["ErrorMessage"]="Mininum of four(4) Name";
   }
else{
    global $connection;
    $insert = "INSERT INTO admin_panel(title,name,admin,picture,message,datetime) VALUES ('$Title','$Name','$Admin','$image','$Message','$timezone')";
    $Execute = mysqli_query($connection,$insert);
    move_uploaded_file($_FILES['Image']['tmp_name'],$img_target);
    if($Execute){
//      echo '<script>window.open("category.php","_self")</script>';
      $_SESSION["SuccessMessage"]="New Post Added succesfully";  
    }
    else{
        echo "not set";
    }
}
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
              <div class="menu3">
               <h5>Victors Blog</h5>
               <ul class="nav nav-pills nav-stacked" id="aside">
                   <li><a href="Dashboard.php"><i class="fa fa-th-large"></i>&nbsp;Dashboard</a></li>
                   <li class="active"><a href="Addnewpost.php"><i class="fa fa-th-list"></i>&nbsp;Add New Post</a></li>
                   <li><a href="category.php"><i class="fa fa-tags"></i>&nbsp;Categories</a></li>
                   <li><a href="admin.php"><i class="fa fa-user"></i>&nbsp;Manage Admin</a></li>
                   <li><a href="comment.php"><i class="fa fa-comment"></i>&nbsp;Comment
           <!--         display the un-approve comment-->
                  <?php
                             $Query="SELECT COUNT(*) FROM comments WHERE status='off'";
                             $CommentExecute=mysqli_query($connection,$Query);
                             $TotalComment=mysqli_fetch_array($CommentExecute);
                             $DisplayTotalComment=array_shift( $TotalComment);
                            
                             ?>
                               <span class="label label-warning pull-right">
                                   <?=$DisplayTotalComment;?>
                               </span>  
                   </a></li>
                   
                   <li><a href="fullpost.php"><i class="fa fa-server"></i>&nbsp;Live Blog</a></li>
                   <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
               </ul>
               </div>
           </div>
           <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
              <div class="content p-5">
                <h1>Add New Post</h1>
                <div><?php echo errormessage();
                 
                     echo successmessage();?></div>
                <div>
                    <form action="Addnewpost.php" method="post" class="mb-5" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="categories">Title:</label>
                            <input type="text" class="form-control" name="title" id="categories">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Insert your Category Name">
                        </div>
                        <div class="form-group">
                            <label for="">Image:</label>
                            <input type="file" name="Image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="categories">Message:</label>
                        <textarea class="form-control" name="message" rows="4"></textarea>
                        </div>
                        <div>
                        <input type="submit" class="btn btn-danger btn-lg" name="submit" value="Add New Category">
                        </div>
                        
                    </form>
                </div>
                
                 
                  
              </div>
               
           </div>
       </div>
   </div>
   <footer> 
   <div class="footer">
      <div class="sub-footer pt-5">
          <p class="text-center  text-white" id="foot">All Right Reserved........Designed by Jimoh Victor</p>
      </div> 
   </div>
    </footer>
</body>

