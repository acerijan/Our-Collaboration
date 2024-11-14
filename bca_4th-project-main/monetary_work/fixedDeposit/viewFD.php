<?php
session_start();
if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}
function viewFD($user_id)
{
    $conn = new mysqli("localhost", 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $date = date("Y-m-d");
    $sql = $conn->prepare("SELECT * from fixed_deposit where user_id=?");
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return -1;
    }
}
//get necessary details from database
$row = viewFD($_SESSION["user_id"]);
if ($row == -1) {
    $_SESSION["result_heading"]= "Status:";
    $_SESSION["result_message"] = "No Fixed Deposit";
    $_SESSION["result_color"] = "#409Cff";
    header("Location:../../messageBox.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Fixed Deposit</title>
    <link rel="stylesheet" href="../../css/chill.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=McLaren">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../icons/swift3.png">
</head>

<body>
    <!-- Navigation bar with Swift logo and text -->
    <header>
        <nav class="navbar">
            <div class="nav-logo">
                <img src="../../icons/swift.jpeg" alt="Swift Logo">
                <span id="top">Swift</span>
            </div>
        </nav>
    </header>

    <!-- Main container for View Fixed Deposit form -->
    <div class="container">
        <div class="fund-transfer-box">
            <h2>View Fixed Deposit</h2>
            <form action="#">
                <div class="input-box">
                    <label for="Fd-Id">FD Id</label>
                    <input type="text" id="Fd-Id" name="receiver-bank-account" value="<?= $row["fd_id"] ?>" readonly>
                </div>

                <div class="input-box">
                    <label for="amount">Amount </label>
                    <input type="number" name="receiver-bank-account" value="<?= $row["amount"] ?>" readonly>
                </div>

                <div class="input-box">
                    <label for="interest">Interest</label>
                    <input type="number" id="interest" name="receiver-bank-account" value="<?= $row["interest"] ?>"
                        readonly>
                </div>

                <div class="input-box">
                    <label for="created-date">Creation Date</label>
                    <input type="date" id="created-date" name="receiver-bank-account"
                        value="<?= $row["date_created"] ?>" readonly>
                </div>

                <div class="input-box">
                    <label for="maturity-date">Maturity Date</label>
                    <input type="date" id="maturity-date" name="receiver-bank-account"
                        value="<?= $row["date_matured"] ?>" readonly>
                </div>

                <div class="input-box">
                    <label for="UserId">User Id</label>
                    <input type="text" id="UserId" name="receiver-bank-account" value="<?= $row["user_id"] ?>" readonly>
                </div>

                <div class="input-box">
                    <label for="Acc-No">Account No</label>
                    <input type="text" id="Acc-No" name="receiver-bank-account" value="<?= $row["acc_no"] ?>" readonly>
                </div>

            </form>
        </div>
    </div>
</body>

</html>