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
$pin;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $pin=$_POST["pin"];
}
$msg=changePin($user_id,$pin);
$_SESSION["result_message"]=$msg;
$_SESSION["result_color"] = "red";
header("Location:../../messageBox.php");
?>