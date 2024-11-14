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
$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
//delete loan referal
$sql=$conn->prepare("DELETE from loan where user_id=? and status='requesting'");
$sql->bind_param('i',$user_id);
$sql->execute();
$num_rows=$sql->affected_rows;
$sql->close();
$conn->close();
if($num_rows==1)
{   $_SESSION["result_heading"]="Success:";
    $_SESSION["result_message"]="Loan cancelled";
    $_SESSION["result_color"] = "#28C76F";
    header("Location:../../messageBox.php");
}else{
    $_SESSION["result_heading"]="Error:";
    $_SESSION["result_message"]="Approved loans cannot be cancelled";
    $_SESSION["result_color"] = "#E74C3C";
    header("Location:../../messageBox.php");
}

?>