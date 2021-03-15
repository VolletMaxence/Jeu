<?php
    require "Session/Session.php";
    include "Objet/Perso.php";
?>

<html> 
    <head>
        <link rel="icon" href="/Image/icone.ico"/>
        <meta charset="UTF-8">
        <title>Salon</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="CSS/Index.css" media="screen" type="text/css" />
    </head>
    <body>
        <?php
            if($_SESSION && $_SESSION['Connect'] != 0){ 
                ?>
            <div id="Retour">
                <form method="POST" name="Retour">
                    <input type="submit" name='Retour' value="Retour à l'acceuil">
                </form>
            </div>
                <!-- Classement : -->
                <!-- Recuperer avec système de score -->
            <div id="Delete">
                <form method="POST" name="Delete">
                    <input type="submit" name="Delete" value='Supprimer le Compte'>
                </form>
            </div>


                <?php
                    if(ISSET($_POST['Retour']))
                    {
                        //retour à la page d'acceuil
                        echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
                    }
 
                //Aller dans la page de combat
                if (isset($_POST["Delete"])) 
                {
                    //Suppression du Compte / de l'utilisateur + renvoie à la page de connexion
                    $Perso = new Perso($_SESSION['Connect']);

                    $IDPerso = $_SESSION['Connect'];
                    $IDCompte = $Perso->ReturnIDCompte();
                    //$IDCompte = $Perso->Delete($IDPerso, $IDCompte);

                    echo "Le compte d'ID ".$IDCompte." et le Perso d'ID ".$IDPerso. "Ont été supprimé";
                    //session_destroy();
                    //echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
                }

                


                
            }
        ?>
    </body>
</html>