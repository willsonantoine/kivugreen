<div id="add_user_membre" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addProduit">Ajout ou modifier un utilisateur ou membre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-4">
                  <img src="<?php url(); ?>views/images/defaultuser.png" id="blah" class="mb-0" onchange="readURL(this);" alt="defultuser" height="200" width="200" />
                  <br>
               </div>
               <input type="file" name="img" id="myfile" class="form-control" onChange="readURL(document.getElementById('myfile'));" style="display:none;" />
               <input type="hidden" id="id" value="00">
               <div class="col-md-8">
                  <div class="row">

                     <div class="form-group col-md-8">
                        <label for="nom">Nom complet</label>
                        <input type="text" class="form-control mb-0 setcolor" id="nom" placeholder="">
                     </div>
                     <div class="form-group col-md-4">
                        <label for="nom">ID</label>
                        <input type="text" class="form-control mb-0 setcolor" id="num_id" placeholder="">
                     </div>

                     <div class="form-group col-md-6">
                        <label for="nom">Fonction</label>
                        <input list="fonction_list" id="categorie_membre" name="" placeholder="Select" class="form-control mb-0 setcolor">
                        <datalist id="fonction_list">

                        </datalist>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="nom">Type</label>
                        <select class="form-control mb-0 setcolor" id="type">
                           <option value="Agriculteur">Agriculteur</option>
                           <option value="Vendeur">Vendeur</option>
                           <option value="Acheteur">Acheteur</option>
                           <option value="Agent">Utilisateur/Agent</option>
                           <option value="Default">Default</option>

                        </select>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="produit_">Genre</label>
                        <select class="form-control setcolor" id="genre">
                           <option value="Masculin">Masculin</option>
                           <option value="Feminin">Feminin</option>
                           <option value="Autre">Autre</option>
                        </select>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="nom">Etat civil</label>
                        <select class="form-control mb-0 setcolor" id="etatcivil">
                           <option value="Célibataire">Célibataire</option>
                           <option value="Marié">Marié</option>
                           <option value="Réligieux">Réligieux</option>
                           <option value="Divorcé">Divorcé</option>
                           <option value="Autre">Autre</option>
                        </select>
                     </div>
                  </div>

               </div>
            </div>

            <div class="row">

               <div class="form-group col-md-4">
                  <label for="produit_">Télephone</label>
                  <input type="tel" class="form-control mb-0 setcolor" id="tel" placeholder="+243">
               </div>
               <div class="form-group col-md-4">
                  <label for="produit_">Adresse mail</label>
                  <input type="email" class="form-control mb-0 setcolor" id="email" placeholder="email@gmail.com">
               </div>
               <div class="form-group col-md-4">
                  <label for="nom">Date naissance</label>
                  <input type="date" class="form-control mb-0 setcolor" id="datenaiss">
               </div>
               <div class="form-group col-md-4">
                  <label for="produit_">Lieu de naissance</label>
                  <input type="text" class="form-control mb-0 setcolor" id="lieunaiss" placeholder="">
               </div>
               <div class="form-group col-md-4">
                  <label for="nom">Nationalité</label>
                  <input list="list_nationalite" id="nationalite" placeholder="" required class="form-control mb-0 setcolor">
                  <datalist id="list_nationalite">

                  </datalist>
               </div>
               <div class="form-group col-md-4">
                  <label for="produit_">Numéro de la carte ID</label>
                  <input type="text" class="form-control mb-0 setcolor" id="carteid">
               </div>
               <div class="form-group col-md-9">
                  <label for="produit_">Adresse phyisique</label>
                  <input type="text" class="form-control mb-0 setcolor" id="adresse" placeholder="Province,ville,commune,quartier,avenue">
               </div>
               <div class="form-group col-md-3">
                  <label for="produit_">Date d'enregistrement</label>
                  <input type="date" class="form-control mb-0 setcolor" id="date_adhesion">
               </div>
               <div class="form-group col-md-12">
                  <div class="custom-control custom-checkbox custom-control-inline">
                     <input type="checkbox" class="custom-control-input" id="select_cooperative">
                     <label class="custom-control-label" onclick='showCooperative("block")' for="select_cooperative" style="color:red ;">Il est membre d'une coopérative ou un groupe quelconque ?</label>
                  </div>
               </div>

               <div class="form-group col-md-12" id="pan_hide">
                  <label for="cooperative" id="lab_hide">Coopérative</label>
                  <input list="cooperative_list" id="cooperative" name="" placeholder="Select" class="form-control mb-0 setcolor">
                  <datalist id="cooperative_list">

                  </datalist>
               </div>
            </div>
            <div id="txy"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="add_membre()" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>

