function Reponse_Monstre(IDAdversaire, IDPerso)
{
    //"IA" de l'Adversaire

    console.log(IDPerso);

    $.ajax({
        url : 'newAdversaire.php',
        type : 'POST',
        data : { ID: IDAdversaire, action: "Reponse_Monstre", target: IDPerso },

        success : function(code_html, statut)
        {
            //Obtient les infos de la vie de l'adversaire
            let Adversaire = JSON.parse(code_html)
            console.log(`PV adversaire = `, Adversaire["Vie"])

            //alert(Adversaire["Nom"]+" fait quelque chose !");


            if(Adversaire["Vie"] > 95)
            {
                //Le heal ne sert a rien : 100% de chance d'attaquer
                //alert("case 100");
                AttaqueAdv(IDAdversaire, IDPerso);
            } 

            //Si les dégats recus ne permettent pas d'utiliser integralement le Soin
            else if (Adversaire["Vie"] <= 95 && Adversaire["Vie"] > 65)
            {
                //Nombre random
                //le maximum est exclus, il faut dont ajouter 1
                var IA = Math.floor(Math.random() * 5) + 1;
                
                console.log("Valeur du nombre random qui décide de l'action : ", IA, "(Si ce n'est pas un int = erreur)");                    
                
                //L'option défini selon les PV de l'adversaire
                //alert("Soin pas assez utile");


                //Vérifier le nombre pour faire l'action = random
                if(IA == 1)    // 20% de chance de se heal
                {
                    //Action effectué selon le nombre obtenu
                    SoinAdv(IDAdversaire, IDPerso);
                } else          // 80% de chance d'attaquer
                {
                    AttaqueAdv(IDAdversaire, IDPerso);
                }


            } 

            //Si les dégats recus permettent d'utiliser integralement le soin mais que les PV ne sont pas trop bas :
            else if (Adversaire["Vie"] <= 65 && Adversaire["Vie"] >= 45)
            {
                //Nombre random
                //le maximum est exclus, il faut dont ajouter 1
                var IA = Math.floor(Math.random() * 5) + 1;
                console.log("Valeur du nombre random qui décide de l'action : ", IA, "Si ce n'est pas un int = erreur)");                

                //L'option défini selon les PV de l'adversaire
                //alert("Vie suffisante pour faire un heal efficace")

                //Vérifier le nombre pour faire l'action = random
                if(IA == 1 || IA == 2)    // 40% de chance de Soin
                {
                    //Action effectué selon le nombre obtenu
                    SoinAdv(IDAdversaire, IDPerso);
                } else                      // 60% de chance d'Attquer
                {
                    AttaqueAdv(IDAdversaire, IDPerso);
                }
            }

            //Si les dégats recus permettent d'utiliser integralement le soin mais que l'adversaire n'est pas dans une "mauvaise posture" :
            else if (Adversaire["Vie"] <= 44 && Adversaire["Vie"] >20)
            {
                //Nombre random
                //le maximum est exclus, il faut dont ajouter 1
                var IA = Math.floor(Math.random() * 3) + 1;
                console.log("Valeur du nombre random qui décide de l'action : ", IA, "(Si ce n'est pas un int = erreur)");                

                //L'option défini selon les PV de l'adversaire
                //alert("Vie suffisante pour faire un heal efficace + Adversaire dans une bonne situation")

                //Vérifier le nombre pour faire l'action = random
                if(IA == 1 || IA == 2)        // 66.6% de chance de Soin
                {
                    //Action effectué selon le nombre obtenu
                    SoinAdv(IDAdversaire, IDPerso);
                } else                         // 33.3% de chance d'attaquer
                {
                    AttaqueAdv(IDAdversaire, IDPerso);
                }
            }  

            //Si l'adversaire est en mauvaise posture : 
            else if (Adversaire["Vie"] <= 20 && Adversaire["Vie"] > 0)
            {
                //Nombre random
                //le maximum est exclus, il faut dont ajouter 1
                var IA = Math.floor(Math.random() * 4) + 1;
                console.log("Valeur du nombre random qui décide de l'action : ", IA, "(Si ce n'est pas un int = erreur)");                

                //L'option défini selon les PV de l'adversaire
                //alert("Adversaire en mauvaise posture")

                //Vérifier le nombre pour faire l'action = random
                if(IA == 1)    //25% de chance d'attaquer
                {
                    //Action effectué selon le nombre obtenu
                    AttaqueAdv(IDAdversaire, IDPerso);
                } else          //75% de chance de se heal
                {
                    SoinAdv(IDAdversaire, IDPerso);
                }
            }
            //SI Adversaire a 0 PV : ne rien faire
            else if (Adversaire["Vie"] = 0)
            {
                console.log("L'adversaire a été tué, ne pas répliquer")
            }




            /*Si erreur = pas de réponse
            else
            {
                alert("Cette situation n'est pas prise en compte par l'IA ???? Merci de m'indiquer laquel c'est ");
            } */
        },
        error : function(code_html, statut)
        {
            alert("Erreur : problème 'IA' ");
        },
    })
}