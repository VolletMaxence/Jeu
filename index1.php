<?php
    require "Session/Session.php";
?>

<html> 
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body>
        <?php
            if($_SESSION && $_SESSION['Connect'] != 0){ 
                ?>

                <form method="POST" name="Combat">
                    <input type="submit" name='Combat' value='Au Combat !'>
                </form>

                <!-- Classement : -->
                <!-- Recuperer avec système de score -->

                <form method="POST" name="Deco">
                    <input type="submit" name="Deco" value='Se Déconnecter'>
                </form>

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
                        header("Refresh:0");
                    }

                //Aller dans la page de combat
                if (isset($_POST["Combat"])) {
                    echo "<script type='text/javascript'>document.location.replace('Combat.php');</script>";
                }

            }
        ?>
    </body>
</html>