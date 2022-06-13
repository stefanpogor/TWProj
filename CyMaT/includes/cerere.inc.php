<?php
session_start();
if (isset($_POST['submit'])){

    require 'database.inc.php';

    $prenume = $_POST['firstname'];
    $nume = $_POST['lastname'];
    $clientid=$_SESSION['userid'];

    $date = $_POST['meeting-time'];
    $sql = "SELECT crdate FROM cereri";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['crdate']==$date){
            header("Location: ../html/clientpage.php?error=datealreadytaken");
            exit();
        }
    }

    $msg = $_POST['problemtxt'];
    
    $upload_dir="../atasamente/";
    $upload_file= $upload_dir . basename($_FILES['myfile']["name"]);

    move_uploaded_file($_FILES['myfile']["tmp_name"], $upload_file);
    
    if($upload_dir==$upload_file){
        $upload_file='';
    }

    if (empty($prenume) || empty($nume) || empty($date)){
        header("Location: ../html/clientpage.php?error=emptyfields&firstname='".$prenume."'&lastname='".$nume."'&meeting-time='".$date."'");
        exit();
    } else {
        $sql="INSERT INTO cereri (clprenume, clnume, crdate, crproblem, clid, clfile) VALUES (?,?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/clientpage.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssssis", $prenume, $nume, $date, $msg, $clientid, $upload_file);
            mysqli_stmt_execute($stmt);
            header("Location: ../html/clientpage.php?succes");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../html/clientpage.php");
}