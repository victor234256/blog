<?php 
function re_direct($newLocation){
    header("Location :" . $newLocation);
    exit;
}


?>