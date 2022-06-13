<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/log_style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Login</title>
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
    <div class="center-screen">
        <div class="log-box">
            <hr/>
            <p>Login</p>
            <?php
                if(isset($_GET['error'])){
                    $email="";
                    if($_GET['error'] == 'emptyfields'){
                        echo '<p>Completeaza toate campurile!</p>';
                        if(isset($_GET['email']))
                            $email=$_GET['email'];
                    } else if($_GET['error'] == 'wrongpwd'){
                        echo '<p>Parola invalida!</p>';
                    } else if($_GET['error'] == 'nouser'){
                        echo '<p>Email inexistent!</p>';
                    }
                }
            ?>
            <form class="log-form" action="../includes/login.inc.php" method="post">
                <label for="email">Email</label>
                <input class="input-form" placeholder="Emailul dumneavoastra..." type="text" name="email" id="email">

                <label for="password">Parola</label>
                <input class="input-form" placeholder="Indrodu o parola..." type="password" name="password" id="password">
            
                <div class="center">
                    <button class="log-btn" type="submit" name="login-submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>