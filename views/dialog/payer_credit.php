<!-- Large modal -->
<div class="modal fade payer_credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payer le crédit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="destination_compte">Compte à créditer</label>
                        <input list="list_destination_compte" id="compte_credit" placeholder="Select compte" class="form-control mb-0 setcolor">
                        <datalist id="list_destination_compte">

                        </datalist>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="destination_compte">Compte à débuter</label>
                        <input type="text" id="compte_debit" disabled class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="montant_payer">Montant</label>
                        <input type="number" id="montant_payer" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="devise_payer">Devise</label>
                        <input type="text" id="devise_payer" class="form-control mb-0 setcolor" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date_payement">Date de l'opération</label>
                        <input type="date" id="date_payement" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="date_payement">Montant en toute lettre</label>
                        <input type="text" id="montant_toute_lettre_payer" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="date_payement">Motif de l'opération</label>
                        <textarea id="motif_payer" class="form-control mb-0 setcolor"></textarea>
                    </div>
                    <hr>
                    <br>
                    <span class="col-md-12" style="color:red;">Si ce crédit a déjà fait l'objet de provisions, veuillez effectuer une opération de recouvrement.
                        <a href="#" class="badge badge-primary" onclick="show_add();">Attacher un opération</a></span>
                    <div class="col-md-12">
                        <div class="row" id="containt_show">
                            <div class="form-group col-md-5">
                                <label for="destination_compte">Compte à créditer</label>
                                <input list="list_destination_compte" id="compte_credit2" placeholder="Select compte" class="form-control mb-0 setcolor">
                                <datalist id="list_destination_compte">

                                </datalist>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="destination_compte">Compte à débuter</label>
                                <input list="list_destination_compte" id="compte_debuter2" placeholder="Select compte" class="form-control mb-0 setcolor">
                                <datalist id="list_destination_compte">

                                </datalist>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="montant_payer">Montant</label>
                                <input type="number" id="montant_payer2" class="form-control mb-0 setcolor">
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <input type="hidden" id="id_credit_payer" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="hidden" id="devise_id_payer">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="hidden" id="reste_montant_payer">
                    </div>
                    <div class="form-group col-md-12">
                        <div id="txypayer"></div>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="payer();">Payer</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#containt_show").hide();

    function show_add() {
        $("#containt_show").show();
    }


    function payer() {

        var credit = document.getElementById('compte_credit').value;
        var debit = $("#compte_debit").val();
        var montant = document.getElementById('montant_payer').value;
        var devise = document.getElementById('devise_id_payer').value;
        var date = document.getElementById('date_payement').value;
        var type = "PAYEMENT";

        var montant_toute_lettre = $("#montant_toute_lettre_payer").val();
        var id_succursale = "1";
        var ref = document.getElementById("id_credit_payer").value;
        var motif = document.getElementById("motif_payer").value;
        var beneficiaire = debit;
        var reste = $("#reste_montant_payer").val();
        motif = motif + "; Reste : " + parseFloat(reste - parseFloat(montant)) + " " + $("#devise_payer").val();;

        var montant2 = document.getElementById('montant_payer2').value;

        if (confirm("Êtes-vous sûr de vouloir effectuer ce paiement  ?")) {

            HttpPost("/operations/create", {
                debit,
                credit,
                type,
                montant,
                devise,
                montant_toute_lettre,
                date,
                beneficiaire,
                id_succursale,
                motif,
                favo: ref
            }).then((res) => {
                var data = res.data;
                if (data.status == 200) {
                    id = data.data.id;
                    document.getElementById("txypayer").innerHTML = setErreur(false, data.message);
                    if (montant2.legth <= 0 || montant2 == "") {
                        location.reload();
                    }
                } else {
                    document.getElementById("txypayer").innerHTML = setErreur(true, data.message);
                }
            }).catch((error) => {
                document.getElementById("txypayer").innerHTML = setErreur(true, error.message);

            });

            if (montant2 > 0) {
                console.log(montant2);
                credit = document.getElementById('compte_credit2').value;
                debit = $("#compte_debuter2").val();
                motif = "Régulation des frais de todation au provision";
                montant_toute_lettre = "--";
                HttpPost("/operations/create", {
                    debit,
                    credit,
                    type,
                    montant: montant2,
                    devise,
                    montant_toute_lettre,
                    date,
                    beneficiaire,
                    id_succursale,
                    motif,
                    favo: ref
                }).then((res) => {
                    var data = res.data;
                    if (data.status == 200) {
                        id = data.data.id;
                        document.getElementById("txypayer").innerHTML = setErreur(false, data.message);
                        location.reload();
                    } else {
                        document.getElementById("txypayer").innerHTML = setErreur(true, data.message);
                    }
                }).catch((error) => {
                    document.getElementById("txypayer").innerHTML = setErreur(true, error.message);

                });
            }
        }

    }
</script>