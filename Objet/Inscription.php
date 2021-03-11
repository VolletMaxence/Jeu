<?php  
    class InscriptionPerso implements JsonSerializable {

        protected $_ID;
        protected $_Pseudo;
        protected $_Attaque;
        protected $_Defense;
        protected $_Soin;
        protected $_BDD;
 

        public function __construct($Username, $Attaque, $Defense, $Soin)
        {
            //Objet PDO

            //Base Maison : 
            //$this->_BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
            //base Providence :
            //$this->_BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
            //base Alays Data :
            $this->_BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

            $req = "SELECT `Nom`,`Attaque`,`Defense`,`Soin` FROM perso WHERE `Nom` = '$Username' AND `Attaque`= $Attaque AND `Defense`=$Defense AND `Soin`=$Soin"; //
            $reponse = $this->_BDD->query($req);
            
            //recupere les valeur selon les donné en base :
            $Tab = $reponse->fetch(); //


            $this->_Pseudo = $Tab['Nom'];
            $this->_Attaque = $Tab['Attaque'];
            $this->_Defense = $Tab['Defense']; 
            $this->_Soin = $Tab['Soin'];

            //echo "Valeur $ Tab :: ".$Tab['Pseudo'].",".$Tab['Mot_de_Passe'].",".$Tab['ID'].",".$Tab['IDPerso'];
        }

        public function GetIDPerso()
        {
            return $this->_IDPerso;
        }

        public function InserCompte($Pseudo, $Attaque, $Defense, $Soin)
        {
            $req = "INSERT INTO `perso`(`Nom`, `Attaque`, `Defense`, `Soin`) VALUES ('$Pseudo' , $Attaque , $Defense , $Soin)";
            $reponse = $this->_BDD->query($req);
        }

        public function GetIDUtilisateur($Pseudo, $Attaque, $Defense, $Soin)
        {
            //echo "P : ".$Pseudo.", A : ".$Attaque.", D : ".$Defense.", S : ".$Soin;

            $req = "SELECT `ID`,`Nom`,`Attaque`,`Defense`,`Soin` FROM `perso` WHERE `Nom`= '$Pseudo' AND `Attaque`= $Attaque AND `Defense`= $Defense AND `Soin`= $Soin";
            //SELECT `ID`,`Nom`,`Attaque`,`Defense`,`Soin` FROM `perso` WHERE `Nom`= 'Gros Chien' AND `Attaque`= 50 AND `Defense`= 10 AND `Soin`= 30
            $reponse = $this->_BDD->query($req);
            
            $Tab = $reponse->fetch(); //
            $this->_ID = $Tab['ID'];

            echo "this ID : ".$Tab['ID'];

            return $this->_ID;
        }

        public function Liaison($IDPerso, $IDCompte)
        {
            //Mise en place de la valeur de l ID compte dans le perso
            $req = "UPDATE `perso` SET `IDCompte`= $IDCompte WHERE `ID`=$IDPerso";
            $reponse = $this->_BDD->query($req);

            //Mise en place de la valeur de l'IDPerso dans le Compte
            $req = "UPDATE `utilisateur` SET `IDPerso`= $IDPerso WHERE `ID`=$IDCompte";
            $reponse = $this->_BDD->query($req);
        }

        public function test() 
        {
            return "Suce PUTE";
        }
    
        public function jsonSerialize()
        {
            return
            [
                'test' => $this->test(),
                "_ID"           => $this->_ID,
                "_Pseudo"       => $this->_Pseudo,
                "_Mot_de_Passe" => $this->_Mot_de_Passe,
                "_IDPerso"      => $this->_IDPerso,
            ];
        }

    }
?>