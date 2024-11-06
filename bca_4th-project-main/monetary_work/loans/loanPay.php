<?php
session_start();
include '../transactionTableFunction.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}
//get money amount to pay must equal interest and principal lumpsum pay
//end
$amountDue;
//from session
$user_id = $_SESSION["user_id"];
$conn = new mysqli('localhost', 'root', '', 'swift_bank');
if ($conn->connect_error) {
    die("connection failed");
}
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

    if ($pinValid == 1 && isset($_POST["pin"])) {
        $conn = new mysqli('localhost', 'root', '', 'swift_bank');
        $sql = $conn->prepare("UPDATE account set balance=balance-? where user_id=?");//deduct from the account if possible
        $sql->bind_param('ii', $amountDue, $user_id);
        $sql2 = $conn->prepare("DELETE from loan where user_id=?");//remove the loan from table
        $sql2->bind_param('i', $user_id);
        try {
            $sql->execute();
            $sql2->execute();
            putInTransaction($amountDue, null, null, "loan pay", $user_id);//enter as recorded transaction
            $_SESSION["result_message"] = "loan paid";
            $_SESSION["result_color"] = "green";
        } catch (exception $e) {
            $_SESSION["result_message"] = "insufficient balance mimimum balance must be above 1000";
            $_SESSION["result_color"] = "red";
        } finally {
            $sql->close();
            $sql2->close();
            $conn->close();
            header("Location:../../messageBox.php");
        }
    }
} else {
    $_SESSION["result_message"] = "no loans";
    $_SESSION["result_color"] = "#409CFF";
    header("Location:../../messageBox.php");
}
?>