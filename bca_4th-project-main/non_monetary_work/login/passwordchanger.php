<?php
session_start();
include '../schema_and_register/functions.php';
$user_id = $_SESSION["user_id"];
$password;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["newPass"];
}
$_SESSION["result_message"] = changePassword($user_id, $password);
$_SESSION["result_color"] = "green";
header("Location:../../messageBox.php");
?>