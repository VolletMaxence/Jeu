<?php
    require "Session/Session.php";
    include "Objet/Copie_Adversaire.php";
    include "Objet/Perso.php";
?>

<html> 
    <head>
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

                    <!-- Textes affichant les infos de ce qu'il se passe lors du combat -->
                    <!-- Info de ce que fait Perso-->
                    <p id="PPerso1">    </p>

                    <p id=PPerso2>  </p>

                    <!-- Info de ce que fait Adversaire -->
                    <p id=PAdv1>    </p>

                    <p id=PAdv2>    </p>



                    <!-- Variables des adversaire / perso -->
                    <?php
                    $IDAdversaire = rand(1,1);
                    //Créer copie pour Adversaire : 
                    $Copie = New CopieAdv($IDAdversaire);

                    $IDAdversaire = $Copie->CreationCopie();

                    //recuperer l'ID depuis le compte
                    $IDPerso = $_SESSION['Connect'];

                    $Perso = New Perso($_SESSION['Connect']);
                    $Perso->Heal($_SESSION['Connect']);

                    $fulldick = $IDAdversaire.",".$IDPerso
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
                            if(ISSET($_POST['Abandon']))
                            {
                                $Perso->scoreMoins($_SESSION['Connect']);

                                echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
                            }
                            if(ISSET($_POST['Retour']))
                            {
                                $Perso->scoreMoins($_SESSION['Connect']);

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