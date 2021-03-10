function CachePerso(){
    alert("Affichage Création Compte")
    document.getElementById("CreationPerso").style.display = "none";
    document.getElementById("Info").style.display = "none";
    document.getElementById("Info2").style.display = "none";

    console.log("Le formulaire de création de Perso est caché");
}

function AffichePerso(){
    alert("Affichage de la création perso :");
    document.getElementById("CreationCompte").style.display = "none";
    document.getElementById("CreationPerso").style.display = "block";
    document.getElementById("Info").style.display = "block";
    document.getElementById("Info2").style.display = "block";

    console.log("Le formulaire de création de Compte est caché")
}

