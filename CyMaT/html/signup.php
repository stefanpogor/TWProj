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
    <title>CyMaT - Sign up</title>
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
            <p>Sign Up</p>

            <?php
                if(isset($_GET['error'])){
                    $email="";
                    $name="";
                    if($_GET['error'] == 'emptyfields'){
                        echo '<p>Completeaza toate campurile!</p>';
                        if(isset($_GET['email']))
                            $email=$_GET['email'];
                            $name=$_GET['name'];
                    } else if($_GET['error'] == 'invalidmailandname'){
                        echo '<p>Email si nume invalide!</p>';
                    } else if($_GET['error'] == 'invalidmail'){
                        echo '<p>Email invalid!</p>';
                        $name=$_GET['name'];
                    } else if($_GET['error'] == 'invalidname'){
                        echo '<p>Nume invalid!</p>';
                        if(isset($_GET['email']))
                            $email=$_GET['email'];
                    } else if($_GET['error'] == 'passwordcheck'){
                        echo '<p>Parolele nu coincid!</p>';
                        if(isset($_GET['email']))
                            $email=$_GET['email'];
                            $name=$_GET['name'];
                    } else if($_GET['error'] == 'emailtaken'){
                        echo '<p>Exista deja un cont cu acest email!</p>';
                        $name=$_GET['name'];
                    }
                    echo
                    '
                    <form class="log-form" action="../includes/signup.inc.php" method="post">
                    <label for="name">Nume</label>
                    <input class="input-form" placeholder="Nume complet..." type="text" name="name" id="name" value="'.$name.'">
                    <label for="email">Email</label>
                    <input class="input-form" placeholder="Emailul dumneavoastra..." type="text" name="email" id="email" value='.$email.'>
                    <label for="password">Parola</label>
                    <input class="input-form" placeholder="Indrodu o parola..." type="password" name="password" id="password">
                    <label for="confpassword">Confirma parola</label>
                    <input class="input-form" placeholder="Reintrodu parola..." type="password" name="confpassword" id="confpassword">
                    
                    <div class="center">
                        <button class="log-btn" name="signup-submit">Sign Up</button>
                    </div>
                    </form>
                    ';
                } else if(isset($_GET['signup'])){
                    echo 
                    '
                    <p>Inregistrare cu succes! Acceseaza <a href="login.php">LOGIN</a> si completeaza cu informatiile contului tau.
                    </p>
                    ';
                    echo
                    '
                    <form class="log-form" action="../includes/signup.inc.php" method="post">
                    <label for="name">Nume</label>
                    <input class="input-form" placeholder="Nume complet..." type="text" name="name" id="name">
                    <label for="email">Email</label>
                    <input class="input-form" placeholder="Emailul dumneavoastra..." type="text" name="email" id="email">
                    <label for="password">Parola</label>
                    <input class="input-form" placeholder="Indrodu o parola..." type="password" name="password" id="password">
                    <label for="confpassword">Confirma parola</label>
                    <input class="input-form" placeholder="Reintrodu parola..." type="password" name="confpassword" id="confpassword">
                    
                    <div class="center">
                        <button class="log-btn" name="signup-submit">Sign Up</button>
                    </div>
                    </form>
                    ';
                } else {
                    echo
                    '
                    <form class="log-form" action="../includes/signup.inc.php" method="post">
                    <label for="name">Nume</label>
                    <input class="input-form" placeholder="Nume complet..." type="text" name="name" id="name">
                    <label for="email">Email</label>
                    <input class="input-form" placeholder="Emailul dumneavoastra..." type="text" name="email" id="email">
                    <label for="password">Parola</label>
                    <input class="input-form" placeholder="Indrodu o parola..." type="password" name="password" id="password">
                    <label for="confpassword">Confirma parola</label>
                    <input class="input-form" placeholder="Reintrodu parola..." type="password" name="confpassword" id="confpassword">
                    
                    <div class="center">
                        <button class="log-btn" name="signup-submit">Sign Up</button>
                    </div>
                    </form>
                    ';
                }
            ?>

           
        </div>
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>   
    </footer>
</body>
</html>