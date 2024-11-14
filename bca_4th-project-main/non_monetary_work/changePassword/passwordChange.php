<?php
session_start();
include '../schema_and_register/functions.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

$user_id=$_SESSION["user_id"];
$password;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $password=$_POST["password"];
}
$msg=changePassword($user_id,$password);
$_SESSION["result_heading"]="Success:";
$_SESSION["result_message"]=$msg;
$_SESSION["result_color"] = "#28C76F";
header("Location:../../messageBox.php");
?>