<script>
   var isDisplay = false;

   showCooperative();

   function showCooperative(etat = 'none') {

      isDisplay = (etat == 'block' && !isDisplay) ? true : false;

      if (!isDisplay) {
         document.getElementById("cooperative").style.display = 'none';
         document.getElementById("lab_hide").style.display = 'none';
      } else {
         document.getElementById("cooperative").style.display = 'block';
         document.getElementById("lab_hide").style.display = 'block';
      }


   }

   $('#blah').click(function() {
      $('#myfile').click();

   })

   function setListe(liste = []) {
      var liste_element = "";
      liste.forEach(element => {
         liste_element += `<option value="${element.designation}">${element.description}</option>`;
      });
      return liste_element;
   }



   function add_membre() {

      var nom = $("#nom").val();
      var genre = $("#genre").val();
      var etatcivil = $("#etatcivil").val();
      var tel = $("#tel").val();
      var email = $("#email").val();
      var datenaiss = $("#datenaiss").val();
      var lieunaiss = $("#lieunaiss").val();
      var nationalite = $("#nationalite").val();
      var carteid = $("#carteid").val();
      var adresse = $("#adresse").val();
      var date_adhesion = $("#date_adhesion").val();
      var id = $("#id").val();
      var id_categorie = $("#categorie_membre").val();
      var type = $("#type").val();
      var num_id = $("#num_id").val();
      var cooperative = $("#cooperative").val();

      const formData = new FormData();
      const imagefile = document.querySelector('#myfile');

      formData.append("img", imagefile.files[0]);
      formData.append("num_id", num_id);
      formData.append("id", id);
      formData.append("nom", nom);
      formData.append("genre", genre);
      formData.append("etatcivil", etatcivil);
      formData.append("tel", tel);
      formData.append("email", email);
      formData.append("datenaiss", datenaiss);
      formData.append("lieunaiss", lieunaiss);
      formData.append("nationalite", nationalite);
      formData.append("adresse", adresse);
      formData.append("carteid", carteid);
      formData.append("date_adhesion", date_adhesion);
      formData.append("id_categorie", id_categorie);
      formData.append("type", type);
      formData.append("cooperative", cooperative);
      formData.append("parms", id_auth);

      HttpPost("/membre/create", formData).then(function(response) {
         var json = response.data;

         document.getElementById("txy").innerHTML = setErreur((json.status == 201), json.message);
         if (json.status == 200) {
            if (id == "00") {

               $("#num_id").val("");
               $("#nom").val("");
               $("#genre").val("");
               $("#etatcivil").val("");
               $("#tel").val("");
               $("#email").val("");
               $("#datenaiss").val("");
               $("#lieunaiss").val("");
               $("#nationalite").val("");
               $("#carteid").val("");
               $("#adresse").val("");
               $("#myfile").val("");
               $("#categorie_membre").val("");
               $("#type").val("");
               $('#blah').attr('src', "<?php url(); ?>images/defaultuser.png");
            }
            
            load();
         }
      }).catch(function(err) {
         console.log(err);
         document.getElementById("txy").innerHTML = setErreur(true, err.message);
      });

   }
</script>