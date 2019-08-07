<?php 
require("connection.php");
include("session.php");
include("timezone.php");
if(isset($_GET["id"])){
    $ApproveId=$_GET['id'];
    $Query="UPDATE comments SET status='on' WHERE id='$ApproveId'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        echo '<script>window.open("comment.php","_self")</script>';
    }
    
    
}
else {
    echo "something went wrong";
}

?>