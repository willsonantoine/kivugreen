<div id="add_grouppe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_grouppe" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_grouppe">Ajouter ou modifier un groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id_parent">
                    <input type="hidden" id="id" value="00">

                    <div class="form-group col-md-3">
                        <label for="groupe_name">Parents</label>
                        <select class="form-control mb-0 setcolor" id="groupe_parent">

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="groupe_name">Labelle</label>
                        <input type="text" class="form-control mb-0 setcolor" id="groupe_name" placeholder="">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="groupe_description">Designation du groupe</label>
                        <input type="text" id="groupe_description" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="groupe_description" style="color:white ;">Designation</label>
                        <button type="button" onclick="sendGroupe()" class="btn btn-primary">Enrégistrer</button>
                    </div>

                    <div class=" form-group col-md-12">
                        <div id="txyx"></div>
                    </div>
                    <div class="col-md-12">
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>N°</th> 
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tab_groupe">

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