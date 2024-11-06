<?php
session_start();
include '../schema_and_register/functions.php';

//enter userid
$user_id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userId"];
    $_SESSION["user_id"] = $user_id;
}
//end

$registered_email = emailViaUserID($user_id);
if ($registered_email == -1) {
    $_SESSION["result_message"] = "there is no user id";
    $_SESSION["result_color"] = "red";
    header("Location:../../messageBox.php");
    exit();
}
include '../schema_and_register/otpform.php';
?>