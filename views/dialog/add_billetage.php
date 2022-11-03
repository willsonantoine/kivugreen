<div id="addbilletage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addProduit">Approvionner le stock des billets</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">

               <div class="form-group col-md-4">
                  <label for="devise">Devise</label>
                  <select class="form-control setcolor" id="devise" name="devise">
                     <option value="CDF">CDF</option>
                     <option value="USD">USD</option>
                  </select>
               </div>

               <div class="form-group col-md-4">
                  <label for="valeur">Valeur</label>
                  <input type="number" value="" class="form-control mb-0 setcolor" id="valeur" placeholder="0.0">
               </div>
               <div class="form-group col-md-4">
                  <label for="valeur">Quantite</label>
                  <input type="number" value="" class="form-control mb-0 setcolor" id="qte" placeholder="0.0">
               </div>

            </div>
             

            <div id="txy"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" onclick="sendBilletage()" class="btn btn-primary">Enregistrer</button>
         </div>
      </div>
   </div>
</div>