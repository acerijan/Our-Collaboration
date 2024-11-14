<?php
function getNameFromUserId($user_id){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
        die("connection failed");
    }
    $sql=$conn->prepare("SELECT concat(first_name,' ',last_name) as full_name from account_holder where user_id=?");
    $sql->bind_param('i',$user_id);
    $sql->execute();
    $result=$sql->get_result();
    $sql->close();
    $conn->close();
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        return $row["full_name"];
    }else{
        return -1;
    }
}

?>