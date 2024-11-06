<?php
session_start();
include '../schema_and_register/functions.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
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
$_SESSION["result_message"]=$msg;
$_SESSION["result_color"] = "green";
header("Location:../../messageBox.php");
?>