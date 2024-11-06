<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'F:/xampp/htdocs/sendmail/phpmailer/src/Exception.php';
require 'F:/xampp/htdocs/sendmail/phpmailer/src/PHPMailer.php';
require 'F:/xampp/htdocs/sendmail/phpmailer/src/SMTP.php';


function selectingEmailForRegistration($acc_no)
{

    //opening a connection
    $server = "localhost";
    $user = "root";
    $dbpassword = "";
    $db = "swift_bank";
    $conn = new mysqli($server, $user, $dbpassword, $db);

    if ($conn->connect_error) {
        die("connection failed");
    }
    //selecting the citizenship_no
    $sql = $conn->prepare("SELECT citizenship_no from account where acc_no=?");
    $sql->bind_param('i', $acc_no);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $citizenship_no = $row["citizenship_no"];
        }
    } else {
        //echo "you dont have account";
        return -1;//donot execute if no account
    }
    //selecting the email via citizzenship_no
    $sql2 = $conn->prepare("SELECT registered_email from account_holder where citizenship_no=?");
    $sql2->bind_param('i', $citizenship_no);
    $sql2->execute();
    $result2 = $sql2->get_result();
    while ($row = $result2->fetch_assoc()) {
        $registered_email = $row["registered_email"];
    }
    $sql->close();
    $sql2->close();
    $conn->close();
    //closing connection and returning email
    return $registered_email;
}

function sendOTPphp($registered_email)
{
    $otp = rand(100000, 999999);
    $_SESSION["OTP"] = $otp;


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pranavrijanproject@gmail.com';
    $mail->Password = 'tqcchbpouqmqeibk';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('pranavrijanproject@gmail.com');
    $mail->addAddress($registered_email);
    $mail->isHTML(true);
    $mail->Subject = "OTP";
    $mail->Body = $otp;
    $mail->send();

}

function emailViaUserID($user_id)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("SELECT registered_email from account_holder where user_id=?");
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    $conn->close();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $registered_email = $row["registered_email"];
        return $registered_email;
    } else {
        return -1;
    }

}

function changePassword($user_id, $password)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("UPDATE user set password=? WHERE user_id=?");
    $sql->bind_param('si', $password, $user_id);
    if ($sql->execute()) {
        $msg = "password changed successfully";
    }
    $sql->close();
    $conn->close();
    return $msg;
}
function changePin($user_id, $pin)
{
    $conn = new mysqli('localhost', 'root', '', 'swift_bank');
    if ($conn->connect_error) {
        die("connection failed");
    }
    $sql = $conn->prepare("UPDATE user set pin=? WHERE user_id=?");
    $sql->bind_param('ii', $pin, $user_id);
    if ($sql->execute()) {
        $msg = "pin changed successfully";
    }
    $sql->close();
    $conn->close();
    return $msg;
}
?>