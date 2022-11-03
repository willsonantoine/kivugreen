<div id="add_zone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_grouppe" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_zone">Ajouter ou modifier une zone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="id_zone" value="00">

                    <div class="form-group col-md-4">
                        <label for="groupe_name">Zones Parent</label>
                        <select class="form-control mb-0 setcolor" id="id_parent">
                            <option value="">Principale</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="groupe_name">Nom de la zone</label>
                        <input type="text" class="form-control mb-0 setcolor" id="zone_name" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="groupe_description">Description de la zone</label>
                        <input type="text" id="zone_description" class="form-control setcolor">
                    </div>


                    <div class=" form-group col-md-12">
                        <div id="txyx"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save_zone">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>