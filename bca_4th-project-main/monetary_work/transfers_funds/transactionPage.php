<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Transfer</title>
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
    <?php 
    session_start();
    include '../getNameFromUserId.php';
    include '../getAccNo.php';

    if(!isset($_SESSION["user_id"])){
        $_SESSION["result_message"]="please login";
        $_SESSION["result_color"]="#FFBC11";
        header("Location:../../messageBox.php");
        exit();
    }

    $user_id=$_SESSION["user_id"];
    $user_name=getNameFromUserId($user_id);
    $user_acc_no=getAccNo($user_id);
    $receiver_id;
    $amount;
    $remarks;

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $receiver_id=$_POST["rec_id"];
            $amount=$_POST["amount"];
            $remarks=$_POST["remarks"];
        }
    $receiver_acc_no=getAccNo($receiver_id);
    if($receiver_acc_no==-1)
    {
        $_SESSION["result_message"]="no account exist";
        $_SESSION["result_color"] = "red";
        header("Location:../../messageBox.php");
        exit();
    }
    $receiver_name=getNameFromUserId($receiver_id);
    ?>  
    <!-- Main container for Fund Transfer form -->
    <div class="container">
        <div class="fund-transfer-box">
            <h2>Fund Transfer</h2>
            <form action="moneyTransfer.php" method="post" name="transfer2">
                <div class="input-box">
                    <label for="from-account">From Account</label>
                    <p class="account-number"><b><?=$user_acc_no?></b></p>
                    <p class="account-number">Your ID</p>
                    <input type="text" id="from-account" name="from-account" value="<?=$user_id?>" readonly>
                    
                </div>

                <div class="input-box">
                    <label for="receiver-bank-account">Receiver's Bank Account Number</label>
                    <input type="number" id="receiver-bank-account" name="receiver-bank-account" value="<?=$receiver_acc_no?>" readonly>
                </div>

                <div class="input-box">
                    <label for="receiver-account-Id">Receiver's Account Id</label>
                    <input type="text" id="receiver-account-Id" name="receiver-account-Id" value="<?=$receiver_id?>" readonly>
                </div>

                <div class="input-box">
                    <label for="receiver-account-name">Receiver's Account Name</label>
                    <input type="text" id="receiver-account-name" name="receiver-account-name" value="<?=$receiver_name?>" readonly>
                </div>

                <div class="input-box">
                    <label for="amount">Amount</label>
                    <input type="number" min="10" id="amount" name="amount" value="<?=$amount?>" readonly>
                </div>

                <div class="input-box">
                    <label for="remarks">Remarks</label>
                    <input type="text" id="remarks" name="remarks" value="<?=$remarks?>" readonly>
                </div>

                <button type="submit" class="btn continue" name="continueTransfer">Continue</button>
                <button type="button" class="btn cancel" onclick="window.location.href='../../mainPage.php';">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
