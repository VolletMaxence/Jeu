<?php  

    include ("Objet/Perso.php");
    include ("Objet/Adversaire.php");
    
    $Perso = new Perso($_POST["ID"]);


    switch ($_POST["action"]) {

        case 'setPlayer' :
            //Affiche les infos du Personnage
            echo json_encode(new Perso($_POST["ID"]));

            break;
        case 'attaquer':
            $Perso = new Perso($_POST["ID"]);
            $target = new Adversaire($_POST["target"]);

            $Perso->Attaque($target);

            break;
        case 'Soin':
            $Perso = new Perso($_POST["ID"]);
            $Perso->Soin();
            
            break;

        case 'test':
            echo get_class(json_decode($_POST["Perso"]));
   
            break;
    }
?>


