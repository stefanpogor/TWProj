<?php

include '../includes/database.inc.php';
$sql = "SELECT * FROM comenzif";
$result=mysqli_query($conn, $sql);
$data=array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/comenziF_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Comenzi Furnizori</title>
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
                <li class="square-btn"> <a href="../html/admin_cereri_page.php">Cereri</a> </li>
                <li class="square-btn"> <a href="../html/admin_stocuri_page.php">Stocuri</a> </li>
                <li class="square-btn focused"> <a href="../html/admin_comenziF_page.php">Comenzi furnizori</a> </li>
                <li class="square-btn"> <a href="../html/admin_import_page.php">Import</a> </li>
                <li class="square-btn"> <a href="../html/admin_export_page.php">Export</a> </li>
            </ul>
        </div>

        <div class="right-content">
            <div class="comanda-noua-card">
                <div class="comanda_noua">
                    <p>Trimite comanda catre furnizor</p>
                    <form action="../includes/addcomf.inc.php" method="post">
                        <input class="com_form" placeholder="Nume Produs" type="text" name="nume-produs" onkeyup="showHint(this.value)">
                        <p>Sugestii: <span id="txtHint"></span></p>

                        <input class="com_form" placeholder="Nume Furnizor" type="text" name="nume-furnizor" onkeyup="showHint2(this.value)">
                        <p>Sugestii: <span id="txtHint2"></span></p>

                        <input class="com_form" placeholder="Email Furnizor" type="text" name="email">

                        <input class="com_form" placeholder="Cantitate" type="text" name="cantitate">
                        <button class="send_com" name="trimite-com">Trimite comanda</button>
                    </form>
                    
                </div>
            </div>
            <div class="header_band">
                <p>Comenzi Furnizori</p>
            </div>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <div class="comanda-card">

                    <div class="comenzi">

                        <p>Nume produs: <?php echo $row['cnume'] ?> </p>
                        <p>Furnizor: <?php echo $row['cfurnizor'] ?> </p>
                        <p>Cantitate: <?php echo $row['ccount'] ?> buc</p>
                        <p>Pret: <?php echo $row['ccount'].' buc'.' * '.$row['cpret']/$row['ccount'].' RON'.' = '. $row['cpret'] ?> RON</p>
                        <p>Email furnizor: <?php echo $row['cmailf'] ?> </p>
                        <p>Estimat livrare: <?php echo $row['cestimat'] ?> </p>
                        <?php
                        if ($row['clivrat']==1){
                        ?>
                        <p>Livrat: Da </p>
                        <?php
                        } else {
                        ?>
                        <p>Livrat: Nu </p>
                        <?php
                        }
                        ?>

                    </div>

                    <form action="../includes/deletecom.inc.php" method="post">
                        <input type="hidden" value=<?php echo $row['cid']?> name="id">
                        <button class="del" name="sterge">Sterge comanda</button>
                    </form>

                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
    <script>
        function showHint(str) {

            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } 
            else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("GET", "gethint.php?q="+str, true);
                    xmlhttp.send();
                }
            }
        function showHint2(str) {
            if (str.length == 0) {
                document.getElementById("txtHint2").innerHTML = "";
                return;
            } 
            else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint2").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("GET", "getproviderhint.php?q="+str, true);
                    xmlhttp.send();
                }
        }
    </script>
</body>
</html>