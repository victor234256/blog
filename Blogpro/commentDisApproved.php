<?php 
require("connection.php");
include("session.php");
include("timezone.php");
if(isset($_GET["id"])){
    $UnApproveId=$_GET['id'];
    $Query="UPDATE comments SET status='off' WHERE id='$UnApproveId'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        echo '<script>window.open("comment.php","_self")</script>';
    }
    
    
}
else {
    echo "something went wrong";
}

?>