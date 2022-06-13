<?php

require 'database.inc.php';

if (isset($_POST['acceptbtn'])){

    $ans=$_POST['raspuns'];
    $cerere=$_POST['cerere'];
    $pret=$_POST['price'];
    $status="aprobat";
    $userid=$_POST['clientid'];
    $date=$_POST['data'];
    $idcerere=$_POST['cerereid'];

    $sql="UPDATE cereri SET sts=1 WHERE crid='".$idcerere."'";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../html/admin_import_page.php?error=sqlerror");
        exit();
    } else{
        mysqli_stmt_execute($stmt);
    }

    if(empty($ans)){
        header("Location: ../html/admin_cereri_page.php?error=emptyfields");
        exit();
    } else{
        $sql="INSERT INTO raspunsuri (raspuns, cerere, pretest, stat, clientid, dataprog, cerereid) VALUES (?,?,?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_cereri_page.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssisisi", $ans, $cerere, $pret, $status, $userid, $date, $idcerere);
            mysqli_stmt_execute($stmt);
            header("Location: ../html/admin_cereri_page.php?succes");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else if (isset($_POST['denybtn'])){

    $ans=$_POST['raspuns'];
    $cerere=$_POST['cerere'];
    $pret=$_POST['price'];
    $status="respins";
    $userid=$_POST['clientid'];
    $date=$_POST['data'];
    $idcerere=$_POST['cerereid'];

    if(empty($ans)){
        header("Location: ../html/admin_cereri_page.php?error=emptyfields");
        exit();
    } else{
        $sql="INSERT INTO raspunsuri (raspuns, cerere, pretest, stat, clientid, dataprog, cerereid) VALUES (?,?,?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/admin_cereri_page.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssisisi", $ans, $cerere, $pret, $status, $userid, $date, $idcerere);
            mysqli_stmt_execute($stmt);
        }

        $delsql="DELETE FROM cereri WHERE crid='".$idcerere."'";
        $delstmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($delstmt, $delsql)){
            header("Location: ../html/admin_cereri_page.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_execute($delstmt);
            header("Location: ../html/admin_cereri_page.php?refuz=success");
            exit();
        }
    }
    mysqli_stmt_close($delstmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../html/admin_cereri_page.php");
    exit();
}