<div id="add_unite" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategorie" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategorie">Unité de mésure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="form-group col-md-10">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control mb-0 setcolor" id="designation_unite">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="designation">Valeur en <strong>KG</strong></label>
                        <input type="number" class="form-control mb-0 setcolor" id="valeur_kg" placeholder="1 Kg">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="produit_">Description</label>
                        <textarea id="description_unite" class="form-control setcolor"></textarea>
                    </div>

                    <div class=" form-group col-md-12">
                        <div id="infoss"></div>
                        <button type="button" onclick="sendUnite()" class="btn btn-primary">Enrégistrer</button>
                    </div>
                    <input type="hidden" id="id_unite" value="00">
                </div>
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Designation</th>
                            <th>Valeur en KG</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tab_unite">

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
    var all_unite = [];

    function delete_unite(id) {
        HttpPost("/produit/unite/delete", {
            id
        }).then((resp) => {
            var json = resp.data;
            all_unite = json.data;
            loadUnite();
            alert(json.message);


        });
    }

    function sendUnite(id) {

        HttpPost("/produit/unite/create", {
            id: $("#id_unite").val(),
            designation: $("#designation_unite").val(),
            description: $("#description_unite").val(),
            valeur_kg: $("#valeur_kg").val()
        }).then((resp) => {
            var json = resp.data;
            all_unite = json.data;
            alert(json.message);
            loadUnite();
            if (json.status == 200) {
                $("#designation_unite").val('');
                $("#description_unite").val('');
                $("#valeur_kg").val('0');
                $("#id_unite").val('00');

            }

        });
    }

    function loadUnite() {

        var tab_categ = document.getElementById("tab_unite");
        tab_categ.innerHTML = "";
        var xx = 1;

        all_unite.forEach(element => {

            var designation = element.designation;
            var description = element.description;
            var valeur_kg = element.valeur_kg;
            var id = element.id;

            tab_categ.innerHTML += ` <tr>
                              <td>${xx}</td>
                              <td>${designation}</td>
                              <td>${valeur_kg}</td>
                              <td>${description}</td>
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    <a class="iq-bg-primary" data-placement="top" title="" data-original-title="Modifier" href="#" onclick="selectUnite('${element.id}');">
                                       <i class="ri-pencil-line"></i>
                                    </a>
                                    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette unité ?')){delete_unite('${element.id}')} "><i class="ri-delete-bin-line"></i></a>
                                 </div>
                              </td>
                           </tr>`;
            xx++;

        });
    }

    function selectUnite(parameters) {
        all_unite.forEach(element => {
            if (element.id == parameters) {

                $("#designation_unite").val(element.designation);
                $("#description_unite").val(element.description);
                $("#valeur_kg").val(element.valeur_kg);
                $("#id_unite").val(element.id);
            }
        });
    }
</script>