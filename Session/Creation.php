<html>
    <head>

    </head>
    <body>
        <?php
            //Base Maison
            //$Base = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8", "root", "");
            //$Base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Base Providence
            $Base = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
        ?>

        <!-- Création de Perso :  -->
        <h1> Creation : </h1>

        <form method="POST" id="CreationPerso">
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
        </form>

        <p name="Info" id="Info">
            Le total des valeur d'Attaque, de Défense et de Soin ne doit pas dépasser <strong> 40 </strong>.
        </p>
        <p name="Info2" id="Info2">
            De ce fait, vous devez avoir une valeur minimal de <strong>1</strong> dans chaque stats et une valeur maximal de <strong>38</strong>.
        </p>

            <?php
            if (isset($_POST["PSubmit"])) {
                if ($_POST['PAttaque'] + $_POST['PDefense'] + $_POST['PSoin'] > 40)
                {
                    ?>
                    <script>
                        document.getElementById("Info").innerText = `Le total de vos valeur d'Attaque, de Défense et de Soin a dépasé 40, merci d'entrer des valeurs valides.`;
                        console.log("Les stats rentré ne sont pas valide : dépassent 40")
                    </script>
                    <?php
                } else 
                {
                    $stmt = $Base->prepare("INSERT INTO perso (Nom, Vie, Attaque, Defense, Soin) VALUES (?,100,?,?,?) ");
                    $stmt->execute(array($_POST['PPseudo'], $_POST['PAttaque'], $_POST['PDefense'], $_POST['PSoin']));

                    echo "<strong>".$_POST['PPseudo']."</strong> à été ajouter, il a <strong>".$_POST['PAttaque']."</strong> points d'attaque, <strong>".$_POST['PDefense']."</strong> point de défense et <strong>".$_POST['PSoin']."</strong> de puissance de soin. ";


                    //Obtenir l'ID du compte :
                    //Chercher le dernier fait :
                    $reqUtilisateur = "SELECT `ID` FROM utilisateur ORDER BY ID DESC";
                    $QueryUtilisateur = $Base->query($reqUtilisateur);

                    //Récuperer les valeur sous forme de table avec fetch()
                    $valeurUtilisateur = $QueryUtilisateur->fetch();

                    //obtenir l'ID Perso :
                    $reqPerso = "SELECT `ID` FROM perso ORDER BY ID DESC";
                    $QueryPerso = $Base->query($reqPerso);

                    //Récuperer les valeur sous forme de table avec fetch()
                    $valeurPerso = $QueryPerso->fetch();
                    //echo "L'id du personnage créer est : <strong>".$valeurPerso[0]."</strong>";

                    //Lié les 2 ID pour que l'utilisateur est toujours le meme perso
                    $IDPerso = $Base->prepare("UPDATE `utilisateur` SET `IDPerso`=".$valeurPerso[0]." WHERE `ID`=".$valeurUtilisateur[0]."");
                    $IDPerso->execute(array($valeurPerso[0]));

                    $IDUtilisateur = $Base->prepare("UPDATE `perso` SET `IDCompte`=".$valeurUtilisateur[0]." WHERE `ID`=".$valeurPerso[0]."");
                    $IDUtilisateur->execute(array($valeurUtilisateur[0]));

                    echo "L'utilisateur d'ID <strong>".$valeurUtilisateur[0]."</strong> et le perso d'ID <strong>".$valeurPerso[0]."</strong> ont été correctement lié.";

                    echo "<script type='text/javascript'>document.location.replace('../index.php');</script>";
                }
            }
            ?>
    </body>
</html>