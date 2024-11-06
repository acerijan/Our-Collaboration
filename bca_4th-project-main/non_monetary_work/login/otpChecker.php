<?php
session_start();

$otp_inputted;
$user_id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_inputted = $_POST["otp_input"];
}
//test otp match or not
if ($otp_inputted != $_SESSION["OTP"]) {
    $_SESSION["result_message"] = "otp not match";
    $_SESSION["result_color"] = "red";
    header("Location:../../messageBox.php");
    //    echo $_SESSION["OTP"];
    //    echo $otp_inputted;
} else {
    header("Location:passwordform.html");
    exit();
    //send to a form  
}
?>