<?php
//logic to see if user wants to cancel loan html from another page
//end
session_start();

if(!isset($_SESSION["user_id"])){
    $_SESSION["result_message"]="please login";
    $_SESSION["result_color"]="#FFBC11";
    header("Location:../../messageBox.php");
    exit();
}

//from session
$user_id=$_SESSION["user_id"];
$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sql=$conn->prepare("DELETE from loan where user_id=? and status='requesting'");//delete loan referal
$sql->bind_param('i',$user_id);
$sql->execute();
$num_rows=$sql->affected_rows;
$sql->close();
$conn->close();
if($num_rows==1)
{
    $_SESSION["result_message"]="loan cancelled";
    $_SESSION["result_color"] = "green";
    header("Location:../../messageBox.php");
}else{
    $_SESSION["result_message"]="approved loans cannot be cancelled";
    $_SESSION["result_color"] = "red";
    header("Location:../../messageBox.php");
}

?>