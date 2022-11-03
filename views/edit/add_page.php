<div id="add_page" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_grouppe" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_grouppe">Parametres des pages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="page_id" value="00">
                    <div class="form-group col-md-4">
                        <label for="page_name">Nom de la page</label>
                        <input type="text" class="form-control mb-0 setcolor" id="page_name" placeholder="">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="page_title">Title (Titre)</label>
                        <input type="text" class="form-control mb-0 setcolor" id="page_title" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="page_description">Description de la page</label>
                        <textarea id="page_description" class="form-control setcolor"></textarea>
                    </div>

                    <div class=" form-group col-md-12">
                        <div id="txyx" class="col-md-8">

                        </div>
                        <div class="col-md-4">
                            <button type="button" onclick="save_page()" class="btn btn-primary">Enrégistrer</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-page">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>
<script>
    function save_page() {

        var id = $("#page_id").val();
        var nom = $("#page_name").val();
        var title = $("#page_title").val();
        var description = $("#page_description").val();


        HttpPost('/web-manage/create/page', {
            id,
            nom,
            title,
            description
        }).then(function(response) {
            var json = response.data;
            document.getElementById("txyx").innerHTML = setErreur((json.status != 200), json.message);
            if (json.status == 200) {
                load();
            }
        });
    }

    function delete_page(id) {

        if (confirm('Ete vous sur de vouloir supprimer cette page ?')) {
            HttpPost('/web-manage/delete/page', {
                id
            }).then(function(response) {
                var json = response.data;
                if (json.status == 200) {
                    load();
                }
            });
        }

    }
</script>