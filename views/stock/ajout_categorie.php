<div id="addCategorie" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategorie" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategorie">Catégorie des produits</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="form-group col-md-12">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control mb-0 setcolor" id="designation_categ" name="designation" placeholder="Nom du categorie">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="produit_">Description</label>
                        <textarea id="description_categ" class="form-control setcolor"></textarea>
                    </div>

                    <div class=" form-group col-md-12">
                        <div id="txyx"></div>
                        <button type="button" onclick="sendCateg()" class="btn btn-primary">Enrégistrer</button>
                    </div>

                </div>
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Designation</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tab_categ">

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function delete_categorie(id) {
        HttpPost("/produit/categorie/delete", {
            id
        }).then((resp) => {
            var json = resp.data;
            all_categorie = json.data;
            alert(json.message);
            if (json.status == 200) {
                loadCateg();
            }

        });
    }

    var id_categ = "00";

    function sendCateg() {
        HttpPost("/produits-create-categ", {
            id: id_categ,
            designation: document.getElementById("designation_categ").value,
            description: document.getElementById("description_categ").value,
        }).then((res) => {
            var json = res.data.data;
            if (res.data.status == 200) {
                document.getElementById("designation_categ").value = "";
                document.getElementById("description_categ").value = "",
                    id_categ = "00";
                load();
                document.getElementById("txyx").innerHTML = setErreur(false, res.data.message);
            } else {
                document.getElementById("txyx").innerHTML = setErreur(true, res.data.message);
            }
        });
    }
</script>