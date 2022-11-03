<div id="add_integration" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_grouppe" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_grouppe">Intégration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h5>Page source</h5>
                    <h4><code>/page/containt/{page}</code></h4>


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