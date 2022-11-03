$(document).ready(function () {

    $("#save_credit").click(function () {

        var montant2_demande = $("#montant2").val();
        var debit = $("#debit_2").val();
        var credit = $("#credit_2").val();
        var type = 'CREDIT';
        var montant = $("#montant_net2").val();
        var devise = $("#devise").val();
        var montant_toute_lettre = $("#montant_toute_lettre2").val();
        var beneficiaire = $("#credit_2").val();
        var id_succursale = $("#sicursale2").val();
        var motif = $("#motif2").val();
        var date = $("#date_2").val();
        var date_debut = $("#date_debut").val();
        var favo = "00";
        var id_transaction = null;


        if (credit.length > 0 && debit.length > 0 && montant.length > 0 && montant_toute_lettre.length > 0 && beneficiaire.length > 0 && motif.length > 0) {
            if (confirm("Êtes-vous sûr de vouloir accorder ce crédit ? ")) {
                HttpPost("/operations/create", {
                    credit, debit, type, montant: montant2_demande, devise, montant_toute_lettre, date, beneficiaire, id_succursale, motif, favo, id_transaction
                }).then((res) => {
                    var data = res.data;
                    if (data.status == 200) {
                        id = data.data.id;
                        $("#infos").html(setErreur(false, data.message));

                        for (let index = 0; index < transactions_compte_.length; index++) {

                            var compte_to_ = transactions_compte_[index];
                            var montant = transactions_montant[index];

                            sendOperation(credit, compte_to_, "PAYEMENT", montant, devise, "-", date, beneficiaire, id_succursale, "Payement " + compte_to_);
                        }

                        saveDetailles(id);
                        load();

                    } else {
                        $("#infos").html(setErreur(true, data.message));
                    }
                }).catch((error) => {
                    $("#infos").html(setErreur(true, error.message));

                });
            }

        } else {
            $("#infos").html(setErreur(true, "Aucune case ne doit etre vide !."));
        }
    });

    function sendOperation(debit, credit, type, montant, devise, montant_toute_lettre, date, beneficiaire, id_succursale, motif) {

        HttpPost("/operations/create", {
            debit, credit, type, montant, devise, montant_toute_lettre, date, beneficiaire, id_succursale, motif
        }).then((res) => {
            console.log(res.data.status, "//", res.data.message);
        }).catch((error) => {
            console.log(error);
        });

    }
    function saveDetailles(id) {

        var taux = $("#taux2").val();
        var mois = $("#mois2").val();
        var date_debut = $("#date_debut").val();
        var date_fin = $("#date_fin").val();
        var observation = $("#motif2").val();
        var objectif = $("#motif").val();
        var garentis = $("#object_en_gage").val();
        var montant_demande = $("#montant2").val();
        var montant_interet = $("#montant_interet").val();
        var montant_interet = $("#montant_interet").val();
        var montant_toute_lettre = $("#montant_toute_lettre2").val();

        HttpPost("/operations/saveDetailles-credit", {
            id, taux, mois, date_debut, date_fin, observation, objectif, garentis, montant_demande, montant_interet, montant_toute_lettre
        }).then((res) => {
            if (res.data.status == 200) {
                window.location.reload();
            }
        }).catch((error) => {
            console.log(error);
        });

    }

    var list_beneficiaire = [];
    var list_penalites = [];
    var list_operations = [];
    var list_comptes = [];
    var list_succursale = [];
    var list_all_comptes = [];
    var list_transactions = [];
    var total_transactions = 0;
    var list_count_transactions = [];
    var list_devises = [];

    var listeop = document.getElementById('listeop');

    load();


    function load() {

        HttpPost("/operations/loads-credit",
            {

            }).then((res) => {

                list_beneficiaire = res.data.data.beneficiaire;
                list_penalites = res.data.data.penalites;
                list_comptes = res.data.data.comptes;
                list_all_comptes = res.data.data.all_comptes;
                list_succursale = res.data.data.succursale;
                list_transactions = res.data.data.transactions;
                list_devises = res.data.data.devises;
                list_filter = res.data.data.filter;
                list_motifs = res.data.data.motifs;

                document.getElementById("motif_list").innerHTML = setListe2(list_motifs, true);
                document.getElementById("sicursale2").innerHTML = setListeCombo(list_succursale);
                document.getElementById("sele-motif").innerHTML = setListeCombo(list_motifs);
                document.getElementById("debit_list2").innerHTML = setListe(list_all_comptes);
                document.getElementById("credit_list2").innerHTML = setListe(list_all_comptes);
                document.getElementById("list_destination_compte").innerHTML = setListe(list_all_comptes);
                document.getElementById("list_compte_to").innerHTML = setListe(list_all_comptes);
                document.getElementById("credit_list3").innerHTML = setListe(list_all_comptes);
                document.getElementById("devise").innerHTML = "<option value=''>Select Devise</option>" + setListeCombo(list_devises);

                document.getElementById("annee").innerHTML = setListeCombo_annes(list_filter);

            }).catch((error) => {
                console.log(error.message);
            });

    }

    function setListe(liste = []) {
        var liste_element = "";

        liste.forEach(element => {

            liste_element += `<option value="${element.designation}">${element.id}</option>`;


        });

        return liste_element;
    }
    function setListe2(liste = []) {
        var liste_element = "";

        liste.forEach(element => {

            liste_element += `<option value="${element.id}">${element.designation}</option>`;


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






    function setListe(liste = []) {

        var liste_element = "";
        liste.forEach(element => {
            liste_element += `<option value="${element.designation}">${element.id}</option>`;
        });

        return liste_element;
    }



});