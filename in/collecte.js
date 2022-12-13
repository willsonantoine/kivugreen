$(document).ready(function () {

    var all_unites = [];
    var all_produits = [];
    var all_devise = [];

    init_log();

    $("#log").click(() => {
        var prix = $("#prix").val();
        var unite = $("#unite").val();
        var produit = $("#produit").val();
        var devise = $("#devise").val();
        var commentaire = $("#commentaire").val();

        HttpPost("/produit/collecte/create", { produit, unite, prix,devise,commentaire},"log").then((response) => {
            var json = response.data;
            if (json.status == 200) { 
                
                $('#prix').val('');
                $('#unite').val('');
                $('#produit').val('');
                $('#commentaire').val('');


                document.getElementById("infos").innerHTML = setErreur(false, json.message,"Success",'log','Ajouter');
            } else {
                document.getElementById("infos").innerHTML = setErreur(true, json.message,"Erreur",'log','Ajouter');
            }
        }).catch((error) => {
            document.getElementById("infos").innerHTML = setErreur(true, "Une erreur s'est produite. Veuillez réessayer plus tard","Erreur",'log','Ajouter');
            console.log(error)
        });
    });

    function init_log() {

        HttpPost("/produit/collecte/init", {}).then((response) => {
            var json = response.data;
            console.log(json);
            all_produits = json.data.produit;
            all_unites = json.data.unite;
            all_devise = json.devise;
            loadCombo('produit',all_produits,'Produit')
            loadCombo('unite',all_unites,'Unité')
        }).catch((error) => {

        });
    }

    function loadCombo(id, liste = [],default_val="Select") {
        var el = document.getElementById(id);
        el.innerHTML = `<option value="" selected>${default_val}</option>`;
        liste.forEach(element => {
           el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
        });
    }

});