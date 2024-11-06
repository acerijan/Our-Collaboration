<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer History</title>
    <link rel="stylesheet" href="../../css/chillistyle.css">
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
    include '../getAccNo.php';
    
    if(!isset($_SESSION["user_id"])){
        $_SESSION["result_message"]="please login";
        $_SESSION["result_color"]="#FFBC11";
        header("Location:../../messageBox.php");
        exit();
    }
    
    $date;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST["date"];
    }
    $user_id = $_SESSION["user_id"];
    //end
    
    $conn = new mysqli("localhost", 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("SELECT * from transaction where (user_id=? or receiver_id=?) and date_of_transaction=?");
    $sql->bind_param('iis', $user_id, $user_id, $date);
    $sql->execute();
    $result = $sql->get_result();
    ?>


    <!-- Main container for Transfer History -->
    <div class="container">
        <div class="transfer-history-box">
            <h2>Transfer History</h2>

            <!-- Transfer History List -->
            <div class="transaction-list">

                <?php
                if ($result->num_rows >= 1) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                    <div class="transaction-item">
                        <div class="icon">
                            <img src="transaction-icon.png" alt="Transaction Icon">
                        </div>
                        <div class="transaction-details">
                            <div class="description">
                                <strong>' . $row["transaction_type"] . '</strong>
                                <p>ID:' . ($row["receiver_id"] == $user_id ? $row["user_id"] : $row["receiver_id"]) . '</p>
                                <p>Acc_no:' . ($row["receiver_id"] == $user_id ? getAccNo($row["user_id"]) : $row["receiver_acc_no"]) . '</p>
                            </div>
                            <div class="amount-status">
                                <span class="amount">NRs.' . $row["amount"] . '</span>
                                <span class="status paid">' . ($row["receiver_id"] == $user_id ? 'received' : 'paid') . '<!--paid or received--></span>
                                <span class="date-time">' . $row["date_of_transaction"] . '</span>
                            </div>
                        </div>
                    </div>
                ';
                    }
                } else {
                    echo "<p style='text-align:center;font-weight:bold;'>no transactions in this date</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>