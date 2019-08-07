<?php 
require("connection.php");
include("session.php");
include("timezone.php");
$deleteAdmin=$_GET["deleteAdmin"];
$Query="DELETE FROM admins WHERE id='$deleteAdmin'";
$Execute=mysqli_query($connection,$Query);
if($Execute){
    $_SUCCESS['SuccessMessage']="New Admin Added Successfully";
    echo '<script>window.open("admin.php","_self")</script>';
}



?>