<!-- Large modal -->
<div class="modal fade update_credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_x_modif"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id_credit_mod">
                    <div class="form-group col-md-3">
                        <label>Montant octroyé</label>
                        <input type="number" id="montant_reste_donner" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Devise</label>
                        <input type="text" id="devise_reste_payer" disabled class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Reste à payer</label>
                        <input type="number" id="montant_reste_payer" class="form-control setcolor">
                    </div>

                    <div class="form-group col-md-5">
                        <label>Motif</label>
                        <input type="text" id="motif_credit_motif" class="form-control setcolor">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Début écheance</label>
                        <input type="date" id="datedebut" class="form-control setcolor">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Fin écheance</label>
                        <input type="date" id="datefin" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Montant Intéret</label>
                        <input type="number" id="montant_interet_donner" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Montant en toute lettre</label>
                        <input type="text" id="montant_en_toute_lettre_modif" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Motif de modification du crédit</label>
                        <textarea id="motif_modification" class="form-control setcolor"></textarea>
                        <a style="color:red; ;" id="last_update"></a>
                    </div>

                </div>

                <div id="txy_x"></div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="radier();" class="btn btn-danger">Classé pour les prêts radiés</button>
                <button type="button" onclick="save();" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function radier() {
        var id = $("#id_credit_mod").val();
        if (confirm("Êtes-vous sûr de vouloir radier ce crédit ?")) {
            HttpPost("/operation/credit/radier", {
                id
            }).then((response) => {
                var json = response.data;
                document.getElementById("txy_x").innerHTML = setErreur((json.status != 200), json.message);
                if (json.status == 200) {
                    location.reload();
                }
            });
        }

    }

    function save() {
        var id = $("#id_credit_mod").val();
        var reste = $("#montant_reste_payer").val();
        var devise = $("#devise_reste_payer").val();
        var motif = $("#motif_modification").val();
        var datefin = $("#datefin").val();
        var datedebut = $("#datedebut").val();
        var montant = $("#montant_reste_donner").val();
        var motif_credit = $("#motif_credit_motif").val();
        var interet = $("#montant_interet_donner").val();
        var montant_en_toute_lettre = $("#montant_en_toute_lettre_modif").val();

        HttpPost("/operation/credit/update", {
            id,
            reste,
            devise,
            motif,
            datefin,
            datedebut,
            montant,
            motif_credit,
            interet,
            montant_en_toute_lettre
        }).then((response) => {
            var json = response.data;
            document.getElementById("txy_x").innerHTML = setErreur((json.status != 200), json.message);
            if (json.status == 200) {
                location.reload();
            }
        });
    }
</script>