<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Transaction</title>
    <link rel="stylesheet" href="../../css/chill.css">
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
                <img src="../../icons/swift2.jpeg" alt="Swift Logo">
                <span>Swift</span>
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
                <button type="button" class="btn cancel" onclick="window.location.href='F:/xaamp/htdocs/project_4th/mainPage.php'">Cancel</button>
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
        $_SESSION["result_message"]="pin not matched";
        $_SESSION["result_color"] = "red";
        header("Location:../../messageBox.php");
    }
    }
}
    ?>
</body>
</html>




<!--

<html>
    <head>
        <script>
            function validate(){
                patt=/^[0-9]{4}$/;
                a=document.pinform.pin.value;
                if(!patt.test(a))
            {
                alert("pin must be 4 digit number");
                return false;
            }
            }
        </script>
    </head>
    <body>
        <?php
            //this document will be included in others so user_id will be present in the other documents
       /*     $pin="";
            $pinValid="";
        ?>
        <form name="pinform" method="post" action="" onsubmit="return validate()">
            Enter Pin:<input type="text"  name="pin" required> <br>
            <input type="submit" value="submit">
        </form>
        <?php

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
        die("pin not matched");
    }
    }

    */
?>
    </body>
</html>
-->