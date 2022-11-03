<div id="transfert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="transfert">Approvisonnement
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="form-group col-md-8">
                     <label for="produit_">Produit</label>
                     <input type="text" disabled class="form-control mb-0" id="produit_" name="produit" placeholder="Nom du produit">
                  </div>

                  <div class="form-group col-md-4">
                     <label for="qte">Quantité</label>
                     <input type="text" class="form-control mb-0" id="qte" name="qte" placeholder="0">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="produit_">Bourique d'origine</label>
                     <input type="text" disabled class="form-control mb-0" id="boutique_" name="boutique" placeholder="Nom du produit">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="entrep_">Boutique de déstination</label>
                     <select id="entrep_" name="entrep" class="form-control mb-0" id="entrep">
                         

                     </select>
                  </div>

               </div>

               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="date_exp">Observation</label>
                     <textarea class="form-control mb-0" id="description" placeholder="Description des produits à approvisionner"></textarea>
                  </div>
               </div>

               <div id="txx"></div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
               <button type="button" class="btn btn-primary" onclick="sendTransfert();">Enregistrer</button>
            </div>
         </div>
      </div>
   </div>