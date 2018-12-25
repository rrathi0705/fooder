<?php
session_start();
if(isset($_POST['login'])){
    include '../includes/dbh.inc.php';
    $email = mysqli_real_escape_string($conn,$_POST['user_email']);
    $pwd = mysqli_real_escape_string($conn,$_POST['user_password']);
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn,$sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck < 1){
        header("Location: ../index.php?login=nosuchemail");
        exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
            //echo password_hash($pwd,PASSWORD_DEFAULT);
            $hashedpwdCheck = password_verify($pwd,$row['user_password']);
            if($hashedpwdCheck == false){
                header("Location: ../index.php?login=InvalidPassword");
                exit(); 
            }
            else if($hashedpwdCheck == true){
                $sqlactivate = "SELECT * FROM users WHERE user_email='$email'";
                $result = mysqli_query($conn,$sqlactivate);
                if($row = mysqli_fetch_assoc($result)){
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['user_email'] = $row['user_email'];
                    header("Location: ../userLoggedIn.php?login=success");
                    exit();
                }
            }
        }
    }
}else{
    header("Location: ../index.php?login=error");
    exit();
}

