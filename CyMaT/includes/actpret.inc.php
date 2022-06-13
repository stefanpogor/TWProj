<?php

if (isset($_POST['actpretbtn'])){

    require 'database.inc.php';

    $newprice= $_POST['pret'];
    $pid= $_POST['id'];

    if(empty($newprice)){
        header("Location: ../html/admin_stocuri_page.php?error=emptyfields");
        exit();
    } else{
        $sql="UPDATE products SET pprice='".$newprice."' WHERE pid='".$pid."'";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_stocuri_page.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_execute($stmt);
            header("Location: ../html/admin_stocuri_page.php?update=success");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("Location: ../html/admin_stocuri_page.php");
    exit();
}