
//Method Adversaire


//Check
function setAdversaire(IDAdversaire)
{
    $.ajax({
        url : 'newAdversaire.php',
        type : 'POST',
        data : { ID: IDAdversaire, action: "setAdversaire" },

        success : function(code_html, statut)
        {
            let userData = JSON.parse(code_html)
            document.getElementById("Adv").innerText = userData["_Nom"];

            let stats = document.getElementById("Stt");

            let hp = document.createElement("li");
            hp.setAttribute("id", "_AVie");
            hp.innerText = "PV : " + userData["_Vie"]
            stats.appendChild(hp)
            
            let atk = document.createElement("li");
            atk.setAttribute("id", "_AAtk");
            atk.innerText = "Atk : " + userData["_Attaque"]
            stats.appendChild(atk)

            let def = document.createElement("li");
            def.setAttribute("id", "_ADefense");
            def.innerText = "Def : " + userData["_Defense"]
            stats.appendChild(def)

            console.log(userData);
            user = code_html;

            //Cacher boutton
            //document.getElementById("setAdv").style.display = "none";
        },
        error : function(code_html, statut)
        {
            alert("L'affichage des infos de l'Adversaire bug");
        },
    })

}

//Adversaire le Perso
function AttaqueAdv(IDAdversaire, IDPerso) 

{

    // IDAdversaire, IDPerso

    console.log(IDAdversaire, IDPerso)

    $.ajax({
        url : 'newAdversaire.php',
        type : 'POST',
        data : { ID: IDAdversaire, action: "attaquer", target: IDPerso },

        success : function(code_html, statut)
        {
            //alert("Vous vous faite attaquer !");

            //Obtient les valeurs obtenu avec les methodes :
            //ERREUR
            let PersoData = JSON.parse(code_html)

            document.getElementById("_Vie").innerText = "PV : " + PersoData["hp"]

            //Si la cible à 0 PV : 
            if(PersoData["Mort"] == 1)
            {
                document.getElementById("PAdv1").innerText = `${PersoData["Nom"]} est déjà mort, pas la peine de s'acharner`;

                document.getElementById("PAdv2").innerText = ``;
            }
            //vérif KO
         //---------------------------------------------------------------------------
            //Si il a été tué, afficher l'info
            else if(PersoData["hp"] == 0)
            {
                document.getElementById("PAdv1").innerText = `Vous avez subi ${PersoData["DegatCalc"]} points de dégats`;

                document.getElementById("PAdv2").innerText = `${PersoData["Nom"]} à été tué. Dommage !`;

                //Afficher bouton pour revenir en arrière
                document.getElementById("attaque").style.display = "none";
                document.getElementById("userSoin").style.display = "none";



            } else if (PersoData["hp"] > 0) //sinon
            {
                //afficher ses PV après l'attaque
                document.getElementById("PAdv1").innerText = `Vous avez subi ${PersoData["DegatCalc"]} points de dégats`;
                document.getElementById("PAdv2").innerText = `${PersoData["Nom"]} à désormais ${PersoData["hp"]} PV.`;
            } else if (PersoData["hp" < 0])
            {
                alert("Erreur : les PV sont négatif");
            }
        },
        error : function(code_html, statut)
        {
            alert("c'est pas bon");
        },
    })
}

function SoinAdv(IDAdversaire)
{
    $.ajax({
        url : 'newAdversaire.php',
        type : 'POST',
        data : { ID: IDAdversaire, action: "Soin"},

        success : function(code_html, statut)
        {
            //Obtient les valeur obtenu avec la methode :
            let userSoin = JSON.parse(code_html)
            
            document.getElementById("_AVie").innerText = "PV : " + userSoin["hp"]

            //Récupere la variable Soin pour vérifier si le soin a eu lieu
            if(userSoin["Verif"] == 1)
            {
                //Remplace les valeur dans les paragraphe prévu :
                document.getElementById("PAdv1").innerText = `${userSoin["Nom"]} a déjà l'intégralité de ses PV, Soin impossible !`;
                document.getElementById("PAdv2").innerText = `  `;
            } else
            {
                document.getElementById("PAdv1").innerText = `${userSoin["Nom"]} c'est soigné de ${userSoin["Soin"]} PV.`;
                document.getElementById("PAdv2").innerText = `${userSoin["Nom"]} a désormais ${userSoin["hp"]} PV.`;
            }


            },
        error : function(code_html, statut)
        {
            alert("Le soin ne marche pas");
        },
    })
}