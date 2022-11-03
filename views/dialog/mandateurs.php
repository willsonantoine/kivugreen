<!-- Large modal -->
<div class="modal fade mandateurs" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mandateurs et héritier du compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h3 class="col-md-12" id="infos_compte"></h3>
                    <span class="col-md-12">Vous avez ici la liste des personnes qui ont accès à ce compte ou qui peuvent en hériter en cas de décès du propriétaire du compte. </span>
                    <hr>
                    <input type="hidden" id="id_mandateur" value="00">
                    <input type="hidden" id="id_compte_mandateur" value="00">
                    <div class="form-group col-md-8 setcolor">
                        <label for="membre_">Membre ou personne de réferance</label>
                        <input list="list_membre" id="membre_" name="" placeholder="Nom ou numéro" class="form-control mb-0 setcolor">
                        <datalist id="list_membre">

                        </datalist>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="type_membre">TYPE</label>
                        <select class="form-control setcolor" id="type_membre">
                            <option value="">Select type</option>
                            <option value="Mandateur">Mandateur</option>
                            <option value="Héritier">Héritier</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">Observation</label>
                        <input type="text" id="motif_mantateur" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-12"><button type="button" class="btn btn-primary" id="save_mandateur">Enregistrer</button></div>
                    <div class="form-group col-md-12" id='infos_mandateur'>
                    </div>
                </div>
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th></th>
                            <th>Nom</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Observation</th>
                            <th></th>  
                        </tr>
                    </thead>
                    <tbody id="tab_membres_mandateurs">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>