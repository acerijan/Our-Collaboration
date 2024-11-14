<?php
session_start();
include '../transactionTableFunction.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

$amountDue;

$user_id = $_SESSION["user_id"];
$conn = new mysqli('localhost', 'root', '', 'swift_bank');
if ($conn->connect_error) {
    die("connection failed");
}
//select total amount to pay from database
$sqlamtDue = $conn->prepare("SELECT amount_due+interest as total_amt from loan where user_id=? and status='approved'");//select total loan with interest
$sqlamtDue->bind_param('i', $user_id);
$sqlamtDue->execute();
$result = $sqlamtDue->get_result();
$sqlamtDue->close();
$conn->close();
if ($result->num_rows == 1) {
    $totalDue = $result->fetch_assoc();
    $amountDue = $totalDue["total_amt"];
    include '../pincheck.php';

    if ($pinValid == 1 && isset($_POST["pin"])) {  //if pin is valid from the included document then do the following
        $conn = new mysqli('localhost', 'root', '', 'swift_bank');
        //deduct from the account if possible
        $sql = $conn->prepare("UPDATE account set balance=balance-? where user_id=?");
        $sql->bind_param('ii', $amountDue, $user_id);
        //remove the loan from table
        $sql2 = $conn->prepare("DELETE from loan where user_id=?");
        $sql2->bind_param('i', $user_id);
        try {
            $sql->execute();
            $sql2->execute();
            //enter as recorded transaction
            putInTransaction($amountDue, null, null, "loan pay", $user_id);
            $_SESSION["result_heading"]="Success:";
            $_SESSION["result_message"] = "loan paid";
            $_SESSION["result_color"] = "#28C76F";
        } catch (exception $e) {
            $_SESSION["result_heading"]="Error:";
            $_SESSION["result_message"] = "Insufficient balance mimimum balance must be above 1000";
            $_SESSION["result_color"] = "#E74C3C";
        } finally {
            $sql->close();
            $sql2->close();
            $conn->close();
            header("Location:../../messageBox.php");
        }
    }
} else {
    $_SESSION["result_heading"]="Status:";
    $_SESSION["result_message"] = "No loans to pay";
    $_SESSION["result_color"] = "#409CFF";
    header("Location:../../messageBox.php");
}
?>