<?php  
    class CompteCrea implements JsonSerializable {

        protected $_ID;
        protected $_Pseudo;
        protected $_Mot_de_Passe;
        protected $_IDPerso;
        protected $_BDD;
 

        public function __construct($Username, $Password)
        {
            //Objet PDO

            //Base Maison : 
            //$this->_BDD = new PDO("mysql:host=localhost; dbname=maxence_jeu; charset=utf8","root","");
            //base Providence :
            $this->_BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
            //base Alays Data :
            $BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

            $req = "SELECT * FROM utilisateur WHERE Pseudo = '$Username' AND Mot_de_Passe = '$Password'"; //
            $reponse = $this->_BDD->query($req);
            
            //recupere les valeur selon les donné en base :
            $Tab = $reponse->fetch(); //
            $this->_Pseudo = $Tab['Pseudo'];
            $this->_Mot_de_Passe = $Tab['Mot_de_Passe'];
            $this->_ID = $Tab['ID']; 
            $this->_IDPerso = $Tab['IDPerso'];

            //echo "Valeur $ Tab :: ".$Tab['Pseudo'].",".$Tab['Mot_de_Passe'].",".$Tab['ID'].",".$Tab['IDPerso'];
        }

        public function GetIDPerso()
        {
            return $this->_IDPerso;
        }

        public function InserCompte($Pseudo, $MDP)
        {
            $req = "INSERT INTO `utilisateur`(`Pseudo`, `Mot_de_Passe`) VALUES ('$Pseudo','$MDP')";
            $reponse = $this->_BDD->query($req);
        }

        public function GetIDUtilisateur($Pseudo, $MDP)
        {
            $req = "SELECT `ID` FROM `utilisateur` WHERE `Pseudo`= '$Pseudo' AND `Mot_de_Passe`= '$MDP' ORDER BY `ID` DESC";
            $reponse = $this->_BDD->query($req);
            $Tab = $reponse->fetch(); //

            return $Tab[0];
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