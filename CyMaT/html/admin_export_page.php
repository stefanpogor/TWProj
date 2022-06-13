<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/import_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Export</title>
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
                <li class="square-btn"> <a href="../html/admin_stocuri_page.php">Stocuri</a> </li>
                <li class="square-btn"> <a href="../html/admin_comenziF_page.php">Comenzi furnizori</a> </li>
                <li class="square-btn"> <a href="../html/admin_import_page.php">Import</a> </li>
                <li class="square-btn focused"> <a href="../html/admin_export_page.php">Export</a> </li>
            </ul>
        </div>

        <div class="right-content">
            <div class="import">
                <form action="../includes/export.inc.php" method="post">
                    <label for="where">Selectati ce doriti sa exportati:</label>
                    <select class="arrange" name="where" id="where">
                        <option value="produse">Produse</option>
                        <option value="comenzi-furnizori">Comenzi furnizori</option>
                    </select>
                    <button class="import-btn" name="exportbtn">Export</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>