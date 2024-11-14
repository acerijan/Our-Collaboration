<?php
session_start();
include 'monetary_work/getNameFromUserId.php';

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:messageBox.php");
    exit();
}

$user_id = $_SESSION["user_id"];
function getInfo($user_id)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("SELECT acc_no,balance from account where user_id=?");
    $sql->bind_param("i", $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    return $row;
}
$name = getNameFromUserId($user_id);
$info = getInfo($user_id);
$balance = $info["balance"];
$acc_no = $info["acc_no"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swift Bank Dashboard</title>
    <link rel="stylesheet" href="css/chilli.css">
    <link rel="icon" type="image/png" href="icons/swift3.png">
</head>

<body>
    <!-- Navigation bar with Swift logo and logout -->
    <header>
        <nav class="navbar">
            <div class="nav-logo">
                <img src="icons/swift.jpeg" alt="Swift Logo">
                <span>Swift Bank</span>
            </div>
            <div class="logout">
                <a href="non_monetary_work/logout.php">Logout <img src="icons/logout.jpeg" height="20ox" width="20px"
                        alt="↪"></a>

            </div>

        </nav>
    </header>

    <!-- Main container for account info and actions -->
    <div class="container">
        <!-- Account Info -->
        <div class="user-profile">
            <div class="user-icon">
                <img src="icons/user.jpeg" alt="User Icon">
            </div>
            <p class="user-name"><?= $name ?></p>
        </div>

        <div class="account-details">
            <p><span id="account-number-display">xxxxxxxxxxxx</span></p>
            <p>
                <span id="amount-display">NPR XXX.XX</span>
                <span class="hide-amount" id="toggle-visibility"><img src="icons/eyeOff.jpeg" alt="👁️" height="20px"
                        width="20px"></span>
            </p>
        </div>
    </div>

    <!-- Action Grid -->
    <div class="actions-grid">
        <a href="non_monetary_work/view_profile/view.php" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/viewAccount.jpeg" alt="View Profile">
                <p>View Profile</p>
            </div>
        </a>
        <a href="monetary_work/transfers_funds/transaction1.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/transferFunds.jpeg" alt="Transfer Funds">
                <p>Transfer Funds</p>
            </div>
        </a>
        <a href="monetary_work/walletLoad/walletTransaction.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/walletLoad.jpeg" alt="Wallet Load">
                <p>Wallet Load</p>
            </div>
        </a>
        <a href="monetary_work/emicalculate/emi.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/calculateEMI.jpeg" alt="Calculate EMI">
                <p>Calculate EMI</p>
            </div>
        </a>
        <a href="non_monetary_work/problems/problem.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/customerCare.jpeg" alt="Customer Care">
                <p>Customer Care</p>
            </div>
        </a>
        <a href="monetary_work/fixedDeposit/fdChoices.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/deposit.jpeg" alt="Deposit">
                <p>Fixed Deposit</p>
            </div>
        </a>
        <a href="monetary_work/history/selectDate.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/transferFunds.jpeg" alt="Transaction History">
                <p>Transaction History</p>
            </div>
        </a>
        <a href="monetary_work/loans/loanChoices.html" style="text-decoration: none;">
            <div class="action-item">
                <img src="icons/loanstatus.jpeg" alt="Loan Status">
                <p>Loans</p>
            </div>
        </a>
    </div>
    </div>
    <script>

        const toggleButton = document.getElementById('toggle-visibility');
        const amountDisplay = document.getElementById('amount-display');
        const accountNumberDisplay = document.getElementById('account-number-display');

        // Actual values (from backend)
        const actualAmount = "NPR <?= $balance ?>.00";
        const hiddenAmount = "NPR XXX.XX";
        const actualAccountNumber = <?= $acc_no ?>; 
        const hiddenAccountNumber = "xxxxxxxxxxxx";

        let isHidden = true;

        toggleButton.addEventListener('click', function () {


            if (isHidden) {
                amountDisplay.textContent = actualAmount;
                accountNumberDisplay.textContent = actualAccountNumber;
                toggleButton.innerHTML = '<img src="icons/eyeOn.jpeg" alt="lock" style="width: 20px; height: 20px;">';
            } else {
                amountDisplay.textContent = hiddenAmount;
                accountNumberDisplay.textContent = hiddenAccountNumber;
                toggleButton.innerHTML = '<img src="icons/eyeOff.jpeg" alt="lock" style="width: 20px; height: 20px;">';
            }
            isHidden = !isHidden;



        });



    </script>
</body>

</html>