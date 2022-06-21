<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/import_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Import</title>
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
                <li class="square-btn"> <a href="../html/admin_comenziF_page.php">Comenzi furnizori</a> </li>
                <li class="square-btn focused"> <a href="../html/admin_import_page.php">Import</a> </li>
                <li class="square-btn"> <a href="../html/admin_export_page.php">Export</a> </li>
            </ul>
        </div>

        <div class="right-content">
            <div class="import">
                <form method="post" enctype="multipart/form-data" action="../includes/import.inc.php">
                    
                    <input type="file" class="arrange" name="imp" accept=".csv,.json">
                    <label for="where">Selectati ce doriti sa importati:</label>
                    <select class="arrange" name="where" id="where">
                        <option value="produse">Produse</option>
                        <option value="comenzi-furnizori">Comenzi furnizori</option>
                    </select>
                    <button class="import-btn" name="importbtn">Import</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>