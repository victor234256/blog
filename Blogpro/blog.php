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

    <div class="container">

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
                    $query="SELECT * FROM admin_panel ORDER BY datetime desc";}
                    $execute=mysqli_query($connection,$query);
                    while($data = mysqli_fetch_array($execute)){

                        $ID = $data['id'];
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
                if(strlen($post)>150){
                    $post=substr($post,0,150);
                }
                        echo $post."....";
                
                ?>
                        <div class="text-right"><a input type="button" class="btn btn-primary" href="fullpost.php?id=<?php echo $ID;?>">Read More>></a></div>
                    </div>
                </div>
                <?php }?>
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
