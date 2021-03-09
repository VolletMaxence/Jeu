<html>
    <head>
    <link rel="stylesheet" href="Inscription.css" media="screen" type="text/css" />
    </head>

    <body>
        <!-- Formulaire d'inscription -->
        <div id="container">
            <form method="POST" id="CreationCompte">
            <h1>Inscription</h1>
                <label><strong><p> Ton Nom d'Utilisateur </p></strong></label>
                <input type="text" placeholder="Entrer votre nom d'utilisateur" name="Pseudo" required>

                <label><strong> Ton Mot de Passe </strong></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="MDP" required>


                <input type="submit" name='submit' value='Inscription'>
        
            </form>
</div> 
            <?php
            //si session existe pas :
            //connexion base : 

            //Base Maison
            //$Base = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8", "root", "");
            //$Base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Base Providence
            $Base = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");

            //Lorsque le boutton est appuyé : 
            if (isset($_POST["submit"])) {
                if((!empty($_POST['MDP'])) && (!empty($_POST['Pseudo']))){
                    //Ajout de l'utilisateur en base
                    $stmt = $Base->prepare("INSERT INTO utilisateur (Pseudo, Mot_de_Passe) VALUES (?,?) ");
                    $stmt->execute(array($_POST['Pseudo'], $_POST['MDP']));
                    

                    $stmt = $stmt->fetch();

                    echo "<script type='text/javascript'>document.location.replace('Creation.php');</script>";

                }
            }
            ?>
    </body>



        
</html>