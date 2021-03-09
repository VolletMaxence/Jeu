function CachePerso(){
    document.getElementById("CreationPerso").style.display = "none";
    console.log("Le formulaire de création de Perso est caché");
}

function AffichePerso(){
    alert("Affichage de la création perso :");
    document.getElementById("CreationCompte").style.display = "none";
    document.getElementById("CreationPerso").style.display = "block";
    console.log("Le formulaire de création de Compte est caché")
}
