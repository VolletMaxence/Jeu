<?php
    class CopieAdv {

        protected $_ID;
        protected $_Nom;
        protected $_Vie;
        protected $_Defense;
        protected $_Attaque;
        protected $_Soin;
        protected $_BDD;

     

    public function __construct($ID)
    {
        //Objet PDO

        //Base Maison : 
        //$this->_BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
        //base Providence :
        $this->_BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");

        
        $req = "SELECT * FROM adversaire_copie WHERE ID = $ID"; //
        $reponse = $this->_BDD->query($req);

        $Tab = $reponse->fetch(); //
        $this->_Nom = $Tab['Nom'];
        $this->_Vie = $Tab['Vie'];
        $this->_Defense = $Tab['Defense'];
        $this->_Attaque = $Tab['Attaque'];
        $this->_Soin = $Tab['Soin'];

    }

    //Avec les infos, créé une copie de l'adversaire et retourne son ID
    public function CreationCopie()
    {
        $req = "INSERT INTO `adversaire_copie`( `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`) VALUES ('`$this->_Nom`,$this->_Vie,$this->_Attaque,$this->_Defense,$this->_Soin)";
        $reponse = $this->_BDD->query($req);

        $IDCopie = "SELECT `ID` FROM adversaire_copie ORDER BY ID DESC";
        $ID = $this->_BDD->query($IDCopie);
        $IDCopie = $ID->fetch();

        //Stockage de l'ID pour la destruction en base
        $this->_ID = $IDCopie[0];

        return $IDCopie[0];
    }
  
    //Supprimer la copie lorsque le combat est fini
    public function SupprCopie()
    {
        $ID = $this->_ID;
        $Suppr = "DELETE FROM `adversaire_copie` WHERE `ID`= $ID";
        $reponse = $this->_BDD->query($Suppr);

        $ID = $ID-1;
        $Suppr = "DELETE FROM `adversaire_copie` WHERE `ID`= $ID";
        $reponse = $this->_BDD->query($Suppr);
    }

    }
