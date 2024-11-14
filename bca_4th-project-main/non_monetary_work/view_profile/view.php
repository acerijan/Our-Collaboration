

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../css/chill.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=McLaren">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../icons/swift3.png">
    <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=Manrope:wght@200..800a">
    <style>
            .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        background-color: #409CFF;
        color: white;
        height: 50px;;
    }
    </style>
</head>
<?php
session_start();

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

$user_id=$_SESSION["user_id"];
function getDetailsHolder($user_id){
        $conn=new mysqli("localhost","root","","swift_bank");
        if($conn->connect_error)
        {
            die("connection failed");
        }
        $sql=$conn->prepare("SELECT * from account_holder where user_id=?");
        $sql->bind_param("i",$user_id);
        $sql->execute();
        $result=$sql->get_result();
        $row=$result->fetch_assoc();
        return $row;
}
$details= getDetailsHolder($user_id);
$fname=$details["first_name"];
$lname=$details["last_name"];
$dob=$details["date_of_birth"];
$address=$details["address"];
$citizen_no=$details["citizenship_no"];
?>
<body>
    <!-- Navigation bar with Swift logo and logout -->
    <header>
        <nav class="navbar">
            <div class="nav-logo">
                <img src="../../icons/swift.jpeg" alt="Swift Logo">
                <span>Swift Bank</span>
            </div>
            
           
        </nav>
    </header>

    <!-- Main container for account info and actions -->
    
        <!-- Container for editing options -->

        <div class="container">
        <div class="fund-transfer-box">
            <h2>Personal Details</h2>
            <form action="#">
                <div class="input-box">
                    <label for="rec_id">Full Name </label>
                    <p><?=$fname?> <?=$lname?></p>
                </div>
                <div class="input-box">
                    <label for="rec_id">DOB</label>
                    <p><?=$dob?></p>
                </div>
                <div class="input-box">
                    <label for="rec_id">Citizenship</label>
                    <p><?=$citizen_no?></p>
                </div>
                <div class="input-box">
                    <label for="rec_id">Address</label>
                    <p><?=$address?></p>
                </div>
                <div class="input-box">
                    <label for="rec_id">User Id</label>
                    <p><?=$user_id?></p>
                </div>
                

                <button type="button" class="btn continue" onclick="window.location.href='../changePassword/passwordChange.html'">Change Password</button><br> <br>
                <button type="button" class="btn continue" onclick="window.location.href='../changePin/pinChange.html';">Change Pin</button>
            </form>
        </div>
    </div>
   
</body>
</html>
