<?php

include '../includes/database.inc.php';
$sql = "SELECT * FROM products";
$result=mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stocuri_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Stocuri</title>
</head>
<body>
    
    <header>
        <img class="logo" src="../res/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <li><a href="../html/contact.php">Contact</a></li>
                <li><a href="../html/signup.php">Sign up</a></li>
                <li><a href="../html/login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="grid-area-container">
        <div class="left-menu">
            <ul class="left-commands">
                <li class="square-btn"> <a href="../html/admin_cereri_page.php">Cereri</a> </li>
                <li class="square-btn focused"> <a href="../html/admin_stocuri_page.php">Stocuri</a> </li>
                <li class="square-btn"> <a href="../html/admin_comenziF_page.php">Comenzi furnizori</a> </li>
                <li class="square-btn"> <a href="../html/admin_import_page.php">Import</a> </li>
                <li class="square-btn"> <a href="../html/admin_export_page.php">Export</a> </li>
            </ul>
        </div>

        <div class="right-content">
            <div class="produs_nou_card">
                <div class="produs_nou">
                    <p>Adauga un produs nou</p>
                    <form action="../includes/addproduct.inc.php" method="post" enctype="multipart/form-data">
                        <input class="com_form" placeholder="Nume Produs" type="text" name="nume-produs">

                        <input class="com_form" placeholder="Nume Furnizor" type="text" name="nume-furnizor">

                        <input class="com_form" placeholder="Pret (RON)" type="text" name="pret">

                        <input class="com_form" placeholder="Cantitate" type="text" name="cantitate">
                        
                        <label>Imagine:</label>
                        <input type="file" name="addimg">

                        <button class="send_com" type="submit" name="addproductbtn">Adauga produs</button>
                    </form>
                </div>
            </div>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>

            <div class="stoc-card">
                <div class="info">
                    <p>Denumire: <?php echo $row['pname'] ?></p>
                    <p>Furnizor: <?php echo $row['pprovider'] ?></p>
                    <p>Stoc: <?php echo $row['pcount'] ?></p>
                    <form action="../includes/actstoc.inc.php" method="post">
                        <input type="hidden" value=<?php echo $row['pid']?> name="id">
                        <input placeholder="Introdu noul stoc..." class="new_val" type="text" name="stoc">
                        <button class="act" name="actstocbtn">Actualizeaza stoc</button>
                    </form>
                    <p>Pret: <?php echo $row['pprice'] ?> RON</p>
                    <form action="../includes/actpret.inc.php" method="post">
                        <input type="hidden" value=<?php echo $row['pid']?> name="id">
                        <input placeholder="Introdu noul pret..." class="new_val" type="text" name="pret">
                        <button class="act" name="actpretbtn">Actualizeaza pret</button>
                    </form>
                    <form action="../includes/delete.inc.php" method="post">
                        <input type="hidden" value=<?php echo $row['pid']?> name="id">
                        <button class="del" name="sterge">Sterge produs</button>
                    </form>
                </div>
                <?php
                    if (!empty($row['pimg'])){
                ?>
                <div class="imag">
                    <img src=<?php echo $row['pimg']; ?> alt="image_prod">
                </div>
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