<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clientpagestyle.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>CyMaT - Bun venit</title>
</head>
<body>
    <header>
        <img class="logo" src="../res/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <?php
                    if(isset($_SESSION['username'])){
                        echo 
                        '
                        <li><a>'.strtoupper($_SESSION['username']).'</a></li>
                        <li>
                        <form method="post" action="../includes/logout.inc.php">
                            <button class="signoutbtn" type="submit">SIGNOUT</button>
                        </form>
                        </li>
                        ';
                    } else {
                        echo
                        '
                        <li><a href="../html/contact.php">Contact</a></li>
                        <li><a href="../html/signup.php">Sign up</a></li>
                        <li><a href="../html/login.php">Login</a></li>
                        ';
                    }              
                ?>
            </ul>
        </nav>
    </header>

    <div class="grid-container">
        <div class="form-area">
            <hr/>
            <h3> Completeaza formularul de mai jos </h3>
            <?php
                if (isset($_GET['error'])){
                    $nume='';
                    $prenume='';
                    $data='';
                    if ($_GET['error']=='emptyfields'){
                        $nume=$_GET['firstname'];
                        $prenume=$_GET['lastname'];
                        $data=$_GET['meeting-time'];
                        echo '<p>Campurile nume, prenume sau data nu pot fi goale. </p>';
                    } else if ($_GET['error']=='datealreadytaken'){
                        echo '<p>Data si ora selectate nu sunt disponibile.</p>';
                    }
                }
            ?>
            <form enctype="multipart/form-data" class="req-form" action="../includes/cerere.inc.php" method="post">
                <label for="fname">Prenume</label>
                <input class="input-form" type="text" id="fname" name="firstname" placeholder="Prenumele tau..." required>
            
                <label for="lname">Nume</label>
                <input class="input-form" type="text" id="lname" name="lastname" placeholder="Numele tau..." required>

                <label for="myfile">Incarca poze / video-uri:</label>
                <input class="input-form" type="file" id="myfile" name="myfile" accept="image/png, image/jpeg, video/mp4" multiple>
            
                <label for="meeting-time">Alege data si ora programarii:</label>
                <input class="input-form" type="datetime-local" id="meeting-time" name="meeting-time" >   

                <label for="problem">Descrie problema:</label>
                <textarea name="problemtxt" class="problem-box" placeholder="Enter your message..." rows="5" cols="40" id="problem" required> </textarea>

                <input type="submit" value="Trimite" name="submit">
              </form>
        </div>
        <div class="response-area">
            <div class="header_band">
                <h3> Raspuns/raspunsuri </h3>
            </div>

            <?php
                include '../includes/database.inc.php';
                $sql = "SELECT * FROM raspunsuri";
                $result=mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                    if ($row['clientid']==$_SESSION['userid']){
                        $prb=str_replace("_", " ", $row['cerere']);
            ?>
            <div class="comanda-card">
                    <?php
                        if (!empty($row['pretest'])){
                    ?>
                        <p>Pret total estimat: <?php echo $row['pretest']; ?> RON</p>
                    <?php
                        }
                    ?>
                    <?php
                        if ($row['stat']=="aprobat"){
                    ?>
                        <p class="acc">Status cerere: <?php echo $row['stat']; ?></p>
                    <?php
                        } else {
                    ?>
                        <p class="dny">Status cerere: <?php echo $row['stat']; ?></p>
                    <?php
                        }
                    ?>
                    <p>Data programare: <?php echo $row['dataprog']; ?> </p>
                    <p>Cerere: <?php echo $prb; ?> </p>
                    <p>Raspuns cerere: <?php echo $row['raspuns']; ?> </p>
            </div>
            <?php
                }
            }
            ?>
        </div>
        
    </div>
    <footer>
        <p> Copyright 2022 <a href="../html/scholarly.html">Scholarly</a></p>
    </footer>
</body>
</html>