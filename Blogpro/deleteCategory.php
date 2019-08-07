<?php 
require("connection.php");
include("session.php");
include("timezone.php");
$deleteCategory=$_GET["deleteCategory"];
$Query="DELETE FROM category WHERE id='$deleteCategory'";
$Execute=mysqli_query($connection,$Query);
if($Execute){
    $_SUCCESS['SuccessMessage']="Category Added Successfully";
    echo '<script>window.open("category.php","_self")</script>';
}



?>