<?php 
    function deductFromAccount($user_id,$amount){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
    die("connection failed");
    }
    $sql=$conn->prepare("UPDATE account set balance=balance-? where user_id=?");
    $sql->bind_param('ii',$amount,$user_id);
    $sql->execute();
    $conn->close();
}

function addToAccount($user_id,$amount){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
    die("connection failed");
    }
    $sql=$conn->prepare("UPDATE account set balance=balance+? where user_id=?");
    $sql->bind_param('ii',$amount,$user_id);
    $sql->execute();
    $conn->close();
}
?>