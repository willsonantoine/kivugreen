<!-- Large modal -->
<div class="modal fade create-transactions" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuration des transactions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id" value="00">
                    <div class="form-group col-md-6">
                        <label for="credit_">Designation</label>
                        <input type="text" class="form-control mb-0 setcolor" id="designation_">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="credit_">Montant</label>
                        <input type="text" class="form-control mb-0 setcolor" id="montant_">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type_">TYPE</label>
                        <select class="form-control setcolor" id="type_">
                            <option value="">Select type</option>
                            <option value="ENTREE">ENTREE</option>
                            <option value="SORTIE">SORTIE</option>
                            <option value="DEPOT">DEPOT</option>
                            <option value="RETRAIT">RETRAIT</option>
                            <option value="VIREMENT">VIREMENT</option>
                            <option value="CREDIT">CREDIT</option>
                            <option value="PAYEMENT">PAYEMENT</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="credit_">Crédit</label>
                        <input list="credit_list" id="credit_" name="" placeholder="Compte à créditer" class="form-control mb-0 setcolor">
                        <datalist id="credit_list">

                        </datalist>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="debit">Débit</label>
                        <input list="debit_list" id="debit_" name="" placeholder="Compte à débiter " class="form-control mb-0 setcolor">
                        <datalist id="debit_list">

                        </datalist>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="description">Motif par default de l'opération </label>
                        <input type="text" id="motif" class="form-control mb-0 setcolor">
                    </div>
                    <div class="form-group col-md-12"><button type="button" class="btn btn-primary" id="save_transactions">Save changes</button></div>
                    <div class="form-group col-md-12" id='infosx'>
                    </div>
                </div>
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Designation</th>
                            <th>Crédit</th>
                            <th>Débit</th>
                            <th>Montant</th>
                            <th>Designation</th>
                        </tr>
                    </thead>
                    <tbody id="tab_transactions">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>