<?php 
require_once("connection.php");
include_once("session.php");
include("timezone.php");
//include("errorfuction.php");
if(isset($_POST["submit"])){
$Username=mysqli_real_escape_string($connection,$_POST["username"]);
$Password=mysqli_real_escape_string($connection,$_POST["password"]);
$ConfirmPassword=mysqli_real_escape_string($connection,$_POST["confirmpassword"]);
if(empty($Username || $Password || $ConfirmPassword)){
    $_SESSION["ErrorMessage"]="All field must be Filled";
//    echo '<script>window.open("category.php","_self")</script>';
}
elseif(strlen($Password)<4){
    //echo '<script>window.open("category.php","_self")</script>';
    $_SESSION["ErrorMessage"]="Password must Atleast be 4 character";
   }
elseif($Password !== $ConfirmPassword){
    $_SESSION["ErrorMessage"]="Password Does Not Match";
}
else{
    global $connection;
    $insert = "INSERT INTO admins(datetime,username,password,confirmpassword) VALUES ('$timezone','$Username','$Password','$ConfirmPassword')";
    $Execute = mysqli_query($connection,$insert);
    if($Execute){
//      echo '<script>window.open("category.php","_self")</script>';
      $_SESSION["SuccessMessage"]="New Admin Added succesfully";  
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
    <title>Manage Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
  
   <div>
        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="blog.php"><img src="images/customize.png" style="width:50px;margin-top:-15px;"></a>

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                        <!--        <span class="sr-only">toogle navigation</span>-->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">

                        <li><a href="#">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Features</a></li>


                    </ul>
                    <form action="Blog.php" method="get" class="navbar-form">
                        <div class="form-group navbar-right">
                            <span><input type="submit" class="btn btn-secondary" value="Search" name="submit"></span>
                            <input type="text" name="search" class="form-control">
                        </div>


                    </form>
                   
                </div>
            </div>
        </div>
        <div style="height:7px;background-color:red;margin-top:-20px;"></div>
    </div>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
              <div class="menu3">
               <h5>Victors Blog</h5>
               <ul class="nav nav-pills nav-stacked" id="aside">
                   <li><a href="Dashboard.php"><i class="fa fa-th-large"></i>&nbsp;Dashboard</a></li>
                   <li><a href="Addnewpost.php"><i class="fa fa-th-list"></i>&nbsp;Add New Post</a></li>
                   <li><a href="category.php"><i class="fa fa-tags"></i>&nbsp;Categories</a></li>
                   <li class="active"><a href="admin.php"><i class="fa fa-user"></i>&nbsp;Manage Admin</a></li>
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
                <h2 class="mb-5">Manage Admin</h2>
                <div><?php echo errormessage();
                 
                     echo successmessage();?></div>
                <div>
                    <form action="admin.php" method="post" class="mb-5">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="confirm your password">
                        </div>
                        <div>
                        <input type="submit" class="btn btn-danger btn-lg" name="submit" value="Add New Admin">
                        </div>
                        
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>S/N</th>
                            <th>Username</th>
                            <th>AddedBy</th>
                            <th>Date&amp;Time</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $select_into="SELECT * FROM admins";
                        $Query=mysqli_query($connection,$select_into);
                        $SN=0;
                        $AddedBy="Jimoh Victor";
                        while($data=mysqli_fetch_array($Query)){
                            $AdminId = $data['id'];
                            $Username = $data['username'];
                            $Datetime = $data['datetime'];
                            $SN++;
                        
                        ?>
                        <tr>
                            <td><?php echo $SN;?></td>
                            <td><?php echo $Username;?></td>
                            <td><?php echo $AddedBy;?></td>
                            <td><?php echo $Datetime;?></td>
                            <td><a class="btn btn-danger" href="deleteAdmin.php?deleteAdmin=<?=$AdminId;?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </table>
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

