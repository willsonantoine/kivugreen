<!-- Large modal -->
<div class="modal fade show_operation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_x"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="print" style="border-color:black;">

                    <div>
                        <h4 style="line-height:20px"><strong>COOPECCO KIRUMBA</strong> </h4>
                        <h5 style="line-height:20px">N° AG GOUV/D143/N°000363/2008</h5>
                        <h6 style="line-height:20px">Adresse : KIRUMBA Q. KAYALUNGERO; BP 18 KAYNA</h6>
                        <h4 id="type_numero"></h4>
                        <input type="hidden" id="id_operation_">
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="line-height:20px" id="beneficiaire_"></h5>
                            <h5 style="line-height:20px" id="numero_compte"></h5>
                            <h5 id="motif_operation"></h5>
                            <h5 id="toute_lettre"></h5>
                            <h5 style="line-height:20px" id="beneficiaire_personne"></h5>
                            <h5 style="line-height:20px" id="date_operation"></h5>
                            <div id="billetage_"></div>

                            <hr>
                            <div class="col-md-12" style="background-color: #e1e4e8;">
                                <table>
                                    <tr>
                                        <th style="text-align: left;width: 400px;"><a>Sé/Membre <span id="membre_nom"></span></a></th>
                                        <th style="text-align: right;width: 400px;"><a> <span id="user_nom"></span></a></th>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

                <div id="txy"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" onclick="del();" id="delbtn" class="btn btn-danger">Annuller</button>
                <button type="button" onclick="val();" id="valbtn" class="btn btn-success">Valider</button>
                <button type="button" onclick="printDivContent();" id="printBtn" class="btn btn-primary">Imprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function val() {
        var id = document.getElementById("id_operation_").value;
        console.log(id);
        HttpPost("/operation-validate", {
            id
        }).then((res) => {
            var json = res.data;
            console.log(json);
            if (json.status == 200) {
                $("#txy").html(setErreur(false, json.message));
                window.location.reload();
            } else {
                $("#txy").html(setErreur(true, json.message));
            }
        }).catch(error => function(error) {
            console.log(error);
        });

    }

    function del() {
        var id = document.getElementById("id_operation_").value;
        console.log(id);
        if (confirm("Êtes-vous sûr de vouloir supprimer cette opération?")) {
            HttpPost("/operation-del", {
                id
            }).then((res) => {
                var json = res.data;
                console.log(json);
                if (json.status == 200) {
                    $("#txy").html(setErreur(false, json.message));
                    window.location.reload();
                } else {
                    $("#txy").html(setErreur(true, json.message));
                }
            }).catch(error => function(error) {
                console.log(error);
            });
        }


    }
</script>