<?php
function getAccNo($user_id){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
        die("connection failed");
    }
    $sql=$conn->prepare("SELECT acc_no from account where user_id=?");
    $sql->bind_param('i',$user_id);
    $sql->execute();
    $result=$sql->get_result();
    $sql->close();
    $conn->close();
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        return $row["acc_no"];
    }else{
        return -1;
    }
}
?>