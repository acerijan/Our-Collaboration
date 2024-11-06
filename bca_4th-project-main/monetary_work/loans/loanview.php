<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Loan</title>
    <link rel="stylesheet" href="../../css/chill.css">
    <script>
        function redirectToPay() {
            window.location.href = "loanPay.php";
        }
        function redirectToCancel() {
            window.location.href = "loanCancel.php";
        }
    </script>
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
    <?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        $_SESSION["result_message"]="please login";
        $_SESSION["result_color"]="#FFBC11";
        header("Location:../../messageBox.php");
        exit();
    }

    //get user id via session
    $user_id = $_SESSION["user_id"];


    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("SELECT * from loan where user_id=?");//display every column of loan for user
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    $conn->close();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        $_SESSION["result_message"] = "no loans";
        $_SESSION["result_color"] = "#409CFF";
        header("Location:../../messageBox.php");
    }
    ?>
    <div class="container">
        <div class="fund-transfer-box">
            <h2>View Loan</h2>
            <form action="#">
                <div class="input-box">
                    <label for="userId">User Id</label>
                    <input type="text" id="UserId" name="userId" value="<?= $user_id ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="loanId">Loan Id</label>
                    <input type="text" pattern="[0-9]{11}" id="LoanId" name="loanId" value="<?= $row["loan_id"] ?>"
                        readonly>
                </div>
                <div class="input-box">
                    <label for="amount">Anount with interest</label>
                    <input type="number" id="amount" name="amount with interest"
                        value="<?= $row["amount_due"] + $row["interest"] ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="loan-status">Loan Status</label>
                    <input type="text" id="loan-status" name="loan-status" value="<?= $row["status"] ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="acc-no">Account no</label>
                    <input type="text" id="acc-no" name="acc-no" value="<?= $row["acc_no"] ?>" readonly>
                </div>
                <button type="button" class="btn continue" onclick="redirectToPay()">Pay loan</button>
                <button type="button" class="btn cancel" onclick="redirectToCancel()">Cancel Loan</button>
            </form>
        </div>
    </div>
</body>

</html>