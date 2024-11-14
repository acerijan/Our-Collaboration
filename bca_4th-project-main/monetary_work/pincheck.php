<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Transaction</title>
    <link rel="stylesheet" href="../../css/chill.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=McLaren">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../icons/swift3.png">
    <script src="../../js/script.js"></script>
    <script>
        function validate()
        {
            pin=document.pinform.pin.value;
            return pinValidate(pin);
        }
    </script>
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
    <!--php variables for pin-->
        <?php $pin="";$pinValid="";
        ?>

    <!-- Main container for Confirm Transaction form -->
    <div class="container">
        <div class="fund-transfer-box">
            <h2>Confirm Transaction</h2>
            <form action="" name="pinform" method="post" onsubmit="return validate()">
                <div class="input-box">
                    <label for="enter-code">Enter 4 digit pin code</label>
                    <input type="text" id="enter-code" name="pin" placeholder="Enter exactly 4 digits pin eg: 1234" required>
                </div>

                

                <button type="submit" name="pin-btn" class="btn continue">Continue</button>
                <button type="button" class="btn cancel" onclick="window.location.href='../../mainPage.php'">Cancel</button>
            </form>
        </div>
    </div>
    <!--pin logic test-->
    <?php
    if(isset($_POST["pin-btn"])){
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {   
        $pin=$_POST["pin"];
        $conn=new mysqli('localhost','root','','swift_bank');
        $sql=$conn->prepare("SELECT pin from user where user_id=?");
        $sql->bind_param('i',$user_id);//user id from here is in other document
        $sql->execute();
        $result=$sql->get_result();
        $row=$result->fetch_assoc();
        $conn->close();
    if($row['pin']==$pin){ 
        $pinValid=1;
    }else{
        //session is started in included file
        $_SESSION["result_heading"]="Error:";
        $_SESSION["result_message"]="Pin not matched";
        $_SESSION["result_color"] = "#E74C3C";
        header("Location:../../messageBox.php");
    }
    }
}
    ?>
</body>
</html>