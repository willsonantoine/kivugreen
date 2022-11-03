<div id="show_credit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="show_credit" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="transfert">Afficher le crédit
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body" id="table_credit">

                     </div>
                     <h2 id="id_m"></h2>
                  </div>

               </div>
               <div class="col-lg-6">
                  <h4>Valider une pénalitées</h4>
                  <br>
                  <input type="hidden" id="ref">
                  <input type="hidden" id="devise_id">
                  <input type="hidden" id="id_credit">
                  <div class="row">
                     <div class="form-group col-md-3">
                        <label>Montant</label>
                        <input type="text" id="val_montant" class="form-control mb-0" placeholder="Montant" />
                     </div>
                     <div class="form-group col-md-3">
                        <label>Devise</label>
                        <input type="text" id="id_devise_" class="form-control mb-0" disabled />
                     </div>
                     <div class="form-group col-md-4">
                        <label>Date de l'opération</label>
                        <input type="date" id="date_operation" class="form-control mb-0" />
                     </div>
                     <div class="form-group col-md-9">
                        <label for="debit2">Compte de déstination</label>
                        <input list="list_compte_to" id="id_compte" name="" placeholder="Select" class="form-control mb-0">
                        <datalist id="list_compte_to">

                        </datalist>
                     </div>
                  </div>
                  <div style="color: red;" id="alert_alert"></div>
                  <div class="form-group">
                     <input type="button" class="btn btn-primary mb-0" onclick="save_op();" value="Ajouter comme crédit" />
                  </div>
                  <hr>
                  <div class="form-group">
                     <label>Message à envoyer</label>
                     <textarea class="form-control mb-0" id="message_">Bonjour, nous souhaitons vous rappeler le paiement de votre crédit qui s'élève aujourd'hui à  </textarea>
                  </div>
                  <div class="form-group">
                     <input type="button" class="btn btn-primary mb-0" value="Envoie un message de rappel" />
                  </div>

                  <hr>
                  <hr>
                  <h4>Enrégistrer l'etat du crédit</h4>
                  <br>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>Select type crédit</label>
                        <select class="form-control setcolor" id="type_credit">
                           <option value="Crédit prorogé">Crédit prorogé</option>
                           <option value="Crédit impayé">Crédit impayé</option>
                           <option value="Crédit douteux">Crédit douteux</option>
                           <option value="Crédit contentieux">Crédit contentieux</option>
                           <option value="Crédit irrecurable">Crédit irrecurable</option>
                           <option value="Crédit Cloturé">Cloturé</option>
                        </select>
                     </div> 
                     <div class="form-group col-md-3">
                        <label for="taux_">Taux en %</label>
                        <input type="number" id="taux_" class="form-control mb-0">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="prevision">Prévision</label>
                        <input type="number" id="prevision" class="form-control mb-0">
                     </div>
                     <div style="color: red;" id="alert_alert2"></div>
                     <div class="form-group col-md-3">
                        <label for="montantActuel">-</label>
                        <input type="button" class="btn btn-primary mb-0" onclick="save_prevision();" value="Enregistrer l'historique" />
                     </div>
                  </div>



               </div>
            </div>

            <div id="txx"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary">Enregistrer</button>
         </div>
      </div>
   </div>
</div>
<script>
   function save_prevision() {

      var id_credit = document.getElementById('id_credit').value;
      var type_credit = document.getElementById('type_credit').value;
     
      var dotation_provision = document.getElementById('prevision').value;
      var taux = document.getElementById('taux_').value;

      HttpPost("/credit/add_prevision", {
         type_credit, 
         taux,
         id_credit,dotation_provision
      }).then((res) => {
         document.getElementById('alert_alert2').innerHTML = setErreur((res.data.status != 200), res.data.message);
         console.log(res.data.status, "//", res.data.message);
      }).catch((error) => {
         console.log(error);
      });

   }

   function save_op() {

      var credit = document.getElementById('id_compte').value;
      var montant = document.getElementById('val_montant').value;
      var devise = document.getElementById('devise_id').value;
      var date = document.getElementById('date_operation').value;
      var type = "PENALITE";
      var debit = "57";
      var montant_toute_lettre = "--";
      var id_succursale = "1";
      var ref = document.getElementById("ref").value;
      var motif = "Pénalitées de rétard de remboursement du crédit N° " + ref;
      var beneficiaire = credit;

      HttpPost("/operations/create", {
         debit,
         credit,
         type,
         montant,
         devise,
         montant_toute_lettre,
         date,
         beneficiaire,
         id_succursale,
         motif
      }).then((res) => {
         document.getElementById('alert_alert').innerHTML = setErreur((res.data.status != 200), res.data.message);
         console.log(res.data.status, "//", res.data.message);
      }).catch((error) => {
         console.log(error);
      });

   }
</script>