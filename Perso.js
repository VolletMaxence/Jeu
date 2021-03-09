function newUser(IDPerso)
{
    //METHOD PERSO
 //--------------------------------------------------------------------------
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { ID: IDPerso, action: "setPlayer" },

        success : function(code_html, statut)
        {
            let userData = JSON.parse(code_html);

            document.getElementById("name").innerText = userData["_Nom"];


            let stats = document.getElementById("stats");

            let hp = document.createElement("li");
            hp.setAttribute("id", "_Vie");
            hp.innerText = "Vie : " + userData["_Vie"]
            stats.appendChild(hp)
            
            let atk = document.createElement("li");
            atk.setAttribute("id", "_Atk");
            atk.innerText = "Atk : " + userData["_Attaque"]
            stats.appendChild(atk)

            let def = document.createElement("li");
            def.setAttribute("id", "_Defense");
            def.innerText = "Def : " + userData["_Defense"]
            stats.appendChild(def)

            let soin = document.createElement("li");
            soin.setAttribute("id", "_Soin");
            soin.innerText = "Soin : " + userData["_Soin"]
            stats.appendChild(soin)

            console.log(userData);
            user = code_html;
 
            //Cacher bouton
            document.getElementById("attaqueAdv").style.display = "none";
            document.getElementById("soinAdv").style.display = "none";

            document.getElementById("Retour").style.display = "none";

        },
        error : function(code_html, statut)
        {
            alert("L'affichage des infos du Personnage bug");
        },
    })
}

//Attaque
function Attaque (IDAdversaire, IDPerso) 
{
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { ID: IDPerso, action: "attaquer", target: IDAdversaire/* mettre variable */ },

        success : function(code_html, statut)

        {

            //alert("Attaque !");

            //Obtient les valeurs obtenu avec les methodes :
            let AdvData = JSON.parse(code_html)
            console.log(`HP : ${AdvData["Nom"]}`);

            console.table(AdvData)
            console.log(`HP : ${AdvData["hp"]}`);
            console.log(`Nom : ${AdvData["Nom"]}`);
            console.log(`DegatCalc : ${AdvData["DegatCalc"]}`);


            document.getElementById("_AVie").innerText = "PV : " + AdvData["hp"]

            //Si les dégats sont supérieur aux HP restant : 
            if(AdvData["Mort"] == 1)
            {
                document.getElementById("PPerso1").innerText = `${AdvData["Nom"]} est deja mort, pas la peine de s'acharner`;
                document.getElementById("PPerso2").innerText = ` `;
            }

            //vérif KO
         //---------------------------------------------------------------------------
            //Si il a été tué, afficher l'info
            else if(AdvData["hp"] == 0)
            {
                document.getElementById("PPerso1").innerText = `Vous avez infligé ${AdvData["DegatCalc"]} points de dégats`;
                document.getElementById("PPerso2").innerText = `${AdvData["Nom"]} a été tuer bien joué !`;

                //retourner a la page d'acceuil tout en soignant l'adversaire pour les prochaines fois 
                document.getElementById("attaque").style.display = "none";
                document.getElementById("userSoin").style.display = "none";
    
                document.getElementById("Abandon").style.display = "none";
                document.getElementById("Retour").style.display = "block";

            } else if (AdvData["hp"] > 0) //sinon
            {
                //afficher ses PV après l'attaque
                document.getElementById("PPerso1").innerText = `Vous avez infligé ${AdvData["DegatCalc"]} points de dégats`;
                document.getElementById("PPerso2").innerText = `${AdvData["Nom"]} à désormais ${AdvData["hp"]} PV.`;

            } else if (AdvData["hp" < 0])
            {
                alert("Erreur : les PV sont négatif");
            }

            //Vérifier valeur de l'IDPerso
            //console.log("BLABLA :", IDPerso);

            //Quand le joueur attaque, l'adversaire répond :
            //Appele fonction "ReponseMonstre" basé dans IA_Adversaire.js  
            Reponse_Monstre(IDAdversaire, IDPerso);

            


        },
        error : function(code_html, statut)
        {
            alert("c'est pas bon");
        },
    })
}

//Fonction Check dans newAdversaire.php : case setAdversaire

function Soin(IDAdversaire, IDPerso)
{
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { ID: IDPerso, target: IDAdversaire, action: "Soin"},

        success : function(code_html, statut)
        {
            //alert("Soin !");

            //Obtient les valeur obtenu avec la methode :
            let userSoin = JSON.parse(code_html)
            
            document.getElementById("_Vie").innerText = "Vie : " + userSoin["hp"]

            //Récupere la variable Soin pour vérifier si le soin a eu lieu
            if(userSoin["Verif"] == 1)
            {
                document.getElementById("PPerso1").innerText = `${userSoin["Nom"]} a déjà l'intégralité de ses PV, Soin impossible !`;
            } else
            {
                document.getElementById("PPerso1").innerText = `${userSoin["Nom"]} s'est soigné de ${userSoin["Soin"]} PV.`;
                document.getElementById("PPerso2").innerText = `${userSoin["Nom"]} a désormais ${userSoin["hp"]} PV.`;
            }

                //Quand le joueur attaque, l'adversaire répond :
                //Appele fonction "ReponseMonstre" basé dans IA_Adversaire.js  
                Reponse_Monstre(IDAdversaire, IDPerso);
            },
        error : function(code_html, statut)
        {
            alert("Le soin ne marche pas");
        },
    })
}

//------------------------------------------------------------------------------


