<?php
    session_start();
    function loginValidationAdmin($username,$password){
        $conn=new mysqli('localhost','root','','swift_bank');
        if($conn->connect_error)
        {
            die("connection failed");
        }

        $sql=$conn->prepare("SELECT username,password from admin where username=? and password=?");
        $sql->bind_param('ss',$username,$password);
        $sql->execute();
        $result=$sql->get_result();
        $sql->close();
        $conn->close();
        if($result->num_rows==1)
        {
            //successful login go to database
            header("Location:http://localhost/phpmyadmin/");
        }else{
            //unsuccessful login go to error
            $_SESSION["result_heading"]="Error:";
            $_SESSION["result_message"] = "Invalid username or password";
            $_SESSION["result_color"] = "#E74C3C";
            header("Location:../messageBox.php");
        }
        
    }
    $username="";$password="";
    //logic for admin input
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $username=$_POST["username"];
        $password=$_POST["password"];
    }
    //end logic
    loginValidationAdmin($username,$password);
?>