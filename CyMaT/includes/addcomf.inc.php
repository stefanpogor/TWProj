<?php

if (isset($_POST['trimite-com'])){

    require 'database.inc.php';

    $comname = $_POST['nume-produs'];
    $comprov = $_POST['nume-furnizor'];
    $commail = $_POST['email'];
    $comcount = $_POST['cantitate'];
    $currdate = date("Y-m-d");
    $to_add = rand(1,14);
    $string = $currdate.' +'.$to_add.' days';
    $comest = date("Y-m-d", strtotime($string));
    $comprice = $comcount * rand(50,1000);
    $comlivrat = (bool) mt_rand(0, 1);


    echo "<p>".$comest."</p>";

    if (empty($comname) || empty($comprov) || empty($commail) || empty($comcount)){
        header("Location: ../html/admin_comenziF_page.php?error=emptyfields");
        exit();
    } else{
        $sql="INSERT INTO comenzif (cnume, cfurnizor, cmailf, ccount, cestimat, cpret, clivrat) VALUES (?,?,?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_comenziF_page.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "sssisii", $comname, $comprov, $commail, $comcount, $comest, $comprice, $comlivrat);
            mysqli_stmt_execute($stmt);
            header("Location: ../html/admin_comenziF_page.php?addcomanda=success");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("Location: ../html/admin_comenziF_page.php");
    exit();
}