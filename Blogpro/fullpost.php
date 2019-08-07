<?php 
require("connection.php");
include("session.php");
include("timezone.php");
if(isset($_POST["comment"])){
$Name=mysqli_real_escape_string($connection,$_POST["name"]);
$Email=mysqli_real_escape_string($connection,$_POST["email"]);
$Comment=mysqli_real_escape_string($connection,$_POST["message"]);

if(empty($Name)){
    $_SESSION["ErrorMessage"]="Name field is Required";
//    echo '<script>window.open("category.php","_self")</script>';
}
elseif(strlen($Comment)>1000){
//    echo '<script>window.open("category.php","_self")</script>';
    $_SESSION["ErrorMessage"]="Minimum of 1000 Words";
   }
else{
    $IdFromUrl=$_GET['id'];
    global $connection;
    $insert = "INSERT INTO comments(name,email,comment,datetime,status,admin_panel_id) VALUES ('$Name','$Email','$Comment','$timezone','OFF','$IdFromUrl')";
    $Execute = mysqli_query($connection,$insert);
   if($Execute){
//      echo '<script>window.open("category.php","_self")</script>';
      $_SESSION["SuccessMessage"]="Your Comment has been recorded";  
    }
    else{
        echo "not set";
    }
}
    
}


?>




<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog Site</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blog.css">
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

                    <form action="fullpost.php" method="get" class="navbar-form">
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

    <div class="container">

        <div><?php echo errormessage();
                 
                     echo successmessage();?></div>

        <div class="row">
            <div class="col-sm-7">
                <h1>The Cms Blog</h1>
                <?php 
                    require_once("connection.php");
                    include_once("session.php");
                    include("timezone.php");
                 
                    if(isset($_GET['submit'])){
                        $search = $_GET['search'];
                        $query = "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%' OR name LIKE '%$search%' OR message LIKE '%$search%'";
                    }
                    else{
                    $IDP = $_GET['id'];
                    $query="SELECT * FROM admin_panel WHERE id=$IDP ORDER BY datetime desc";}
                    $execute=mysqli_query($connection,$query);
                    while($data = mysqli_fetch_array($execute)){

                        $I = $data['id'];
                        $Title = $data['title'];
                        $Name = $data['name'];
                        $Admin = $data['admin'];
                        $image = $data['picture'];
                        $post = $data['message'];
                        $time = $data['datetime'];


?>

                <div class="sectionn">
                    <div class="image">
                        <img src="uploadimg/<?php echo $image; ?>" class="thumbnail img-responsive text-center">
                        <h1 class="text-primary"><?php echo $Title;?></h1>
                        <p class="text-danger">Category:<?php echo htmlentities($Name).', '; ?>Posted on:<?php echo htmlentities($time); ?></p>

                        <?php 
                    echo $post."....";
                
                ?>

                    </div>
                    <?php }?>
<!--                    commenentor codes-->
                    <form action="fullpost.php?id=<?php echo  $IDP;?>" method="post" class="mb-5" enctype="multipart/form-data">
                       <p style="margin-top:70px;" class="text-primary">Comments</p>
                        <?php
                            $PostId=$_GET['id'];
                            $Query = "SELECT * FROM comments WHERE admin_panel_id='$PostId' AND status='ON' ";
                            $Execute = mysqli_query($connection,$Query);
                            while($data = mysqli_fetch_array($Execute)){
                                $CommentName = $data['name'];
                                $CommentDatetime = $data['datetime'];
                                $CommentPost = $data['comment'];
                            
                            
                            ?>
                        <div class="commentor mb-5">
                            <img src="images/user-icon.jpg" style="width:75px; height:90px;" class="pull-left py-2">
                            <p class="pleft text-primary"><?php echo $CommentName; ?></p>
                            <p class="pleft"><?php echo $CommentDatetime; ?></p>
                            <p class="pleft"><?php echo $CommentPost; ?></p>
                        </div>
                        <hr>
                        <?php } ?>
                        <h3 class="mt-5 text-danger"><i>Share your thought About The Post</i></h3>

                        <div class="form-group my-4">
                            <label for="categories">Name:</label>
                            <input type="text" class="form-control" name="name" id="categories">
                        </div>
                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="email" class="form-control" name="email" id="">
                        </div>

                        <div class="form-group">
                            <label for="categories">Comment:</label>
                            <textarea class="form-control" name="message" rows="4"></textarea>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-danger btn-lg" name="comment" value="Submit">
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-sm-offset-2 col-sm-3" id="blog-aside">
                <div class="blog-aside">

                    <p> Learning to design a website requires mastering many different skills from organizing the structure of the website, making sure it is easy to use and navigate, to designing the graphics and layout of the information. This web design course concentrates on the fundamentals of building a website. It starts with the basics, using HTML code to build a basic site, giving the learner a solid foundation in how a website is designed. The final section of the web design course introduces the learner to MySql database and php programming. Students will also be introduced to Bootstrap which is a free front-end framework for faster and easier web development.</p>

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