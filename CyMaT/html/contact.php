<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Contact</title>
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
    <div class="contact-box">
        <hr/>
        <p>Contact</p>
        <form class="contact-form" action="../includes/contact.inc.php" method="post">
            <label for="name">Nume</label>
            <input class="input-form" placeholder="Nume complet..." type="text" name="nume" id="name">

            <label for="email">Email</label>
            <input class="input-form" placeholder="Emailul dumneavoastra..." type="text" name="email" id="email">

            <label for="subiect">Subiect</label>
            <input class="input-form" placeholder="Subiect..." type="text" name="subiect" id="subiect">

            <label for="mesaj">Mesaj</label>
            <textarea placeholder="Mesaj dumneavoastra..." class="mesaj-box" id="mesaj" name="mesaj"></textarea>
            <div class="center">
                <button class="contact-btn">Trimite</button>
            </div>
        </form>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>