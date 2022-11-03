<!-- Large modal -->
<div class="modal fade create-compte" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter ou modifier un compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="numero">Classe</label>
                        <select id="classe" class="form-control setcolor" name="classe" id="classe">
                            <option value="1">Comptes de ressources durables</option>
                            <option value="2">Comptes de l’actif immobilisé</option>
                            <option value="3">Comptes de Epargne/stocks</option>
                            <option value="4">Comptes de tiers</option>
                            <option value="5">Comptes de trésorerie</option>
                            <option value="6">Comptes de charges</option>
                            <option value="7">Comptes de produits</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="numero">N° de compte</label>
                        <input type="number" class="form-control mb-0 setcolor" id="numero" name="numero" placeholder="Numéro">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="compte">Nom du compte</label>
                        <input type="text" class="form-control mb-0 setcolor" id="designation" name="compte" placeholder="Designation du compte" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Description</label>
                        <textarea class="form-control setcolor" id="description" placeholder="Designation du compte"></textarea>
                    </div>
                    <input type="hidden" id="id_ref" value="00">
                    <div class="form-group col-md-12" id='infos'>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteCompte()">Supprimer</button>
                <button type="button" class="btn btn-primary" id="save_compte">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    function deleteCompte() {

        if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
            var id = $("#id_ref").val();
            HttpPost("/comptabilite/compte/delete", {
                id
            }).then((res) => {
                var json = res.data;
                document.getElementById("infos").innerHTML = setErreur((json.status != 200), json.message);
                if (json.status == 200) {
                    location.reload();
                }
            });
        }

    }
</script>