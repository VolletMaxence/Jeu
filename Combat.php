<?php
    require "Session/Session.php";
    include "Objet/Copie_Adversaire.php";
    include "Objet/Perso.php";
?>

<html> 
    <head>
        <link rel="icon" href="/Image/icone.ico"/>
        <meta charset="UTF-8">
        <title>Combat</title>  
        <link rel="stylesheet" href="CSS/Creation.css" media="screen" type="text/css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body>
        <?php
            if($_SESSION && $_SESSION['Connect'] != 0){ 
            ?>
                <form>
                    <!-- Affichage des stats Adversaire -->
                    <h1 id="Adv"></h1>
                    <ul id="Stt">
                    </ul>

                    <!-- Affichage des stats Perso -->
                    <h2 id="name"></h2>
                    <ul id="stats">
                    </ul>
            <div id="text">
                    <!-- Textes affichant les infos de ce qu'il se passe lors du combat -->
                    <!-- Info de ce que fait Perso-->
                    <p id="PPerso1">    </p>

                    <p id=PPerso2>  </p>

                    <!-- Info de ce que fait Adversaire -->
                    <p id=PAdv1>    </p>

                    <p id=PAdv2>    </p>
            </div>


                    <!-- Variables des adversaire / perso -->
                    <?php
                    //Base Maison : 
                    //$BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
                    //base Providence :
                    //$BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
                    //base Alays Data :
                    $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");


                    //Compter le nombre de Mob en base pour le nombre aléatoire
                    $req = 'SELECT COUNT(*) FROM `adversaire` WHERE 1';
                    $reponse = $BDD->query($req);
                    $NBRMonstre = $reponse->fetch(); //



                    $IDAdversaire = rand(1,$NBRMonstre['COUNT(*)']);

                    //Créer copie pour Adversaire : 
                    $Copie = New CopieAdv($IDAdversaire);
                    $IDAdversaire = $Copie->CreationCopie();

                    //recuperer l'ID depuis le compte
                    $IDPerso = $_SESSION['Connect'];

                    //Mise en place PV du Perso a 100 pour éviter triche
                    $Perso = New Perso($_SESSION['Connect']);
                    $Perso->Heal($_SESSION['Connect']);

                    //Résolution de bug : guillemet s'inserait dans les fonction
                    $fulldick = $IDAdversaire.",".$IDPerso;
                    //echo $fulldick;
                    ?>
                
                    <form name="Action">
                        <!-- Boutton Afficher Stats Perso --> <!--
                        <button type="button" id="setUser" onclick=newUser(<?= $fulldick?>)> New Utilisateur </button>
                        -->

                        <!-- Boutton Attaque -->
                        <button type="button" id="attaque" onclick=Attaque(<?= $fulldick?>)> Attaque </button>

                        <!-- bouton Afficher Stats Adversaire --> <!--
                        <button type="button" id="setAdv" onclick=setAdversaire(<?= $fulldick?>)> Check </button>
                        -->

                        <!-- bouton de soin -->
                        <button type="button" id="userSoin" onclick=Soin(<?= $fulldick?>)> Soin </button>
                    </form>

                    <form name="Admin">
                        <!-- TEMPORAIRE : TEST POUR LES ATTAQUES D'ADVERSAIRE -->
                        <button type="button" id="attaqueAdv" onclick=AttaqueAdv(<?= $fulldick?>)> Test d'attaque Adversaire </button>
                
                        <!-- TEMPORAIRE : TEST POUR LES SOIN D'ADVERSAIRE -->
                        <button type="button" id="soinAdv" onclick=SoinAdv(<?= $fulldick?>)> Test de soin Adversaire </button>
                    </form>

                    <!-- Bouton déconnection -->
                    <form name="Abandon" method="POST" id="Abandon">
                        <input type="submit" name='Abandon' id="Abandon" value='Abandonner'>
                    </form>
                    <form name="Retour" method="POST" id="Retour">
                        <input type="submit" name='Retour' id="Retour" value="Retourner à l'acceuil">
                    </form>
                         
                        <?php
                            //Si le joueur veux abandonner le combat :
                            if(ISSET($_POST['Abandon']))
                            {
                                //retirer 1 au score
                                $Perso->scoreMoins($_SESSION['Connect']);
                                //Le score est désormais retirer des l'arrivé sur la page pour éviter les abuses avec les refresh

                                //Supprimer la copi pour pas surcharger la base
                                $Copie->SupprCopie();

                                //Renvoie sur la page d'acceuil
                                echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
                            }
                            //Si le joueur a gagner le combat :
                            if(ISSET($_POST['Retour']))
                            {
                                //Ajouter 1 au score
                                $Perso->scorePlus($_SESSION['Connect']);

                                //Supprimer la copi pour pas surcharger la base
                                $Copie->SupprCopie();

                                //Renvoie sur la page d'acceuil
                                echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
                            }
                        ?>


                </form>
            <?php
            }
        ?>
    </body>

    
    <script src="Ia_Adversaire.js"></script>
   
    <script src="Perso.js"></script>
    <script src="Adversaire.js"></script>

    <script type="text/javascript">
            (function start() 
                    {
                        newUser(<?= $IDPerso ?>);
                        setAdversaire(<?= $IDAdversaire ?>);
                    })();
            </script>
</html>