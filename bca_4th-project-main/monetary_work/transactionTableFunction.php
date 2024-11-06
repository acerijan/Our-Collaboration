<?php
function putInTransaction($amount,$receiver_id,$receiver_accno,$type,$user_id){
    $conn=new mysqli('localhost','root','','swift_bank');
    if($conn->connect_error)
    {
        die("connection failed");
    }
    $date=date('Y-m-d');
    $sql=$conn->prepare("INSERT INTO transaction values(?,?,?,?,?,?)");
    $sql->bind_param('siiisi',$date,$amount,$receiver_id,$receiver_accno,$type,$user_id);
    $sql->execute();
    $sql->close();
    $conn->close();
}
?>