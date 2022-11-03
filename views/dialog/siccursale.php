<!-- Large modal -->
<div class="modal fade create-siccursale" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter ou modifier une siccursale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" id="id_" value="00">

                    <div class="form-group col-md-8">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control mb-0 setcolor" id="nom" name="nom" placeholder="Nom du siccursale">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nom">Préfix Facture,Opérations</label>
                        <input type="text" class="form-control mb-0 setcolor" id="prefix" placeholder="EX:OP-GOM03004">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Téléphone</label>
                        <input type="phone" class="form-control mb-0 setcolor" id="phone" name="phone" placeholder="Numéro de téléphone">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="mail" class="form-control mb-0 setcolor" id="email" name="email" placeholder="Adresse email">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">Adresse</label>
                        <input type="text" class="form-control mb-0 setcolor" id="adresse" name="adresse" placeholder="Adresse physique">
                    </div>
                    <div class="form-group col-md-12" id='infos'>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_succursale();" >Enrégistrer</button>
            </div>
        </div>
    </div>
</div>
