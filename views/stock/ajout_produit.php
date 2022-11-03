<div id="addProduit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addProduit">Ajouter ou modifié un produit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-4">
               <img src="<?php url(); ?>views/images/defaultimg.jpeg" id="blah" class="mb-0" onchange="readURL(this);" alt="defultuser" height="200" width="200" />
                  <br>
               </div>
               <input type="file" name="img" id="myfile" class="form-control" onChange="readURL(document.getElementById('myfile'));" style="display:none;" />
               <div class="col-md-8">
                  <div class="row">

                     <div class="form-group col-md-8">
                        <label for="produit_">Produit</label>
                        <input type="text" class="form-control mb-0 setcolor" id="produitv" name="produit" placeholder="Nom du produit">
                     </div>

                     <div class="form-group col-md-4">
                        <label for="produit_">N° Compte</label>
                        <input type="number" value="" class="form-control mb-0 setcolor" id="numero" name="numero" placeholder="Numero">
                     </div>

                  </div>
                  <div class="form-group">
                     <label for="categorie_produit">Catégorie</label>
                     <select id="categorie_produit" name="categorie_produit" class="form-control mb-0 setcolor">

                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-3">
                  <label for="produit_">Prix de vente</label>
                  <input type="number" class="form-control mb-0 setcolor" id="pv" name="pv" placeholder="Prix de vente">
               </div>
               <div class="form-group col-md-3">
                  <label for="produit_">Prix de vente Min</label>
                  <input type="number" class="form-control mb-0 setcolor" id="pv_min" name="pv_min" placeholder="Prix de vente Min">
               </div>
               <div class="form-group col-md-3">
                  <label for="produit_">Qte Min</label>
                  <input type="number" class="form-control mb-0 setcolor" id="qte_min" name="qte_min" placeholder="Quantite Min">
               </div>
               <div class="form-group col-md-3">
                  <label for="points">Points</label>
                  <input type="number" class="form-control mb-0 setcolor" id="points" name="qte_min" placeholder="0">
               </div>
               <div class="form-group col-md-12">
                  <label for="description_prod">Description</label>
                  <input type="text" class="form-control mb-0 setcolor" id="description_prod" name="description" placeholder="Description du produit">
               </div>
            </div>
            <div id="txy"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="sendProd()" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>

<script>
    $('#blah').click(function() {
      $('#myfile').click();

   })
</script>