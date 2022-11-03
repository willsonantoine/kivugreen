<div id="add_marche" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_grouppe" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_grouppe">Ajouter ou modifier un Marché</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id_marche" value="00">

                    <div class="form-group col-md-6">
                        <label for="marche_name">Nom du marché</label>
                        <input type="text" id="marche_nom" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="groupe_name">Zone de localisation</label>
                        <input type="text" id="marche_marche" class="form-control setcolor" disabled>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="marche_amabassadeur">Ambassadeur ou supérvisseur</label>
                        <input list="zone_list" id="marche_amabassadeur" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="zone_list">

                        </datalist>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="groupe_name">Jours du marché</label>
                        <input type="text" id="marche_jour" class="form-control setcolor">
                    </div>

                    <div class=" form-group col-md-12">
                        <div id="infos_marche"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save_marche">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>