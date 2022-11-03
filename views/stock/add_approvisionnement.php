<div id="approvisionnement" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="approvisionnement">Approvisonnement
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="form-group col-md-8">
                  <label for="produit_">Produit</label>
                  <input type="text" class="form-control mb-0" id="produit_" name="produit" placeholder="Nom du produit">
               </div>
               <div class="form-group col-md-4">
                  <label for="entrep">Boutique</label>
                  <select id="entrep" name="entrep" class="form-control mb-0" id="entrep">
                     <option>Select</option>

                  </select>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-4">
                  <label for="qte">Quantité</label>
                  <input type="text" class="form-control mb-0" id="qte" name="qte" placeholder="0">
               </div>
               <div class="form-group col-md-4">
                  <label for="cout">Cout d'achat</label>
                  <input type="text" onkeyup="calc();" class="form-control mb-0" id="cout" name="cout" placeholder="0">
               </div>
               <div class="form-group col-md-4">
                  <label for="cout_total">Cout total en <strong>USD<strong></label>
                  <input type="text" class="form-control mb-0" id="cout_total" name="cout_total" placeholder="0">
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-3">
                  <label for="barcode">Barcode</label>
                  <input type="text" class="form-control mb-0" value="" id="barcode" name="barcode" placeholder="0">
               </div>
               <div class="form-group col-md-4">
                  <label for="date_exp">Date d'expiration</label>
                  <input type="date" value="" class="form-control mb-0" id="date_exp" name="date_exp">
               </div>
               <div class="form-group col-md-5">
                  <label for="fournisseur">Fournisseur</label>
                  <input list="list_fournisseur" id="fournisseur" name="" placeholder="Select fournisseur" class="form-control mb-0">
                  <datalist id="list_fournisseur">

                  </datalist>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-12">
                  <label for="date_exp">Observation</label>
                  <textarea class="form-control mb-0" id="description" placeholder="Description des produits à approvisionner"></textarea>
               </div>
            </div>
            <div id="tx"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" onclick="sendApprov();">Enregistrer</button>
         </div>
      </div>
   </div>
</div>