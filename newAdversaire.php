<?php 

    include ("Objet/Adversaire.php");
    include ("Objet/Perso.php");
//définir ID
    $Adversaire = new Adversaire($_POST["ID"]);
    
    
    switch ($_POST["action"]) {

        case 'setAdversaire' :
            //Affiche les infos de l'Adversaire
            echo json_encode(new Adversaire($_POST["ID"]));

            break;
        case 'attaquer':
            $Adversaire = new Adversaire($_POST["ID"]);
            $target = new Perso($_POST["target"]);

            $Adversaire->Attaque($target);
            
            break;
        case 'Soin':
            $Adversaire = new Adversaire($_POST["ID"]);
            $Adversaire->Soin();
            break;
        //Recupère vie pour tester les conditions de l'IA
        case 'Reponse_Monstre':
            $Adversaire = new Adversaire($_POST["ID"]);
            $Adversaire->ObtenirInfo();
            break;
        case 'test':
            echo get_class(json_decode($_POST["Adversaire"]));
   
            break;
         
        default:
            # code...
            break;
    }




?>