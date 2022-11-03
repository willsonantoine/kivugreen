$(document).ready(function () {

    var isDevise = false;


    $("#save").click(function () {

        var debit = $("#debit_").val();
        var credit = $("#credit_").val();
        var type = $("#type").val();
        var montant = $("#montant").val();
        var devise = $("#devise").val();
        var montant_toute_lettre = $("#montant_toute_lettre").val();
        var beneficiaire = $("#benef").val();
        var id_succursale = $("#sicursale_").val();
        var motif = $("#motif").val();
        var date = $("#date").val();
        var favo = "00";


        var dev1 = $('#devise').find(":selected").text();
        var dev2 = $('#devise_billet').find(":selected").text();




        if (type == 'DEPOT' || type == 'RETRAIT') {
            if (dev1 == dev2) {
                if (total_billetage == montant) {
                    if (credit.length > 0 && debit.length > 0 && montant.length > 0 && montant_toute_lettre.length > 0 && beneficiaire.length > 0 && motif.length > 0) {
                        HttpPost("/operations/create", {
                            debit, credit, type, montant, devise, montant_toute_lettre, date, beneficiaire, id_succursale, motif, favo, id_transaction
                        }).then((res) => {
                            var data = res.data;
                            if (data.status == 200) {
                                save_billetage(data.data.id);
                                $("#debit_").val("");
                                $("#montant").val("");
                                $("#montant_toute_lettre").val("");
                                $("#benef").val("");
                                $("#motif").val("");
                                $("#infos").html(setErreur(false, data.message));
                                load();
                            } else {
                                $("#infos").html(setErreur(true, data.message));
                            }
                        }).catch((error) => {
                            $("#infos").html(setErreur(true, error.message));
                            console.log(error)
                        });
                    } else {
                        $("#infos").html(setErreur(true, "Aucune case ne doit etre vide !."));
                    }
                } else {
                    $("#infos").html(setErreur(true, "Le montant n'est pas égale au montant du billetage"));
                }
            } else {
                $("#infos").html(setErreur(true, "La devise du montant total et la devise du billetage ne sont pas les mêmes."));
            }
        } else if (type == "PAYEMENT" || type == "VIREMENT" || type == 'ENTREE' || type == 'SORTIE' ||type == 'COMMANDE') {
            if (credit.length > 0 && debit.length > 0 && montant.length > 0 && montant_toute_lettre.length > 0 && beneficiaire.length > 0 && motif.length > 0) {
                HttpPost("/operations/create", {
                    debit, credit, type, montant, devise, montant_toute_lettre, date, beneficiaire, id_succursale, motif, favo,id_transaction
                }).then((res) => {
                    var data = res.data;
                    if (data.status == 200) {
                        save_billetage(data.data.id);
                        $("#debit_").val("");
                        $("#montant").val("");
                        $("#montant_toute_lettre").val("");
                        $("#benef").val("");
                        $("#motif").val("");
                        $("#infos").html(setErreur(false, data.message));
                        load();
                    } else {
                        $("#infos").html(setErreur(true, data.message));
                    }
                }).catch((error) => {
                    $("#infos").html(setErreur(true, error.message));
                });
            } else {
                $("#infos").html(setErreur(true, "Aucune case ne doit etre vide !."));
            }
        } else {
            $("#infos").html(setErreur(true, "Veiller définir le billetage svp"));
        }



    });

    var list_comptes = [];
    var list_beneficiare = [];
    var list_succursale = [];
    var list_devises = [];
    var list_operations = [];
    var list_total = [];


    var listeop = document.getElementById('listeop');

    load();

    function load() {

        HttpPost("/operations/loads-elements",
            {
                date1: $("#date1").val(),
                date2: $("#date2").val(),

            }).then((res) => {

                list_comptes = res.data.data.comptes;
                list_succursale = res.data.data.succursale;
                list_beneficiare = res.data.data.benefiaires;
                list_operations = res.data.data.operations;
                list_devises = res.data.data.devises;
                list_total = res.data.data.total;
                list_transactions = res.data.data.transactions;


                document.getElementById("sicursale_").innerHTML = setListeCombo(list_succursale);
                document.getElementById("sicursale").innerHTML = "<option value=''>Select succursale/Agence</option>" + setListeCombo(list_succursale);
                document.getElementById("debit_list").innerHTML = setListe(list_comptes);
                document.getElementById("credit_list").innerHTML = setListe(list_comptes);
                document.getElementById("beneficiaire_list").innerHTML = setListe(list_beneficiare);
                document.getElementById("devise").innerHTML = setListeCombo(list_devises);
                document.getElementById("devise_solde").innerHTML = setListeCombo(list_devises);
                document.getElementById("devise_billet").innerHTML = "<option value=''>Select Devise</option>" + setListeComboX(list_devises);

                loadTot();
                listOperations(null);
                listTransactions();

            }).catch((error) => {
                $("#infos").html(setErreur(true, error.message));
            });

    }

    function listTransactions() {

        var tab = document.getElementById("tabx");
        tab.innerHTML = "";
        list_transactions.forEach(element => {

            tab.innerHTML += ` <a class="dropdown-item" href="#" 
            data-toggle="modal" data-target=".create-operation"
            onclick='choixop("${element.id}")';'
            >${element.designation} <span style="color:red;">(${element.type_})</span></a>`;

        });
    }

    function loadTot() {
        var tot = document.getElementById("tot_");
        tot.innerHTML = "";
        list_total.forEach(element => {
            var sty = "primary";
            switch (element.type) {
                case 'SORTIE':
                    sty = "danger";
                    break;
                case 'ENTREE':
                    sty = "success";
                    break;
                case 'DEPOT':
                    sty = "primary";
                    break;
                case 'RETRAIT':
                    sty = "success";
                    break;
                case 'CREDIT':
                    sty = "warning";
                    break;

                default:
                    break;
            }
            tot.innerHTML += `
            <button type="button" class="btn mb-1 btn-outline-${sty} col-md-12" >
                   (${element.nombre})  ${element.type} 
                <span class="badge badge-${sty} ml-2">${element.montant}</span>
                <span class="badge badge-primary ml-2">${element.devise}</span>
            </button> `;
        });
    }

    function listOperations(sicursale) {
        listeop.innerHTML = "";

        list_operations.forEach(element => {

            if (sicursale == null || sicursale == '' || sicursale == "all") {
                listeop.innerHTML += getElement(element);
            } else {
                if (sicursale == element.id_succursale) {
                    listeop.innerHTML += getElement(element);
                }
            }

        });

    }

    function getElement(element) {


        var sty = "primary";
        switch (element.type) {
            case 'SORTIE':
                sty = "danger";
                break;
            case 'ENTREE':
                sty = "success";
                break;
            case 'DEPOT':
                sty = "primary";
                break;
            case 'RETRAIT':
                sty = "success";
                break;
            case 'CREDIT':
                sty = "warning";
                break;
            case 'PENALITE':
                sty = "danger";
                break;

            default:
                break;
        }
        var etat = 'danger';
        if (element.etat == 1) {
            etat = 'success';
        }

        var checked = (element.etat == 1) ? 'checked' : '';
        var checkedText = (element.etat == 1) ? 'Validée' : 'Non validée';

        return `<tr> 
                 <td>${element.numero}</td>
                 <td><span class="badge badge-${sty}">${element.type}</span></td>
                 <td>${element.montant} ${element.devise}</td> 
                 <td>${element.motif}</span>
                 <td>${element.benefiaire}</span>
                 <td>${element.date_save.substring(0, 10)} à ${element.heur}</span>
                 </td>
                 <td>
                    <div class="flex align-items-center list-user-action">
                        <a class="iq-bg-primary"  href="#" data-toggle="modal" data-target=".show_operation" onclick="show_operation('${element.id}');">
                        <i class="fa  fa-print"></i>
                    </a> 
                       <div class="custom-control custom-checkbox custom-checkbox-color custom-control-inline">
                              <input type="checkbox" class="custom-control-input bg-${etat}" id="customCheck${element.id}" ${checked}>
                              <label class="custom-control-label" for="customCheck${element.id}">${checkedText}</label>
                        </div> 
                    </div>
                 </td>
          
              </tr>`;
    }

    function setListe(liste = []) {
        var liste_element = "";
        liste.forEach(element => {
            liste_element += `<option value="${element.designation}">${element.id}</option>`;
        });
        return liste_element;
    }

    function setListeBen(liste = []) {
        var liste_element = "";
        liste.forEach(element => {
            liste_element += `<option value="${element.fullname}">${element.id}</option>`;
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
    function setListeComboX(liste = []) {
        var liste_element = "";
        liste.forEach(element => {
            liste_element += `<option value="${element.designation}">${element.designation}</option>`;
        });
        return liste_element;
    }

    $("#valbtn").click(function () {
        if (confirm("Êtes-vous sûr de vouloir valider cette opération?")) {
            var id = document.getElementById("id_operation_").value;

            HttpPost("/operation-validate", {
                id
            }).then((res) => {
                var json = res.data;

                if (json.status == 200) {
                    $("#txy").html(setErreur(false, json.message));
                    load();
                } else {
                    $("#txy").html(setErreur(true, json.message));
                }
            }).catch(error => function (error) {
                console.log(error);
            });
        }
    });

    $("#delbtn").click(function () {
        var id = document.getElementById("id_operation_").value;

        if (confirm("Êtes-vous sûr de vouloir supprimer cette opération?")) {
            HttpPost("/operation-del", {
                id
            }).then((res) => {
                var json = res.data;

                if (json.status == 200) {
                    $("#txy").html(setErreur(false, json.message));
                    load();
                } else {
                    $("#txy").html(setErreur(true, json.message));
                }
            }).catch(error => function (error) {
                console.log(error);
            });
        }

    });



    $("#sicursale").change(() => {
        var sicursale = $("#sicursale").val();
        listOperations(sicursale);
    })

    $("#actualiser").click(() => {
        load();
    })

    $("#benef").change(() => {
        if ($("#type").val() === "CREDIT") {
            $("#debit_").val($('#benef').val());
        }
    });

    $("#debit_").change(() => {
        if ($("#type").val() === "RETRAIT") {
            load_mandateurs($("#debit_").val());
        }
        $('#benef').val($("#debit_").val());
    });

    $("#credit_").change(() => {
        if ($("#type").val() === "RETRAIT") {
            load_mandateurs($("#credit_").val());
        }
        $('#benef').val($("#credit_").val());
    });

    var list_membres = [];
    function load_mandateurs(id_compte) {

        document.getElementById("beneficiaire_list").innerHTML = "";

        HttpPost("/comptabilite/mandateur/load", {
            id_compte
        }).then(function (response) {
            var json = response.data;
            list_membres = json.data;
            console.log(list_membres);
            document.getElementById("beneficiaire_list").innerHTML = setListeBen(list_membres);
        });

    }

});