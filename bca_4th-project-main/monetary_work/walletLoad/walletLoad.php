<?php
session_start();
include '../getAccNo.php';
include '../balanceAlter.php';
include '../transactionTableFunction.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

$user_id = $_SESSION["user_id"];
//input from user

$amount;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["walletContinue"])) {
    $_SESSION["amountWallet"] = $_POST["amount"];
}
//end
$amount = $_SESSION["amountWallet"];
$acc_no = getAccNo($user_id);

//pin enter in form
include '../pincheck.php';
//end
if ($pinValid == 1 && isset($_POST["pin"])) { //if pin is valid from the included document then do the following
    try {
        deductFromAccount($user_id, $amount);
        putInTransaction($amount, null, null, "wallet load", $user_id);
        $_SESSION["result_heading"]="Success:";
        $_SESSION["result_message"] = "Wallet has been loaded check the transaction history";
        $_SESSION["result_color"] = "#28C76F";
    } catch (exception $e) {
        $_SESSION["result_heading"]="Error:";
        $_SESSION["result_message"] = "Unable to load wallet minimum balance of 1000 must be maintained";
        $_SESSION["result_color"] = "#E74C3C";
    } finally {
        unset($_SESSION["amountWallet"]);
        header("Location:../../messageBox.php");
    }
}

?>