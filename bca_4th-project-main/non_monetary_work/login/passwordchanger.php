<?php
session_start();
include '../schema_and_register/functions.php';
$user_id = $_SESSION["user_id"];
$password;
//logic for user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["newPass"];
}
//end
$_SESSION["result_heading"] = "Success:";
$_SESSION["result_message"] = changePassword($user_id, $password);
$_SESSION["result_color"] = "#28C76F";
header("Location:../../messageBox.php");
?>