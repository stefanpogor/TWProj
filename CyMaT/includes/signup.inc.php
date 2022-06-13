<?php

if(isset($_POST['signup-submit'])){

    require 'database.inc.php';

    $username= $_POST['name'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $confpassword= $_POST['confpassword'];

    if(empty($username) || empty($email) || empty($password) || empty($confpassword)){
        header("Location: ../html/signup.php?error=emptyfields&name=".$username."&mail=".$email);
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z ]*$/", $username)){
        header("Location: ../html/signup.php?error=invalidmailandname");
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../html/signup.php?error=invalidmail&name=".$username);
        exit();
    } else if(!preg_match("/^[a-zA-Z ]*$/", $username)){
        header("Location: ../html/signup.php?error=invalidname&mail=".$email);
        exit();
    } else if($password !== $confpassword){
        header("Location: ../html/signup.php?error=passwordcheck&name=".$username."&mail=".$email);
        exit();
    } else{
        $sql="SELECT umail FROM users WHERE umail=?";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/signup.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck=mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
                header("Location: ../html/signup.php?error=emailtaken&name=".$username);
                exit();
            } else{
                $sql="INSERT INTO users (unume, umail, upwd) VALUES (?, ?, ?)";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../html/signup.php?error=sqlerror");
                    exit();
                } else{
                    $hashpwd=password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashpwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../html/signup.php?signup=succes");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../html/signup.php");
            exit();
}