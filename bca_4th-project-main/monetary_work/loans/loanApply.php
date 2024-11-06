<?php
session_start();

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}
function getAccNo($user_id)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("SELECT acc_no from account where user_id=?");
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $sql->close();
    $conn->Close();
    return $row["acc_no"];

}
//user id form session let
$user_id = $_SESSION["user_id"];

//get loan amount 
$amount;
//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];
}
$interest = $amount * 10 / 100;
$acc_no = getAccNo($user_id);


$conn = new mysqli('localhost', 'root', '', 'swift_bank');
if ($conn->connect_error) {
    die("connection failed");
}
$sql2 = $conn->prepare("INSERT into loan(amount_due,interest,status,user_id,acc_no) values(?,?,'requesting',?,?)");//insert loan referal
$sql2->bind_param('iiii', $amount, $interest, $user_id, $acc_no);
try {
    $sql2->execute();
    $_SESSION["result_message"] = "loan request sent";
    $_SESSION["result_color"] = "green";
} catch (exception $e) {
    $_SESSION["result_message"] = "loan request cannot be sent <br> if you already have a loan request or pending payment then you cannot apply for more <br>
     if you donot have any loans please refer to bank";
     $_SESSION["result_color"] = "red";
} finally {
    $sql2->close();
    $conn->close();
    header("Location:../../messageBox.php");
}

?>