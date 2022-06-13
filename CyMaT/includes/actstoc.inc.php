<?php

if (isset($_POST['actstocbtn'])){

    require 'database.inc.php';

    $newstoc= $_POST['stoc'];
    $pid= $_POST['id'];

    if(empty($newstoc)){
        header("Location: ../html/admin_stocuri_page.php?error=emptyfields");
        exit();
    } else{
        $sql="UPDATE products SET pcount='".$newstoc."' WHERE pid='".$pid."'";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_stocuri_page.php?error=sqlerror");
            exit();
        } else{
            #mysqli_stmt_bind_param($stmt, "ssii", $prodname, $prodfurn, $prodprice, $prodcount);
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