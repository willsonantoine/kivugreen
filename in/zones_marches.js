$(document).ready(function () {



    load();



    $("#save_zone").click(function () {

        var id = $("#id_zone").val();
        var id_parent = $("#id_parent").val();
        var zone_name = $("#zone_name").val();
        var zone_description = $("#zone_description").val();

        HttpPost('/zone/create', { id, id_parent, zone_name, zone_description }, 'save_zone').then(function (params) {
            var json = params.data;
            if (json.status == 200) {
                document.getElementById("txyx").innerHTML = setErreur(false, json.message, 'Success', 'save_zone');

                if (id == "00") {
                    $("#zone_name").val("");
                    $("#zone_description").val("");
                    document.getElementById("txyx").innerHTML = '';

                }
                load();
                chargement(current_zone);

            } else {
                document.getElementById("txyx").innerHTML = setErreur(true, json.message, 'Erreur', 'save_zone');
            }

        }).catch((error) => {
            document.getElementById("txyx").innerHTML = setErreur(true, error.message, 'Erreur', 'save_zone');
            console.log(error);
        });

    });

    $("#save_marche").click(function () {

        var id = $("#id_marche").val();
        var marche_nom = $("#marche_nom").val();
        var marche_zone = id_zone_marche;
        var marche_jour = $("#marche_jour").val();
        var marche_amabassadeur = $("#marche_amabassadeur").val();

        HttpPost('/marche/create', { id, marche_jour, marche_zone, marche_nom, marche_amabassadeur }, 'save_marche').then(function (params) {
            var json = params.data;
            if (json.status == 200) {
                liste_marches = json.data;
                document.getElementById("infos_marche").innerHTML = setErreur(false, json.message, 'Success', 'save_marche');

                if (id == "00") {

                    $("#marche_nom").val("");
                    $("#marche_jour").val("");
                    $("#marche_amabassadeur").val("");

                }
                chargement_marche(marche_zone);

            } else {
                document.getElementById("infos_marche").innerHTML = setErreur(true, json.message, 'Erreur', 'save_marche');
            }

        }).catch((error) => {
            document.getElementById("infos_marche").innerHTML = setErreur(true, error.message, 'Erreur', 'save_marche');
            console.log(error);
        });

    });




});