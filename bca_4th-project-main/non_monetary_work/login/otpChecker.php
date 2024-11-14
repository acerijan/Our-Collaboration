<?php
session_start();

$otp_inputted;
$user_id;
//logic for user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_inputted = $_POST["otp_input"];
}
//end

//test otp match or not
if ($otp_inputted != $_SESSION["OTP"]) {
    $_SESSION["result_heading"] = "Error:";
    $_SESSION["result_message"] = "OTP not match";
    $_SESSION["result_color"] = "#E74C3C";
    header("Location:../../messageBox.php");
} else {
    header("Location:passwordform.html");
    exit();
    //send to a form  
}
?>