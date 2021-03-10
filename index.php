<html>
    <head>
        <link rel="stylesheet" href="CSS/Index.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="Acceuil">
            <form method="POST" name="Acceuil">
                <input type="submit" name='Acceuil' value='Rejoins le Combat !'>
            </form>
        </div>


        <?php
            //Score
            
            //Base Maison : 
            //$BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
            //base Providence :
            $BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
            //base Alays Data :
            $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");



            $CommResult = $BDD->query("SELECT `Nom`, `Score` FROM `perso` ORDER BY `Score` DESC LIMIT 5");
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

            //Aller dans la page d'acceuil
            if (isset($_POST["Acceuil"])) {
                echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
            }
        
        ?>
    </body>
</html>