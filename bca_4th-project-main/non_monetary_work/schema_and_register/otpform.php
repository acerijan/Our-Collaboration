<?php sendOTPphp($registered_email); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OTP Form</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=McLaren">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../icons/swift3.png">
    <script>
        function sendotp() {
            window.location.reload();
        }
        function validate() {
            //validate empty otp
            a = document.otp_form.otp_input.value;
            pattern = /^[0-9]{6}$/;
            if (!a.match(pattern)) {
                alert("enter valid otp");
                return false;
            }
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
    <!-- the otp form-->
    <div class="container">
    <div class="background-box"></div>
        <div class="login-box">
            <div class="logo">
                <img src="../../icons/swift2.jpeg" alt="Swift Logo">
            </div>
            <h2>Enter OTP</h2>
            <form name="otp_form" method="post" action="otpChecker.php" onsubmit="return validate()">
                <div class="input-box">
                    <input type="text" name="otp_input" placeholder="enter 6 digit OTP just sent to mail"
                    maxlength="6" required>
                </div>
                <input type="submit" class="btn" value="Submit">
                <a href="#" class="resend" style="text-align:center;" onclick="sendotp()">Resend OTP</a>
            </form>
        </div>
    </div>
</body>

</html>