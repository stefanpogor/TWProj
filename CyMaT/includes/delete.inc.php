<?php

if (isset($_POST['sterge'])){

    require 'database.inc.php';

    $pid= $_POST['id'];

    $sql="DELETE FROM products WHERE pid='".$pid."'";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../html/admin_stocuri_page.php?error=sqlerror");
        exit();
    } else{
        mysqli_stmt_execute($stmt);
        header("Location: ../html/admin_stocuri_page.php?delete=success");
        exit();
    }
} else{
    header("Location: ../html/admin_stocuri_page.php");
    exit();
}