<?php

require '../includes/database.inc.php';

$sql="SELECT * FROM products";
$stmt=mysqli_stmt_init($conn);

$names = [];
$ids = [];

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../html/login.php?error=sqlerror");
    exit();
} 
else{
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
        
    while($row = mysqli_fetch_assoc($results)){

        $names[] = $row['pname'];
        $ids[] = $row['pid'];
        }
    }

$q=$_GET["q"];
$len=strlen($q);

if (strlen($q)>0) {

    $hint="";

    for($i=0; $i<count($names); $i++) {

        if (stristr($q, substr($names[$i], 0, $len))) {

            if ($hint === "") {
                $hint = "<a href=#".$ids[$i].">".$names[$i]."</a>";            
            }
            else {
                $hint .= "<br /> <a href=#".$ids[$i].">".$names[$i]."</a>";
            }
        }
    }
}
echo $hint === "" ? "nici o sugestie" : $hint;
    
?>