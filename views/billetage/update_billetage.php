<div class="modal fade billetage-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le nombre des billets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <input type="hidden" id="id_id" />
                    <div class="form-groupe col-md-4">
                        <label>Devise</label>
                        <input type="text" class="form-control setcolor" disabled id="id_devise">
                    </div>
                    <div class="form-groupe col-md-4">
                        <label>Valeur</label>
                        <input type="text" class="form-control setcolor" disabled id="id_valeur">
                    </div>
                    <div class="form-groupe col-md-4">
                        <label>Nombre</label>
                        <input type="text" class="form-control setcolor" id="id_nombre">
                    </div>

                </div>

                <div id="show-error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn-send-click" onclick="update_stosk();">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function update_stosk() {
        var id = document.getElementById("id_id").value;
        var nombre = document.getElementById("id_nombre").value;

        

        if (parseInt(nombre) >= 0) {

            HttpPost("/billetage/update", {
                id,
                nombre
            }).then((response) => {
                var json = response.data;
                document.getElementById("show-error").innerHTML = setErreur((json.status != 200), json.message);
                if (json.status == 200) {
                    list_stock = json.data.stock;
                    list_total = json.data.total;
                  
                    loadStock(null);
                    loadTot();
                }
            });
        } else {
            document.getElementById("show-error").innerHTML = setErreur(true, "le nombre ne peut etre inférieur à zéro");
        }
    }
</script>