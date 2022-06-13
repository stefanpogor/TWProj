<?php

if (isset($_POST['addproductbtn'])){

    require 'database.inc.php';

    $prodname= $_POST['nume-produs'];
    $prodfurn= $_POST['nume-furnizor'];
    $prodprice= $_POST['pret'];
    $prodcount= $_POST['cantitate'];
    
    $upload_dir="../prod_images/";
    $upload_file= $upload_dir . basename($_FILES['addimg']["name"]);

    move_uploaded_file($_FILES['addimg']["tmp_name"], $upload_file);
    
    if (empty($prodname) || empty($prodfurn) || empty($prodprice) || empty($prodcount)){
        header("Location: ../html/admin_stocuri_page.php?error=emptyfields");
        exit();
    } else{
        $sql="INSERT INTO products (pname, pprovider, pprice, pcount, pimg) VALUES (?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_stocuri_page.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "ssiis", $prodname, $prodfurn, $prodprice, $prodcount, $upload_file);
            mysqli_stmt_execute($stmt);
            header("Location: ../html/admin_stocuri_page.php?addproduct=success");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("Location: ../html/admin_stocuri_page.php");
    exit();
}