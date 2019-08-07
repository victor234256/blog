
<?php 
require_once('connection.php');
require_once('session.php');
require_once('errorfuction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>

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
           <div class="col-lg-2 col-md-4 col-sm-6 navbar-fixed">
              <div class="menu3">
               
               <ul class="nav nav-pills nav-stacked" id="aside">
                   <li class="active pt-5"><a href="Dashboard.php"><i class="fa fa-th-large"></i>&nbsp;Dashboard</a></li>
                   <li><a href="Addnewpost.php"><i class="fa fa-th-list"></i>&nbsp;Add New Post</a></li>
                   <li><a href="category.php"><i class="fa fa-tags"></i>&nbsp;Categories</a></li>
                   <li><a href="admin.php"><i class="fa fa-user"></i>&nbsp;Manage Admin</a></li>
                   <li><a href="comment.php"><i class="fa fa-comment"></i>&nbsp;Comment
<!--                   display the un-approve comment-->
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
                   <li><a href="blog.php"><i class="fa fa-server"></i>&nbsp;Live Blog</a></li>
                   <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
               </ul>
               </div>
           </div>
           <div class="col-lg-10 col-md-8 col-sm-6">
              <div class="content p-4">
                <h1>ADMIN PANEL</h1>
                <div><?php echo errormessage();
                 
                     echo successmessage();?></div>
                <div>
                 <h2>About</h2>
                 <div class="table-responsive">
                     <table class="table table-striped table-hover">
                         
                         <tr class="text-center">
                             <th>NO</th>
                             <th>Post Title</th>
                             <th>Date&Time</th>
                             <th>Author</th>
                             <th>Category</th>
                             <th>Banner</th>
                             <th>Comments</th>
                             <th class="text-center">Action</th>
                             <th>Details</th>
                         </tr>
                         <?php 
                         $query = "SELECT * FROM admin_panel";
                         $execute = mysqli_query($connection,$query);
                             $SN = 0;
                         while($data = mysqli_fetch_array($execute)){
                             $id = $data['id'];
                             $Title = $data['title'];
                             $Datetime = $data['datetime'];
                             $Author = $data['admin'];
                             $Category = $data['name'];
                             $Post = $data['message'];
                             $Image = $data['picture'];
                             $SN++;
                         ?>
                         <tr>
                             <td><?php echo $SN; ?></td>
                             <td><?php if(strlen($Title)>10){ $Title = substr($Title,0,10);}
                                 echo $Title."..";?></td>
                             <td><?php if(strlen($Datetime)>10){$Datetime = substr($Datetime,0,10);}
                                 echo $Datetime."..";?></td>
                             <td><?php echo $Author; ?></td>
                            <td><?php if(strlen($Category)>14){$Category = substr($Category,0,14);}
                                 echo $Category."..";?></td>
                             <td><img src="uploadimg/<?php echo $Image; ?>" style="width:150px; height:40px;"></td>
                             <td>
<!--                                 comment codes -->
                                <?php
                             $DashboardCommentId=$id;
                             $Query="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$DashboardCommentId' AND status='on'";
                             $CommentExecute=mysqli_query($connection,$Query);
                             $TotalApproveComment=mysqli_fetch_array($CommentExecute);
                             $DisplayApproveComment=array_shift( $TotalApproveComment);
                            
                             ?>
                               <span class="label label-success pull-right">
                                   <?=$DisplayApproveComment;?>
                               </span>  
<!--                                for the unapprove comment-->
                               <?php
                                $DashboardCommentId=$id;
                             $Query="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$DashboardCommentId' AND status='off'";
                             $CommentExecute=mysqli_query($connection,$Query);
                             $TotalUnapproveComment=mysqli_fetch_array($CommentExecute);
                             $DisplayUnapproveComment=array_shift( $TotalUnapproveComment);
                            
                             ?>
                               <span class="label label-warning pull-left">
                                   <?=$DisplayUnapproveComment;?>
                               </span>  
                                 
                             </td>
                             <td><a href="edit.php?edit=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
                             <a href="delete.php?delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a></td>
                             <td><a href="fullpost.php?id=<?php echo $id; ?>" class="btn btn-primary" target="_blank">Live preview</a></td>
                         </tr>
                         
                     <?php } ?>
                     </table>
                 </div>
               </div>
               
           </div>
       </div>
   </div> 
   <div class="footer">
      <div class="sub-footer pt-5">
          <p class="text-center  text-white" id="foot">All Right Reserved........Designed by Jimoh Victor</p>
      </div> 
   </div>
</body>
</html>