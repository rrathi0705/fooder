<?php
    session_start();
    if(isset($_POST['signup'])){    
        include_once '../includes/dbh.inc.php';
        $name=mysqli_real_escape_string($conn,$_POST['user_name']);
        $_SESSION['user_name']=$name;
        $email=mysqli_real_escape_string($conn,$_POST['user_email']);
        $pwd=mysqli_real_escape_string($conn,$_POST['user_password']);
        $sql = "SELECT * FROM users WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        if($resultcheck > 0){
           header("location: ../index.php?signup=emailAlreadyUsed");
            exit(); 
        }
        else{
            $hashpwd = password_hash($pwd,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(user_name,user_email,user_password) VALUES ('$name','$email','$hashpwd');";
            mysqli_query($conn, $sql);
            $_SESSION['user_email']=$email;
            $_SESSION['user_password']=$pwd;
            header("location:../index.php?RegisteredSuccessfully");
            exit();
        }
    }else{
        header("location: ../index.php");
        exit();
    }
?>