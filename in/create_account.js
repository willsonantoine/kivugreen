$(document).ready(function () {

    $("#create").click(function () {

        HttpPost("/api/v2/account/create/entreprise", {
            "name": $("#name").val(),
            "email": $("#email").val(),
            "email2": $("#email2").val(),
            "phone": $("#phone").val(),
            "addresse": $("#addresse").val(),
            "ville": $("#ville").val(),
            "pays": $("#pays").val(),
        },'create').then(function functionName(response) {
            var json = response.data;
           
            if (json.status == 200) {
                document.getElementById("infos").innerHTML = setErreur(true, json.message,'Success','create','Créer un un compte');
                window.location.href = `/admin/create-account/val?ra=` + $("#email2").val();
            }else{
                document.getElementById("infos").innerHTML = setErreur(true, json.message,'Erreur','create','Créer un un compte');
            }
        }).catch((error) => {
            document.getElementById("infos").innerHTML = setErreur(true, error.message,'Erreur','create','Créer un un compte');
        });

    });

    $("#verifier").click(function () {

        HttpPost("/api/v2/account/create/entreprise/verifier", {
            "code": $("#code").val()
        },'verifier').then(function functionName(response) {
            var json = response.data;
           
            if (json.status == 200) {
                document.getElementById("infos").innerHTML = setErreur(false, json.message,'Success','verifier','Vérifier');
                window.location.href = `/admin/lancer`;
            }else{
                document.getElementById("infos").innerHTML = setErreur(true, json.message,'Erreur','verifier','Vérifier');
            }
        }).catch((error) => {
            document.getElementById("infos").innerHTML = setErreur(true, error.message,'Erreur','verifier','Vérifier');
        });

    });


});