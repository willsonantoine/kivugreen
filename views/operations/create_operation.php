<!-- Large modal -->
<div class="modal fade create-operation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opération</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Veuillez définir ici les comptes qui seront affectés par le mouvement : Le compte à créditer puis le compte à débiter</span>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="credit_">Crédit</label>
                        <input list="credit_list" id="credit_" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="credit_list">

                        </datalist>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="debit">Débit</label>
                        <input list="debit_list" id="debit_" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="debit_list">

                        </datalist>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="entrep">Sicursale/Boutique</label>
                        <select class="form-control mb-0 setcolor" id="sicursale_">

                        </select>
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col-md-6">
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="type">TYPE</label>
                                <input type="text" class="form-control mb-0 setcolor" id="type" name="type" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="montant">Montant</label>
                                <input type="number" class="form-control mb-0 setcolor" id="montant" name="montant">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="produit_">Devise</label>
                                <select class="form-control setcolor" id="devise">

                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="barcode">Montant en toute lettres</label>
                                <input type="text" class="form-control mb-0 setcolor" value="" id="montant_toute_lettre" name="barcode">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="beneficiaire">Bénéficiaire</label>
                                <input list="beneficiaire_list" id="benef" name="" class="form-control mb-0 setcolor">
                                <datalist id="beneficiaire_list">

                                </datalist>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date_exp">Date de l'operation</label>
                                <input type="date" value="2022-08-01" class="form-control mb-0 setcolor" id="date" name="date_exp">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="date_exp">Motif de l'opération</label>
                                <textarea class="form-control mb-0 setcolor" id="motif" placeholder="Motif de l'opération"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Billetage</h4>
                        <span>Vous devez définir le billetage lorsqu'il s'agit d'une opération d'encaissement ou de décaissement dans l'entreprise.</span>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="valeur">Devise</label>
                                <select class="form-control setcolor" id="devise_billet">
                                     
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="valeur">Valeur</label>
                                <input type="number" id="valeur" class="form-control setcolor" value="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nombre">Nombre</label>
                                <input type="number" id="nombre" class="form-control setcolor" value="0">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="btn_x" style="color:white ;">Nombre</label>
                                <button type="button" class="btn btn-primary" id="btn_x" onclick="addBilletage();">+</button>
                            </div>
                        </div>
                        <div id="inx"></div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>devise</th>
                                    <th>Valeur</th>
                                    <th>Nombre</th>
                                    <th>Total</th> 
                                </tr>
                            </thead>
                            <tbody id="tab_xman">

                            </tbody>
                        </table>
                        <div style="color:red;font-size:20px;font-weight:bold;text-align:right;" id="total_billetage">Total : </div>
                    </div>

                </div>
                <div id="infos"></div>

            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>