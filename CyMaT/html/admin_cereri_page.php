<?php
session_start();
include '../includes/database.inc.php';
$sql = "SELECT * FROM cereri";
$result=mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cereri_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Cereri</title>
</head>
<body>
    
    <header>
        <img class="logo" src="../res/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <li><a>Bun venit, admin!</a></li>
                <li>
                    <form method="post" action="../includes/logout.inc.php">
                        <button class="signoutbtn" type="submit">SIGNOUT</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="grid-area-container">
        <div class="left-menu">
            <ul class="left-commands">
                <li class="square-btn focused"> <a href="../html/admin_cereri_page.php">Cereri</a> </li>
                <li class="square-btn"> <a href="../html/admin_stocuri_page.php">Stocuri</a> </li>
                <li class="square-btn"> <a href="../html/admin_comenziF_page.php">Comenzi furnizori</a> </li>
                <li class="square-btn"> <a href="../html/admin_import_page.php">Import</a> </li>
                <li class="square-btn"> <a href="../html/admin_export_page.php">Export</a> </li>
            </ul>
        </div>

        <div class="right-content">
            <?php
                while($row=mysqli_fetch_assoc($result)){
            ?>
                <div class="cerere-card">
                    <p>Prenume: <?php echo $row['clprenume']; ?></p>
                    <p>Nume: <?php echo $row['clnume']; ?></p>
                    <p>Data si ora: <?php echo $row['crdate']; ?></p>
                    <p>Mesaj: <?php echo $row['crproblem']; ?></p>
                    <?php
                        if (!empty($row['clfile'])){
                    ?>
                    <div class="atmt">
                        <a href=<?php echo $row['clfile'];?> target="_blank">Atasament</a>
                    </div>
                    <?php
                        }
                    ?>
                    <hr/>
                    <?php
                        if ($row['sts']!=1){
                            $prb=preg_replace('/\s+/', '_', $row['crproblem']);
                    ?>
                    <form action="../includes/answer.inc.php" method="post">
                        <textarea placeholder="Mesaj de raspuns..." class="raspuns-box" name="raspuns"></textarea>
                        
                        <input type="hidden" name="cerere" value= <?php echo $prb; ?>>
                        <input type="hidden" name="clientid" value=<?php echo $row['clid']; ?>>
                        <input type="hidden" name="data" value=<?php echo $row['crdate']; ?>>
                        <input type="hidden" name="cerereid" value=<?php echo $row['crid']; ?>>

                        <input class="pret" placeholder="Pret total (RON)" type="text" name="price">
                        <button class="deny" name="denybtn">Refuza</button>
                        <button class="accept" name="acceptbtn">Accepta</button>
                    </form>
                    <?php
                        } else {
                            echo "<p>ACCEPTATA</p>";
                    ?>
                    <?php
                        }
                    ?>
                </div>
            <?php
            } 
            ?>
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>