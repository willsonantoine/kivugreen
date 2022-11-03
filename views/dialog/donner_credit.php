<!-- Large modal -->
<div class="modal fade donner-credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Octroyer un crédit Microfinance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Veuillez définir ici les comptes qui seront affectés par le mouvement : Le compte à créditer puis le compte à débiter</span>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="date_exp2">Début</label>
                        <input type="date" value="2022-08-01" class="form-control mb-0 setcolor" id="date_debut">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="credit_2">Crédit</label>
                        <input list="credit_list2" id="credit_2" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="credit_list2">

                        </datalist>
                         
                    </div>
                    <div class="form-group col-md-4">
                        <label for="debit2">Débit</label>
                        <input list="debit_list2" id="debit_2" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="debit_list2">

                        </datalist>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="entrep">Sicursale/Boutique</label>
                        <select class="form-control mb-0 setcolor" id="sicursale2"></select>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="produit_2">Montant</label>
                        <input type="number" class="form-control mb-0 setcolor" value="0" id="montant2" name="montant" onkeyup="setCalculPourcent();">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="devise">Devise</label>
                        <select class="form-control mb-0 setcolor" id="devise">
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="produit_2">Echéance en Mois</label>
                        <input type="number" class="form-control mb-0 setcolor" value="0" id="mois2" name="mois2" onkeyup="setCalculPourcent();" onchange="setNextDate();">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="produit_2">Taux %</label>
                        <input type="number" class="form-control mb-0 setcolor" value="0" id="taux2" name="taux2" onkeyup="setCalculPourcent();">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="produit_2">Intéret <a href="#" class="badge badge-danger" onclick="setInteret();" style="font-weight:bold;">Ajouter</a></label>
                        <input type="number" class="form-control mb-0 setcolor" value="0" id="montant_interet">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="produit_2">Montant Net</label>
                        <input type="number" class="form-control mb-0 setcolor" value="0" id="montant_net2" name="montant_net2">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="montant_toute_lettre2">Montant en toute lettres</label>
                        <input type="text" class="form-control mb-0 setcolor" value="" id="montant_toute_lettre2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="motif">Motif de l'emprunt</label> 
                        <input list="motif_list" id="motif" name="" placeholder="Select Motif" class="form-control mb-0 setcolor">
                        <datalist id="motif_list">

                        </datalist>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="date_exp2">Fin écheance</label>
                        <input type="date" value="2022-08-01" class="form-control mb-0 setcolor" id="date_fin">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="motif">Object en gage ou garentis</label>
                                <input type="text" class="form-control mb-0 setcolor" id="object_en_gage">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_exp2">Date de l'operation</label>
                                <input type="date" value="2022-08-01" class="form-control mb-0 setcolor" id="date_2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="date_exp2">Observation de l'opération</label>
                                <textarea class="form-control mb-0 setcolor" id="motif2" placeholder="Motif de l'opération"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h4>Liste des frais suplementaire</h4><br>
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label for="credit_2">Transactions</label>
                                    <input list="credit_list3" id="transctions_" placeholder="Select" class="form-control mb-0 setcolor">
                                    <datalist id="credit_list3">

                                    </datalist>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="credit_2">Montant</label>
                                    <input type="number" id="transctions__montant" placeholder="0" class="form-control mb-0 setcolor">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bt">-</label>
                                    <input type="button" id="bt" value="Ajouter" onclick="addPanierCredit();" class="btn btn-primary mb-0">
                                </div>
                            </div>
                            <a id="error_tab" style="color:red;"></a>
                            <table id="user-list-table" class="table table-striped table-bordered mt-1" role="grid" aria-describedby="user-list-page-info">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Designation</th>
                                        <th>Montant</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="liste_transactions">

                                </tbody>
                            </table>
                            <h4>Total : <a id="tot">0</a></h4>
                        </div>
                    </div>
                </div>

                <div id="infos"></div>

                <!-- END -->
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save_credit">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>
<script>
    var texte_transactions = "";

    function ecrire_observation() {
        var taux = $("#montant_interet").val();
        var text = "Prêt accordé au dossier numéro :[] du " + $("#date_debut").val() + " Au " + $("#date_fin").val() + "; Taux d'interet : " +
            $("#taux2").val() + " % " + ";  " + texte_transactions;;


        $("#motif2").val(text);
    }

    

    function setInteret() {
        var montant_interet = $('#montant_interet').val();
        $("#transctions__montant").val(montant_interet);
    }

    var transactions_compte_ = [];
    var transactions_montant = [];

    function addPanierCredit() {
        $("#error_tab").html("")

        var compte = $('#transctions_').val();
        var montant = $('#transctions__montant').val();
        if (compte.length > 0 && montant > 0) {
            if (!transactions_compte_.includes(compte)) {

                transactions_compte_.push(compte);
                transactions_montant.push(montant);
                $("#transctions_").val("")
                $("#transctions__montant").val("0")
                loadTransactions_();
            } else {
                $("#error_tab").html("Vous pouvez pas ajouter deux fois cet comptes")
            }
        } else {
            $("#error_tab").html("Vous devez sélectionner un compte ou vérifier votre la valeur svp")
        }

    }

    function loadTransactions_() {
        var dev = $('#devise').find(":selected").text();
        var tot = document.getElementById("tot");
        var tab = document.getElementById("liste_transactions");
        tab.innerHTML = "<br>";
        var i = 0;
        var sommes = 0;
        texte_transactions = "";
        for (let index = 0; index < transactions_compte_.length; index++) {
            const compte = transactions_compte_[index];
            const montant = transactions_montant[index];
            texte_transactions += "("+(i + 1) + ") " + compte + "=" + montant + " "+dev;+";<br>";
            tab.innerHTML += `
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${compte}</td>
                                        <td>${montant} ${dev}</td>
                                        <td><a class="badge badge-danger" href="#" onclick='deleteVl("${compte}","${montant}");'>X</a></td>
                                    </tr>`;
            i++;
            sommes += parseFloat(montant);
        }

        $("#tot").html(sommes);
        setCalculPourcent();

    }

    function deleteVl(params, montant) {

        splice(transactions_compte_, params);
        splice(transactions_montant, montant);

        loadTransactions_();
    }

    function splice(arr, val) {
        for (var i = arr.length; i--;) {
            if (arr[i] === val) {
                arr.splice(i, 1);
            }
        }
    }
</script>