
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
                   <li class="pt-5"><a href="Dashboard.php"><i class="fa fa-th-large"></i>&nbsp;Dashboard</a></li>
                   <li><a href="Addnewpost.php"><i class="fa fa-th-list"></i>&nbsp;Add New Post</a></li>
                   <li><a href="category.php"><i class="fa fa-tags"></i>&nbsp;Categories</a></li>
                   <li><a href="admin.php"><i class="fa fa-user"></i>&nbsp;Manage Admin</a></li>
                   <li class="active"><a href="comment.php"><i class="fa fa-comment"></i>&nbsp;Comment</a></li>
                   <li><a href="blog.php"><i class="fa fa-server"></i>&nbsp;Live Blog</a></li>
                   <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
               </ul>
               </div>
           </div>
           <div class="col-lg-10 col-md-8 col-sm-6">
              <div class="content p-4">
                <h1>UN-APPROVE COMMENT</h1>
                <div><?php echo errormessage();
                 
                     echo successmessage();?></div>
                <div>
                 <div class="table-responsive">
                     <table class="table table-striped table-hover">
                         
                         <tr class="text-center">
                             <th>NO</th>
                             <th>Name</th>
                             <th>Date&Time</th>
                             <th>Comments</th>
                             <th>Approve</th>
                             <th>Delete Comment</th>
                             <th>Details</th>
                             
                         </tr>
                         <?php 
                         $query = "SELECT * FROM comments WHERE status='OFF'";
                         $execute = mysqli_query($connection,$query);
                             $SN = 0;
                         while($data = mysqli_fetch_array($execute)){
                             $CommentId = $data['id'];
                             $Name = $data['name'];
                             $Datetime = $data['datetime'];
                             $Comment = $data['comment'];
                            
                             $SN++;
                         ?>
                         <tr>
                             <td><?php echo $SN; ?></td>
                             <td><?php 
                                 echo $Name;?></td>
                             <td><?php
                                 echo $Datetime;?></td>
                            <td><?php 
                                 echo $Comment;?></td>
                                 <td><a href="commentApproved.php?id=<?php echo $CommentId;?>" class="btn btn-success" name="approve">Approve</a></td>
                                 <td class="text-center"><a href="commentdelete.php?commentdel=<?php echo $CommentId; ?>" class=" text-center btn btn-danger">Delete</a></td>
                             <td><a href="fullpost.php?id=<?php echo $CommentId; ?>" class="btn btn-primary" target="_blank">Live preview</a></td>
                         </tr>
                         
                     <?php } ?>
                     </table>
                 </div>
                 
                 
<!--                 The Approved comment table-->
                             <h1>APPROVED COMMENT</h1>

              <div class="table-responsive">
                     <table class="table table-striped table-hover">
                         
                         <tr class="text-center">
                             <th>NO</th>
                             <th>Name</th>
                             <th>Date&Time</th>
                             <th>Comments</th>
                             <th>Approved by</th>
                             <th>Un-Approve</th>
                             <th>Delete Comment</th>
                             <th>Details</th>
                             
                         </tr>
                         <?php 
                         $query = "SELECT * FROM comments WHERE status='ON'";
                         $execute = mysqli_query($connection,$query);
                             $SN = 0;
                         $Admin="Jimoh Victor";
                         while($data = mysqli_fetch_array($execute)){
                             $CommentId = $data['id'];
                             $Name = $data['name'];
                             $Datetime = $data['datetime'];
                             $Comment = $data['comment'];
                            
                             $SN++;
                         ?>
                         <tr>
                             <td><?=$SN; ?></td>
                             <td><?=$Name;?></td>
                             <td><?=$Datetime;?></td>
                            <td><?=$Comment;?></td>
                                 <td><?=$Admin;?></td>
                                 <td><a href="commentDisApproved.php?id=<?=$CommentId;?>" class="btn btn-warning">Dis-approve</a></td>
                                 <td class="text-center"><a href="commentdelete.php?commentdel=<?=$CommentId; ?>" class="text-center btn btn-danger">Delete</a></td>
                             <td><a href="fullpost.php?id=<?=$CommentId; ?>" class="btn btn-primary" target="_blank">Live preview</a></td>
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