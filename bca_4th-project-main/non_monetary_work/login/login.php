<?php
session_start();

function loginValidation($user_id, $password)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }

    $sql = $conn->prepare("SELECT user_id,password from user where user_id=? and password=?");
    $sql->bind_param('is', $user_id, $password);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    $conn->close();
    if ($result->num_rows == 1) {
        $_SESSION["user_id"] = $user_id;
        header('Location:../../mainPage.php');
        exit();

    } else {
        $_SESSION["result_message"] = "invalid user id or password";
        $_SESSION["result_color"] = "red";
        header("Location:../../messageBox.php");
    }

}
//logic for user input
$user_id;
$password;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userId"];
    $password = $_POST["password"];
}
//end logic
loginValidation($user_id, $password);

?>