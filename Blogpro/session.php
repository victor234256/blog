<?php 
session_start();
function errormessage(){
    if(isset($_SESSION['ErrorMessage'])){
        $print="<div class=\"alert alert-danger\">";//adding \ make it to escape those qoute since we cannot add thesame qoute inside themselves, and alert is a bootstrap styling.
        $print.=htmlentities($_SESSION['ErrorMessage']);
        $print.="</div>";// the reason for this is that in every place this function is called it authomatically add the styling to it itself.
        $_SESSION['ErrorMessage'] = null;//this will prevent it from echoing by default except the button is clicked.
        return $print;
    }
}
//errormessage end
//success message begin
function successmessage(){
    if(isset($_SESSION['SuccessMessage'])){
        $print="<div class=\"alert alert-success\">";//adding \ make it to escape those qoute since we cannot add thesame qoute inside themselves, and alert is a bootstrap styling.
        $print.=htmlentities($_SESSION['SuccessMessage']);//htmlentities mean the html parameter the will be pass inside.
        $print.="</div>";// the reason for this is that in every place this function is called it authomatically add the styling to it itself.
        $_SESSION['SuccessMessage'] =null;//this will prevent it from echoing by default except the button is clicked.
        return $print;
    }
}




?>