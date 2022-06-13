<?php

if(isset($_POST['login-submit'])){

    require 'database.inc.php';

    $email=$_POST['email'];
    $password=$_POST['password'];

    if(empty($email) || empty($password)){
        header("Location: ../html/login.php?error=emptyfields");
        exit();
    } else{
        $sql="SELECT * FROM users WHERE umail=?";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/login.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($results)){
                $pwdcheck=password_verify($password, $row['upwd']);
                if($pwdcheck == false){
                    header("Location: ../html/login.php?error=wrongpwd");
                    exit();
                } else if ($pwdcheck == true){
                    session_start();
                    $_SESSION['userid'] = $row['uid'];
                    $_SESSION['username'] = $row['unume'];
                    if ($_SESSION['username']=='admin'){
                        header("Location: ../html/admin_cereri_page.php?succes");
                        exit();
                    } else {
                    header("Location: ../html/clientpage.php?login=succes");
                    exit();
                    }
                } else{
                    header("Location: ../html/login.php?error=wrongpwd");
                    exit();
                }
            } else{
                header("Location: ../html/login.php?error=nouser");
                exit();
            }
        }
    }

} else{
    header("Location: ../html/login.php");
    exit();
}