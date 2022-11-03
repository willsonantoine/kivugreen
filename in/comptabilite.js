$(document).ready(function () {

    $("#classe").change(function () {

        var id_classe = document.getElementById('classe').value;

        if ($("#id_ref").val() == "00") {
            document.getElementById('numero').value = countValue(id_classe).toString();
        }

        $("#infos").html('');

    });

    function countValue(params) {

        var x = 0;
        var id = '';

        json.forEach(element => {
            if (params == element.id_classe) {
                id = element.numero_classe;
                x++;
            }
        });

        if (x == 0) {

            list_classes.forEach(element => {

                if (element.id == params) {
                    id = element.numero;
                }

            });

        };

        return id + x;
    }

    $("#save_compte").click(function () {

        HttpPost("/comptabilite/create/compte", {
            id: document.getElementById("numero").value,
            classe: document.getElementById("classe").value,
            designation: document.getElementById("designation").value,
            description: document.getElementById("description").value,
            id_ref: document.getElementById("id_ref").value,
            type: document.getElementById("compte_type").value
        }).then((res) => {
            var data = res.data;
            if (data.status == 200) {

                $("#numero").val("");
                $("#designation").val("");
                $("#description").val("");
                $("#compte_type").val("");

                loadComptes(null);

                $("#infos").html(setErreur(false, data.message));
            } else {
                $("#infos").html(setErreur(true, data.message));
            }
        }).catch((error) => {
            $("#infos").html(setErreur(true, error.message));

        });

    });

    const liste = document.getElementById("liste");

    $("#classe_load").change(function () {
        load($("#classe_load").val());
    });

    $("#save_mandateur").click(function () {

        HttpPost("/comptabilite/create/mandateur", {
            id: document.getElementById("id_mandateur").value,
            id_compte: document.getElementById("id_compte_mandateur").value,
            id_membre: document.getElementById("membre_").value,
            description: document.getElementById("motif_mantateur").value,
            type: document.getElementById("type_membre").value,
        }).then((res) => {
            var data = res.data;
            if (data.status == 200) {
                $("#membre_").val("");
                $("#motif_mantateur").val("");
                $("#type_membre").val("");
                load_mandateurs($("#id_compte_mandateur").val());
                $("#infos_mandateur").html(setErreur(false, data.message));
            } else {
                $("#infos_mandateur").html(setErreur(true, data.message));
            }
        }).catch((error) => {
            $("#infos_mandateur").html(setErreur(true, error.message));
            console.log(error)
        });
    });


    var default_devise;

    function loadComptes(classe) {
        HttpPost("/comptabilite/load-compte", { classe }).then((res) => {
            var data = res.data;
            if (data.status == 200) {
                json = data.data.data;
                default_devise = data.data.devise;
                list_transactions = data.data.transactions;
                list_membres = data.data.membres;
                list_classes = data.data.classes;
                list_devises = data.data.devises;

                load(null);
                load_classes();
                load_devises();
                load_transactions();

                $("#credit_list").html(setListe(json));
                $("#debit_list").html(setListe(json));
                $("#list_membre").html(setListe(list_membres));
                $("#classe_load").html(`<option value="null">Charger par classe</option>` + setListe(list_classes, true));
                $("#classe").html(`<option value="">Select</option>` + setListe(list_classes, true));
                $("#set-default-devise").html(default_devise);

            } else {
                $("#infos").html("Erreur de chargenement");
            }
        }).catch((error) => {
            $("#infos").html("setErreur(true, error.message)");
        });
    }

    $("#save_classe").click(function () {
        var numero = document.getElementById("class_numero").value;

        if ([1, 2, 3, 4, 5, 6, 7, 8, 9].includes(parseInt(numero))) {

            HttpPost("/comptabilite/create/classe", {
                id: document.getElementById("classe_id").value,
                numero: numero,
                designation: document.getElementById("classe_designation").value,
                description: document.getElementById("classe_description").value,
                type: document.getElementById("class_type").value
            }).then((res) => {

                var data = res.data;
                if (data.status == 200) {

                    $("#classe_id").val("00");
                    $("#class_numero").val("");
                    $("#classe_description").val("");
                    $("#classe_designation").val("");
                    $("#class_type").val("");

                    loadComptes(null);

                    $("#infos_classe").html(setErreur(false, data.message));
                } else {
                    $("#infos_classe").html(setErreur(true, data.message));
                }
            }).catch((error) => {
                $("#infos_classe").html(setErreur(true, error.message));
            });
        } else {
            $("#infos_classe").html(setErreur(true, "Le numéro de compte doit varier entre 0 et 9"));
        }


    });

    $("#save_devise").click(function () {

        HttpPost("/comptabilite/devise/create", {
            id: document.getElementById("devise_id").value,
            taux: document.getElementById("devise_taux").value,
            designation: document.getElementById("devise_designation").value,
            description: document.getElementById("devise_description").value
        }).then((res) => {

            var data = res.data;
            if (data.status == 200) {
                list_devises = data.data;

                $("#devise_id").val("00");
                $("#devise_taux").val("0");
                $("#devise_designation").val("");
                $("#devise_description").val("");

                loadComptes(null);

                $("#infos_devise").html(setErreur(false, data.message));
            } else {
                $("#infos_devise").html(setErreur(true, data.message));
            }
        }).catch((error) => {
            $("#infos_devise").html(setErreur(true, error.message));
        });



    });

    function load_devises() {

        var tab = document.getElementById("tab_devise");
        tab.innerHTML = "";
        var ix = 1;
        list_devises.forEach(element => {

            var isEtat = (parseInt(element.etat) == 1) ? 'Par défaut' : 'Select';
            var checked = (parseInt(element.etat) == 1) ? 'checked' : '';

            tab.innerHTML += ` 
            <tr id='devise${element.id}'>  
            <td>${ix}</td>
            <td>${element.designation}</td>
            <td>${element.taux}</td>
            <td>${element.description}</td>
            <td>
               <div class="flex align-items-center list-user-action">
                  <a class="iq-bg-primary" data-placement="top" title="Modifier" data-original-title="Modifier" href="#" 
                  onclick='selectDevise("${element.id}");'>
                     <i class="ri-pencil-line"></i>
                     </a>
                     <a class="iq-bg-primary" data-placement="top" title="Supprimer" data-original-title="Supprimer" href="#" 
                  onclick='deleteDevise("${element.id}","devise${element.id}");'>
                  <i class="ri-delete-bin-line"></i>
                     </a>
                  <div class="custom-control custom-switch custom-switch-color custom-control-inline">
                        <input type="checkbox" class="custom-control-input bg-success" id="btn_${element.id}" ${checked}="">
                        <label class="custom-control-label" onclick="selectToDefault('${element.id}','btn_${element.id}')" for="btn_${element.id}">${isEtat}</label>
                  </div>
               </div>
            </td>
         </tr>`;
            ix++;

        });
    }

    function load_classes() {

        var tab = document.getElementById("tab_classe");
        tab.innerHTML = "";

        list_classes.forEach(element => {
            tab.innerHTML += ` <tr id='ligne${element.id}'> 
            <td>${element.numero}</td>
            <td>${element.designation}</td>
            <td>${element.type}</td>
            <td>${element.description}</td>
            <td>
               <div class="flex align-items-center list-user-action">
                  <a class="iq-bg-primary" data-placement="top" title="Modifier" data-original-title="Modifier" href="#" 
                  onclick='selectClasse("${element.id}");'>
                     <i class="ri-pencil-line"></i>
                     </a>
                     <a class="iq-bg-primary" data-placement="top" title="Supprimer" data-original-title="Supprimer" href="#" 
                  onclick='deleteClasse("${element.id}","ligne${element.id}");'>
                  <i class="ri-delete-bin-line"></i>
                     </a>
               </div>
            </td>
         </tr>`;
        });
    }


    function setListe(liste = [], isInvese = false) {
        var liste_element = "";
        liste.forEach(element => {
            if (!isInvese) {
                liste_element += `<option value="${element.compte}">${element.id}</option>`;
            } else {
                liste_element += `<option value="${element.id}">${element.designation}</option>`;
            }
        });
        return liste_element;
    }

    function setListeCombo(liste = []) {
        var liste_element = "";
        liste.forEach(element => {
            liste_element += `<option value="${element.id}">${element.designation}</option>`;
        });
        return liste_element;
    }

    function load(params) {
        liste.innerHTML = "";
        var i = 0;
        json.forEach(element => {
            if (i <= 50) {
                if (params == null || params == 'null') {
                    liste.innerHTML += getElement(element);
                } else {
                    if (element.id_classe == params) {
                        liste.innerHTML += getElement(element);
                    }
                }
                i++;
            }
        });

    }

    $("#btn-act").click(function () {
        var txt = $("#recherche").val();

        if (txt.length > 0) {

            liste.innerHTML = "";
            var data_filter = json.filter(element => (element.compte.toLowerCase().indexOf(txt.toLowerCase()) !== -1 || (element.id == txt)));


            data_filter.forEach(element => {
                liste.innerHTML += getElement(element);

            });
        }


    });


    function getElement(element) {



        var today = ``;
        if (element.today == 1) {
            time = element.time_update.substring(0, 5);
            today = `<span class="badge badge-success">Ajourd'huit à ${time}</span>`;
        }

        return `<tr id='l${element.id_ref}'> 
        <td><span class="badge badge-primary">${element.id}</span></td> 
        <td>${element.compte} <span class="badge badge-success">${today}</span></td> 
        <td>${element.description} </td>
         
        <td>${element.createAt.substring(0, 10)} </td> 
        <td>
           <div class="flex align-items-right list-user-action">
           <button type="button" class="btn btn-outline-primary rounded-pill mb-3" data-toggle="modal" data-target=".create-compte"
           onclick='setInfos("${element.id_ref}");'>Modifier</button> 
           <button type="button" class="btn btn-outline-warning rounded-pill mb-3" data-toggle="modal" data-target=".etat-compte"
           onclick='loadBy("${element.id_ref}","${element.compte}");'>Historique</button> 
           <button type="button" class="btn btn-outline-success rounded-pill mb-3" data-toggle="modal" data-target=".mandateurs"
           onclick='loadMandateurs("${element.id}","${element.compte}"); document.getElementById("id_compte_mandateur").value="${element.id}";'>Mandateurs</button> 
           </div>
        </td>
 
     </tr>
     
     
      `;
    }

    function loadSolde(json_solde) {
        var solde_element = JSON.stringify(json_solde);

        return solde_element.replace('[','').replace(']','').replace('\"','').replace('\"','').replace('\solde\":','');
    }

    function load_transactions() {

        var tab = document.getElementById("tab_transactions");
        tab.innerHTML = "";
        var ex = 1;
        list_transactions.forEach(element => {
            tab.innerHTML += ` <tr>
            <td>${ex}</td>
            <td>${element.designation}</td>
            <td>${element.compte_from}</td>
            <td>${element.compte_to}</td>
            <td>${element.montant}</td>
            <td>${element.motif}</td>
            <td>
               <div class="flex align-items-center list-user-action">
                  <a class="iq-bg-primary" data-placement="top" title="" data-original-title="Modifier" href="#" 
                  onclick='
                    show_transaction("${element.id}");
                  '>
                     <i class="ri-pencil-line"></i>
                  </a>
                  <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" 
                  onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette element ?')){
                    HttpPost('/transactions/delete',{id:${element.id}},function(params){
                        window.location.reload();
                });} "><i class="ri-delete-bin-line"></i></a>
               </div>
            </td>
         </tr>`;
            ex++;
        });
    }






    $("#save_transactions").click(function (e) {
        var credit = $("#credit_").val();
        var debit = $("#debit_").val();
        var designation = $("#designation_").val();
        var motif = $("#motif").val();
        var id = $("#id").val();
        var type = $("#type_").val();
        var montant = $("#montant_").val();

        HttpPost("/transactions/create", { id: id, montant: montant, credit: credit, type: type, debit: debit, designation: designation, motif: motif }).then(function (response) {
            var json = response.data;
            if (json.status == 200) {

                $("#credit_").val('');
                $("#debit_").val('');
                $("#designation_").val('');
                $("#montant_").val('');
                $("#type_").val('');
                $("#motif").val('');
                $("#id").val('00');
                loadComptes(null);
                load_transactions();
                $('#infosx').html(setErreur(false, json.message));
            } else {
                $('#infosx').html(setErreur(true, json.message));
            }
        }).catch(function (response) {
            console.log("Error creating transactions    : " + response.message);
        });
    });

    loadComptes(null);
});


