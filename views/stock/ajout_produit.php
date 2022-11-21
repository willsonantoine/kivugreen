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
                        <label for="produit">Produit</label>
                        <input type="text" class="form-control mb-0 setcolor" id="produit" placeholder="Nom du produit">
                     </div>

                     <div class="form-group col-md-4">
                        <label for="code_">Code</label>
                        <input type="text" value="" class="form-control mb-0 setcolor" id="code_" placeholder="Code">
                     </div>

                  </div>
                  <div class="form-group">
                     <label for="categorie_produit">Catégorie</label>
                     <select id="categorie_produit" class="form-control mb-0 setcolor">

                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <label for="description_produit">Description</label>
                  <textarea class="form-control mb-0 setcolor" id="description_produit"></textarea>
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

   });

   function sendProd() {
      document.getElementById("txy").innerHTML = "";
      const formData = new FormData();
      const imagefile = document.querySelector('#myfile');

      formData.append("img", imagefile.files[0]);
      formData.append("id", idProd);
      formData.append("produit", document.getElementById("produit").value);
      formData.append("code", document.getElementById("code_").value);
      formData.append("categorie", document.getElementById("categorie_produit").value);
      formData.append("description", document.getElementById("description_produit").value);

      HttpPost("/produits-create", formData).then((res) => {

         var json = res.data;

         if (json.status == 200) {

            if (idProd == "00") {

               document.getElementById("txy").innerHTML = setErreur(false, json.message);
               document.getElementById("produit").value = "";
               document.getElementById("code_").value = "";
               document.getElementById("description_produit").value = "";

            } else {
               idProd = "00";
               $("#addProduit").modal('hide');
            }

            load();
         } else {
            document.getElementById("txy").innerHTML = setErreur(true, json.message);
         }
      });


      

   }
</script>