<?php
    require "Session/Session.php";
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



                //Base Maison : 
                //$BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
                //base Providence :
                //$BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
                //base Alays Data :
                $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

                //Affichage des 6 meilleurs
                $CommResult = $BDD->query("SELECT `Nom`, `Score` FROM `perso` ORDER BY `Score` DESC LIMIT 7");
                // selectionne le id du jeux le nom et sa fait une jointure avec articlelike et game
                ?>
                   <div id="text">
                    <h1>Tableau des scores</h1>
                </div>
                    <table id="Score">
                        <?php
                        While($don = $CommResult->fetch()){   // boucle while qui affiche les 3 meuilleur jeux
                            ?>        
                                <td>
                                    <?php
                                    echo '<h1 class="align">'.$don['Nom'].'</h1>'; //affiche le nom du jeu
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '<h1 class="align">'.$don['Score'].'</h1>'; //affiche le mombre de coeur
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
                <?php
            }
        ?>
    </body>
</html>