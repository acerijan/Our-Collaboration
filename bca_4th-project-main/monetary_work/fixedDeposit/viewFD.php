<?php
session_start();
if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
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
        return false;
    }
}

$row = viewFD($_SESSION["user_id"]);
if ($row == false) {
    $_SESSION["result_message"] = "no fd";
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
</head>

<body>
    <!-- Navigation bar with Swift logo and text -->
    <header>
        <nav class="navbar">
            <div class="nav-logo">
                <img src="../../icons/swift2.jpeg" alt="Swift Logo">
                <span>Swift</span>
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