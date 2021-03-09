let user;


function newUser(IDAdversaire, IDPerso)
{
    //METHOD PERSO
//--------------------------------------------------------------------------
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { ID: IDPerso, action: "setPlayer" },

        success : function(code_html, statut)
        {
            let userData = JSON.parse(code_html)
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

            console.log(userData);
            user = code_html;

            
        },
        error : function(code_html, statut)
        {
            alert("L'affichage des infos du Personnage bug");
        },
    })

}


// const { id } = document.querySelector(".target");

// const target = document.querySelector(".target").id;

// console.log(id);

function Attaque (IDAdversaire, IDPerso) 
{
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { ID: IDPerso, action: "attaquer", target: IDAdversaire/* mettre variable */ },

        success : function(code_html, statut)
        {


            //Affiche les stats du perso
            let userData = JSON.parse(code_html)

            
            
            console.log(userData);

            let stats = document.getElementById("stats");

            let hp = document.getElementById("_Vie");

            hp.innerText = "Vie : " + userData["_Vie"]
            
            let atk = document.getElementById("_Atk");
            atk.innerText = "Atk : " + userData["_Attaque"]

            let def = document.getElementById("_Defense");
            def.innerText = "Def : " + userData["_Defense"]

            console.log(userData);
            user = code_html;


            //Affiche Stats Adversaire
            let AdvData = JSON.parse(code_html)
            document.getElementById("Adv")

            let Stt = document.getElementById("Stt");

            let Ahp = document.getElementById("_Vie");
            hp.innerText = "Vie : " + userData["_Vie"]
            
            let Aatk = document.getElementById("_Atk");
            atk.innerText = "Atk : " + userData["_Attaque"]

            let Adef = document.getElementById("_Defense");
            def.innerText = "Def : " + userData["_Defense"]

            console.log(userData);
            user = code_html;

        },
        error : function(code_html, statut)
        {
            alert("c'est pas bon");
        },
    })
}

function Check()
{
    alert("Check !")
    $.ajax({
        url : 'newUser.php',
        type : 'POST',
        data : { interact: "test", perso: "Sodipute" },

        success : function(code_html, statut)
        {
            console.log(code_html);
        },
        error : function(code_html, statut)
        {
            alert("c'est pas bon");
        },
    })
}

function Soin()
{
    alert("Soin !")
}

//------------------------------------------------------------------------------

//Method Adversaire



function setAdversaire(IDAdversaire, IDPerso)
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

            console.log(userData);
            user = code_html;

            
        },
        error : function(code_html, statut)
        {
            alert("L'affichage des infos de l'Adversaire bug");
        },
    })

}