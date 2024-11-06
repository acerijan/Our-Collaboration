<?php
session_start();
include 'functions.php';


//html to php input data logic

$user_id;
$password;
$pin;
$acc_no;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userId"];
    $_SESSION["user_id"] = $user_id;
    $password = $_POST["password"];
    $_SESSION["password"] = $password;
    $pin = $_POST["pin"];
    $_SESSION["pin"] = $pin;
    $acc_no = $_POST["accNo"];
    $_SESSION["acc_no"] = $acc_no;
}
//end of logic


//some extras
$citizenship_no;
$registered_email = selectingEmailForRegistration($acc_no);
//
if ($registered_email != -1) {
    include 'otpform.php';
} else {
    $_SESSION["result_message"] = "you dont have account";
    $_SESSION["result_color"] = "red";
    header("Location:../../messageBox.php");
}
?>