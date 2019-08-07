<?php 
require("connection.php");
include("session.php");
include("timezone.php");
$DeleteId=$_GET['delete'];
$Query = "DELETE FROM admin_panel WHERE id='$DeleteId'";
$Execute = mysqli_query($connection,$Query);

if($Execute){
    $_SUCCESS['ErrorMessage']="Post Deleted Successfully";
echo '<script>window.open("Dashboard.php","_self")</script>';
}
?>