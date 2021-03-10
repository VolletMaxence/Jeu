<?php  
    class Adversaire implements JsonSerializable {

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
        //$this->_BDD = new PDO("mysql:host=192.168.64.116; dbname=Maxence_Jeu; charset=utf8", "root", "root");
        //base Alays Data :
        $this->_BDD = new PDO("mysql:host=mysql-xence.alwaysdata.net; dbname=xence_maxence_jeu; charset=utf8", "xence", "Tallys2001");

        $req = "SELECT * FROM adversaire_copie WHERE ID = $ID"; //
        $reponse = $this->_BDD->query($req);
        
        //recupere les valeur selon les donné en base :
        $Tab = $reponse->fetch(); //

        $this->_ID = $Tab['ID'];
        $this->_Nom = $Tab['Nom'];
        $this->_Vie = $Tab['Vie'];
        $this->_Defense = $Tab['Defense'];
        $this->_Attaque = $Tab['Attaque'];
        $this->_Soin = $Tab['Soin'];


        //echo "Valeur $ Tab :: ".$Tab['ID'].",".$Tab['Nom'].",".$Tab['Vie'].",".$Tab['Defense'].",".$Tab['Attaque'].",".$Tab['Soin'];
    }


    //L'objet Adversaire se fait attaquer par un objet "Perso"
    public function SeFaitAttaquer($Degat)
    {

        //vérifier si mort, et le stocker avec une variable
        if($this->_Vie == 0)
        {
            //pas la peine de faire le reste, l'attaque échoue
            $Mort = 1;
            //Mise variable dans les autre : ne seront pas utiliser mais au moins ca marche
            $DegatCalc = 0;

        }else//Si ennemie est vivant : 
        {
            //Ennemie pas déja mort, donc $Mort = 0 = false
            $Mort = 0;

            //Calcule des degats
            $DegatCalc = $Degat - $this->_Defense;
            if($DegatCalc < 0)
            {
                $DegatCalc = 0;
            }
            $this->_Vie = $this->_Vie - $DegatCalc;
            

            //vérifier niveau de vie, le remettre à 0 si négatif
            if ($this->_Vie < 0)
            {
                //Calcule des dégats pour atteindre 0 :
                $DegatCalc = $DegatCalc + $this->_Vie;
                //Remise a 0 de la vie
                $this->_Vie = 0;
            }
            
            $VieActuel = $this->_Vie;

            $req = "UPDATE `adversaire_copie` SET `Vie`=$VieActuel WHERE `ID`=$this->_ID"; //
            $reponse = $this->_BDD->query($req);
            

        }
        echo json_encode(array('Nom' => $this->_Nom , 'DegatCalc' =>  $DegatCalc , "hp" => $this->_Vie , "Mort" => $Mort , "ID" => $this->_ID));
    }


    //L'objet Adversaire attque un objet "Perso"
    public function Attaque($Attaquer)
    {
        $Attaquer->SeFaitAttaquer($this->_Attaque);
    }



    public function Soin()
    {
        //Si le perso a déja tout ses PV, alors il n'y a pas de soin
        if($this->_Vie == 100)
        {
            //Variable pour dire qu'il n'y a pas eu de soin car il est déja full vie
            $VerifSoin = 1;
            //Pas de soin, il est donc de 0
            $RealSoin = 0;

        } else //Si le soin est necessaire :
        {
            //Le soin a lieu, donc $VerifSoin = 0 = false
            $VerifSoin=0;
            //On prend les PV avant le soin pour calculer si il y a Surplus
            $PVAvantSoin = $this->_Vie;
            //Le soin
            $this->_Vie = $this->_Vie + $this->_Soin;

            //Remise a niveau du soin si il a soigné plus de prévu
            if ($this->_Vie > 100)
            {
                $this->_Vie = 100;
                //calcule du soin pour arriver a 100 PV :
                $RealSoin = $this->_Vie - $PVAvantSoin;
                // $RealSoin est la valeur qui sera envoyé
            } else
            {
                //On prend la valeur du soin de base puisqu'on c'est servis de toute sa puissance
                $RealSoin = $this->_Soin;
            }

            $VieActuel = $this->_Vie;

            //UPDATE en base
            $req = "UPDATE `adversaire_copie` SET `Vie`= $VieActuel"; 
            $reponse = $this->_BDD->query($req);
        }
        echo json_encode(array('Nom' => $this->_Nom , 'Verif' =>  $VerifSoin , "hp" => $this->_Vie , "Soin" => $RealSoin));
    }
 

    //Renvoie la vie pour l'IA et choisir quel action faire
    public function ObtenirInfo()
    {
        $ViePerdu = 100-$this->_Vie;
        //echo "Valeur $ Tab :: ".$Tab['ID'].",".$Tab['Nom'].",".$Tab['Vie'].",".$Tab['Defense'].",".$Tab['Attaque'].",".$Tab['Soin'];
        echo json_encode(array('Nom' => $this->_Nom, 'Vie' => $this->_Vie, 'ViePerdu' => $ViePerdu, 'Soin' => $this->_Soin));
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
            "_ID"        => $this->_ID,
            "_Nom"       => $this->_Nom,
            "_Vie"       => $this->_Vie,
            "_Defense"   => $this->_Defense,
            "_Attaque"   => $this->_Attaque,
        ];
    }
}

?>