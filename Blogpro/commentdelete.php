<?php 
require("connection.php");
include("session.php");
include("timezone.php");
$commentDeleteId=$_GET["commentdel"];
$Query="DELETE FROM comments WHERE id='$commentDeleteId'";
$Execute=mysqli_query($connection,$Query);
if($Execute){
    $_SUCCESS['SuccessMessage']="Comment Successfully Deleted";
    echo '<script>window.open("comment.php","_self")</script>';
}



?>