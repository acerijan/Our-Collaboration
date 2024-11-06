<?php
session_start();

include '../getAccNo.php';
include '../transactionTableFunction.php';
include '../balanceAlter.php';


if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

$user_id = $_SESSION["user_id"];

//get user inputs
$amount;
$receiver_id;
$type;
$receiver_acc_no;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["continueTransfer"])) {
    $_SESSION["amount"] = $_POST["amount"];
    $_SESSION["remarks"] = $_POST["remarks"];
    $_SESSION["receiver-account-Id"] = $_POST["receiver-account-Id"];
    $_SESSION["receiver-bank-account"] = $_POST["receiver-bank-account"];
}
$amount = $_SESSION["amount"];
$type = $_SESSION["remarks"];
$receiver_id = $_SESSION["receiver-account-Id"];
$receiver_acc_no = $_SESSION["receiver-bank-account"];
//end

//pin enter in form
include '../pincheck.php';
//end
if ($pinValid == 1 && isset($_POST["pin"])) { //if pin is valid from the included document then do the following
    try {
        deductFromAccount($user_id, $amount);
        addToAccount($receiver_id, $amount);
        putInTransaction($amount, $receiver_id, $receiver_acc_no, $type, $user_id);
        $_SESSION["result_message"] = "transfer success";
        $_SESSION["result_color"] = "green";
    } catch (exception $e) {
        $_SESSION["result_message"] = "insufficient minimum balance for transfer 1000 must be left";
        $_SESSION["result_color"] = "red";
    } finally {
        unset($_SESSION["amount"]);
        unset($_SESSION["remarks"]);
        unset($_SESSION["receiver-account-Id"]);
        unset($_SESSION["receiver-bank-account"]);
        header("Location:../../messageBox.php");
    }
}



?>