<?php
    require "Compte.php";
    include "../Objet/Compte.php";
    include "../Objet/Inscription.php";
?>
<html> 
    <head>  
        <title>Inscription</title>
    </head>
    <body>
        <?php
            if($_SESSION && $_SESSION['Connect'] != 0){ 
            ?>
            <div id="container">    
                <form method="POST" id="CreationPerso">

                    <h1> Création : </h1>

                    <!-- Pseudo : -->
                    <input type=text placeholder="Entrez le Pseudo de votre Personnage" name="PPseudo" required>
                    <!-- Partager l'Attaque / Défense / Soin selon ce que veux le joueur avec base de X points -->

                    <label> Attaque </label>
                    <input type=number name="PAttaque" min="1" max="38" required>
                    
                    <label> Défense </label>
                    <input type=number name="PDefense" min="1" max="38" required>

                    <label> Soin </label>
                    <input type=number name="PSoin" min="1" max="38" required>

                    <input type=submit name="PSubmit" value='Ajoute ton personnage'>
                    <div id="texte">
                    <p name="Info" id="Info">
                        Le total des valeurs d'<strong>Attaque</strong>, de <strong>Défense</strong> et de <strong>Soin</strong> ne doit pas dépasser <strong>40</strong>.
                    </p>
                    <p name="Info2" id="Info2">
                        De ce fait, vous devez avoir une valeur minimal de <strong>1</strong> dans chaque stats et une valeur maximale de <strong>38</strong>.
                    </p>
                </div>
                </form>
            </div>

                    <?php
                    if (isset($_POST["PSubmit"])) {
                        if (abs($_POST['PAttaque']) + abs($_POST['PDefense']) + abs($_POST['PSoin']) > 40 || abs($_POST['PAttaque']) + abs($_POST['PDefense']) + abs($_POST['PSoin']) < 0 || abs($_POST['PAttaque']) < 1 || abs($_POST['PDefense']) < 1 || abs($_POST['PSoin']) < 1)
                        {
                            ?>
                            <script>
                                document.getElementById("Info").innerText = `Le total de vos valeurs d'Attaque, de Défense et de Soin a dépassé 40, merci d'entrer des valeurs valides.`;
                                console.log("Les stats rentré ne sont pas valide : dépassent 40")
                            </script>
                            <?php
                        } else 
                        {
                            //Base Maison : 
                            //$BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
                            //base Providence :
                            //$BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
                            //base Alays Data :
                            $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

                            $PPseudo = $_POST['PPseudo'];
                            $PAttaque = $_POST['PAttaque'];
                            $PDefense = $_POST['PDefense'];
                            $PSoin = $_POST['PSoin'];

                            $req = `INSERT INTO perso (Nom, Vie, Attaque, Defense, Soin) VALUES ('$PPseudo',100,$PAttaque,$PDefense,$PSoin)`; //
                            $reponse = $BDD->query($req);

                            echo "<strong>".$PPseudo."</strong> à été ajouter, il a <strong>".$PAttaque."</strong> points d'Attaques, <strong>".$PDefense."</strong> points de Défense et <strong>".$PSoin."</strong> de puissance de Soin. ";


                            //Obtenir l'ID du compte :
                            //obtenir l'ID Perso :

                            $Perso = new InscriptionPerso($PPseudo, $PAttaque, $PDefense, $PSoin);

                            $Perso->InserCompte($_POST['PPseudo'], $_POST['PAttaque'], $_POST['PDefense'], $_POST['PSoin']);
                            
                            $PersoID = $Perso->GetIDUtilisateur($_POST['PPseudo'], $_POST['PAttaque'], $_POST['PDefense'], $_POST['PSoin']);


                            //echo "L'id du personnage créer est : <strong>".$valeurPerso[0]."</strong>";

                            //Lié les 2 ID pour que l'utilisateur est toujours le meme perso
                            $CompteID = $_SESSION['Connect'];

                            $Perso->Liaison($PersoID, $CompteID);

                            echo "L'utilisateur d'ID <strong>".$CompteID."</strong> et le perso d'ID <strong>".$PersoID."</strong> ont été correctement liés.";

                            //Destroy la Session
                            session_destroy();

                            echo "<script type='text/javascript'>document.location.replace('../Acceuil.php');</script>";
                        }
                    }
            }
            ?>
    </body>
</html>