<?php
session_start();

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}
//code to get email and message
$email;
$message;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = $_POST["message"];
}
//end

$user_id = $_SESSION["user_id"];

$conn = new mysqli('localhost', 'root', '', 'swift_bank');
if ($conn->connect_error) {
    die("connection failed");
}
$sql = $conn->prepare("INSERT into problem values(?,?,?)");
$sql->bind_param('ssi', $email, $message, $user_id);
if ($sql->execute()) {
    $_SESSION["result_heading"] = "Success:";
    $_SESSION["result_message"] = "Your response has been sent";
    $_SESSION["result_color"] = "#28C76F";
} else {
    $_SESSION["result_heading"] = "Error:";
    $_SESSION["result_message"] = "Response not sent";
    $_SESSION["result_color"] = "#E74C3C";
}
$sql->close();
$conn->close();
header("Location:../../messageBox.php");
?>