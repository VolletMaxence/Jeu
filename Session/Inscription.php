<?php
    session_start();
    include "../Objet/CompteCrea.php";
?>
<html>
    <head>
        <link rel="icon" href="../Image/icone.ico"/>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel="stylesheet" href="../CSS/Session.css" media="screen" type="text/css" />
    </head>

    <body>
        <?php
        if($_SESSION && $_SESSION['Connect'] != 0){
            //Si session existe affichage de la page
        }else{
        ?>
        <!-- Formulaire d'inscription -->
            <div id="container">
                <form method="POST" id="CreationCompte">
                    <h1>Inscription</h1>

                    <label><strong><p>Ton Nom d'Utilisateur</p></strong></label>
                    <input type="text" placeholder="Entrer votre nom d'utilisateur" name="Pseudo" required>

                    <label><strong><p>Ton Mot de Passe</p></strong></label>
                    <input type="password" placeholder="Entrer votre mot de passe" name="MDP" required>

                    <input type="submit" name='submit' value='Inscription'>
                </form>
            </div> 
            <?php
            //connexion base : 

            //Base Maison
            //$Base = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8", "root", "");
            //$Base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Base Providence
            //$Base = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
            //base Alays Data :
            $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

            //Lorsque le boutton est appuyé : 
            if (isset($_POST["submit"])) {
                if((!empty($_POST['MDP'])) && (!empty($_POST['Pseudo']))){

                    //Ajout de l'utilisateur en base avec Objet
                    $Compte = new CompteCrea($_POST['Pseudo'] , $_POST['MDP']);

                    $Compte->InserCompte($_POST['Pseudo'] , $_POST['MDP']);
                    
                    $IDCompte = $Compte->GetIDUtilisateur($_POST['Pseudo'] , $_POST['MDP']);

                    echo "$ IDCompte = ".$IDCompte;

                    $_SESSION['Connect']=$IDCompte;
                    header("Refresh:0");

                    //echo "<script type='text/javascript'>document.location.replace('Creation.php');</script>";
                }
            }
        }
        ?>
    </body>
</html>