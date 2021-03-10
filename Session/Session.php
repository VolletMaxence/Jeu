<?php
    include "./Objet/Compte.php";
?>
<html>
    <head>
        <link rel="icon" href="../Image/icone.ico"/>
        <meta charset="UTF-8">
        <title>Connecte toi</title>
    </head>
    <body>
        <?php
                session_start();
                //session_destroy();

                if($_SESSION && $_SESSION['Connect'] != 0){
                    //Si session existe affichage de la page
                }else{
                    ?>
                    <link rel="stylesheet" href="CSS/Session.css" media="screen" type="text/css" />
                    <div id="container">
                        <!-- zone de connexion avec formulaire -->
                        
                        <form method="POST">
                            <h1>Connexion</h1>

                            <label><strong>Nom d'utilisateur</strong></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                            <label><strong>Mot de passe</strong></label>
                            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                            <input type="submit" name='submit' value='LOGIN' >
                        </form>
                        <!-- Bouton pour s'inscrir -->
                        <a href="Session/Creation.php"> Créer un nouveau Compte + nouveau Perso </a>
                    </div>

                    <?php 
                    //si session existe pas :
                    //connexion BDD : 

                    //BDD Maison
                    //$BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8", "root", "");
                    //BDD Providence
                    //$BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
                    //BDD Alays Data :
                    $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

                    if (isset($_POST["submit"])) {
                        if((!empty($_POST['password'])) && (!empty($_POST['username']))){
                    
                            //requete préparé
                            $stmt = $BDD->prepare("SELECT * FROM utilisateur WHERE Pseudo = ? AND Mot_de_Passe = ?");
                            $stmt->execute(array($_POST['username'], $_POST['password']));
                            $stmt = $stmt->fetch();


                            
                            //si ce n'est pas le bon MDP :
                            if (!$stmt) {
                                echo "Mauvais nom d'utilisateur ou mot de passe";
                            } else {
                                //Récuperer l'ID du perso directement depuis l'objet Compte
                                echo "<p>";
                                echo "Valeur username formulaire : ".$_POST['username'];
                                echo "</p> <p>";
                                echo "Valeur Mot de Passe formulaire : ".$_POST['password'];
                                echo "</p>";

                                $Username = $_POST['username'];
                                $Password = $_POST['password'];
                                $Compte = New Compte($Username, $Password);

                                $IDCompte = $Compte->GetIDPerso();

                                echo "$ IDCompte = ".$IDCompte;


                                $_SESSION['Connect']=$IDCompte;


                                //Refresh la page pour pouvoir acceder aux autres page.
                                header("Refresh:0");
                            }
                        }    
                    }
                }   
        ?>
    </body>
</html>
