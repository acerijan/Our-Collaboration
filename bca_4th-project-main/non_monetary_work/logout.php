<?php
session_start();

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../messageBox.php");
    exit();
}
session_destroy();
header("Location:login/login.html");
?>