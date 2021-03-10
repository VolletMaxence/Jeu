<?php
    require "Session/Session.php";
?>

<html> 
    <head>
        <link rel="icon" href="/Image/icone.ico"/>
        <meta charset="UTF-8">
        <title>Salon</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="CSS/Accueil.css" media="screen" type="text/css" />
    </head>
    <body>
        <?php
            if($_SESSION && $_SESSION['Connect'] != 0){ 
                ?>
            <div id="Combat">
                <form method="POST" name="Combat">
                    <input type="submit" name='Combat' value='Au Combat !'>
                </form>
            </div>
                <!-- Classement : -->
                <!-- Recuperer avec système de score -->
            <div id="Deco">
                <form method="POST" name="Deco">
                    <input type="submit" name="Deco" value='Se Déconnecter'>
                </form>
            </div>


                <?php
                    if(ISSET($_POST['Deco']))
                    {
                        session_destroy();
                        ?>
                            <script type="text/javascript">
                                console.log("Déconnection");
                            </script>
                        <?php
                        //refresh pour déco
                        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
                    }
 
                //Aller dans la page de combat
                if (isset($_POST["Combat"])) {
                    echo "<script type='text/javascript'>document.location.replace('Combat.php');</script>";
                }

            }
        ?>
    </body>
</html>