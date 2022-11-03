<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Db System</title>
   <!-- Favicon -->
   <link rel="shortcut icon" href="images/favicon.ico" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?php url(); ?>views/css/bootstrap.min.css">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="<?php url(); ?>views/css/typography.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="<?php url(); ?>views/css/style.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="<?php url(); ?>views/css/responsive.css">
   <!-- Full calendar -->
   <link href='<?php url(); ?>views/fullcalendar/core/main.css' rel='stylesheet' />
   <link href='<?php url(); ?>views/fullcalendar/daygrid/main.css' rel='stylesheet' />
   <link href='<?php url(); ?>views/fullcalendar/timegrid/main.css' rel='stylesheet' />
   <link href='<?php url(); ?>views/fullcalendar/list/main.css' rel='stylesheet' />

   <link rel="stylesheet" href="<?php url(); ?>views/css/flatpickr.min.css">
   <script src="<?php url(); ?>views/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/credits.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/var.js"></script>
   <script type="text/javascript" src='<?php url(); ?>in/print/js/print.min.js'></script>

</head>
<style>
   .setcolor {
      border-color: #1D335A;
      color: black;
   }
</style>

<body>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">
      <!-- Sidebar  -->
      <?php include './views/components/menus.php'; ?>

      <!-- TOP Nav Bar -->
      <?php include './views/components/barheader.php'; ?>
      <!-- TOP Nav Bar END -->

      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">

            <div class="row">
               <div class="col-md-1" id="annee">

               </div>

               <div class="col-md-8">
                  <h4>Liste des crédits </h4>
                  <br>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="iq-card">
                           <div class="iq-card-body" id="mois"></div>
                        </div>
                     </div>
                     <div class=" form-group col-md-3">
                        <select class="form-control setcolor" id="sele-motif" onchange="rechercherByMotif();">

                        </select>
                     </div>

                     <div class=" form-group col-md-3">
                        <input type="text" class="form-control setcolor" id="recherche" placeholder="Rechercher ici...">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-primary" id="actualiser" onclick="rechercher();" value="Rechercher">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-primary" onclick="printJS('user-list-table', 'html');" value="Imprimer">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-danger" data-toggle="modal" data-target=".donner-credit" id="credit_" value="Nouveau crédit">
                     </div>

                     <div class="col-md-12">

                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead>
                              <tr>
                                 <th>N°</th>
                                 <th>Profil</th>
                                 <th>Nom</th>
                                 <th>N° Compte</th>
                                 <th>Début</th>
                                 <th>Fin</th>
                                 <th>Montant</th>
                                 <th>Reste</th>
                                 <th>Etat</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="liste_credits">


                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="row">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height col-md-12">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"> Totals des crédits en etat normal </h4>
                           </div>

                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">Etat</th>
                                       <th scope="col">Devise</th>
                                       <th scope="col">Présté</th>
                                       <th scope="col">Reste</th>

                                    </tr>
                                 </thead>
                                 <tbody id="tot_all">


                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height col-md-12">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"> Totals des crédits radiés </h4>
                           </div>

                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">Etat</th>
                                       <th scope="col">Devise</th>
                                       <th scope="col">Présté</th>
                                       <th scope="col">Reste</th>

                                    </tr>
                                 </thead>
                                 <tbody id="tot_all1">


                                 </tbody>
                              </table>

                           </div>
                        </div>
                     </div>
                     <a class="col-md-12" href="#" onclick="loadAllOperation(null)" style="color:red ;">Affichier toute la liste</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- Wrapper END -->
   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>

   <?php include "views/dialog/donner_credit.php"; ?>
   <?php include 'views/dialog/show_credit.php'; ?>
   <?php include 'views/dialog/avis_credit.php'; ?>
   <?php include 'views/dialog/payer_credit.php'; ?>
   <?php include 'views/dialog/avis_debit.php'; ?>
   <?php include 'views/dialog/modifier_credit.php'; ?>
   <?php include 'views/sms/send-sms.php'; ?>

   <!-- color-customizer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script>
      function setCalculPourcent() {
         var montant = $("#montant2").val();
         var nombreMois = $("#mois2").val();
         var taux = $("#taux2").val();
         var total_transactions = $("#tot").html();

         var val = ((parseFloat(montant) * taux) / 100);



         var total = (parseFloat(montant) - (val * parseFloat(nombreMois))) - parseFloat(total_transactions);;
         $("#montant_interet").val((val * parseFloat(nombreMois)));
         $("#montant_net2").val(total);
         montant_net();
         ecrire_observation();
      }

      function montant_net() {
         var montant_demande = $("#montant2").val();
         var montant_pourcent = $("#montant_interet").val();
         var montant_net2 = $("#montant_net2").val();
         var total_transactions = $("#tot").html();

         var montant = parseFloat(montant_demande) - parseFloat(total_transactions);
         $("#montant_net2").val(montant);
      }

      function setNextDate() {
         var date = $("#date_debut").val();
         var nombreMois = $("#mois2").val();
         HttpPost("/credit-get-date", {
            date,
            nombreMois
         }).then((response) => {
            document.getElementById("date_fin").value = response.data.data.date;
         });
      }
   </script>
   <script>
      document.getElementById("date_2").valueAsDate = new Date()
      document.getElementById("date_debut").valueAsDate = new Date();
      document.getElementById("date_fin").valueAsDate = new Date()


      var current_year = null;
      const d = new Date();
      var current_year = d.getFullYear();
      let current_mois = d.getMonth() + 1;




      function setCurrent(annee) {
         if (annee == current_year) {
            current_year = "0";
         } else {
            current_year = annee;
         }

         current_mois = "0";
         document.getElementById("annee").innerHTML = setListeCombo_annes(list_filter);
         document.getElementById("mois").innerHTML = setListeCombo_mois(current_year);
         selectClient(current_year, "0");

      }

      function setCurrent_mois(mois) {

         current_mois = mois;
         setListeCombo_mois();
         document.getElementById("mois").innerHTML = setListeCombo_mois(current_year);
         selectClient(current_year, current_mois);

      }

      const list_mois = ["Janvier", "Fevrier", "Mars", "Avril", "Mais", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
      var list_filter = [];

      var temps = [];
      var temps_mois = [];

      function setListeCombo_annes() {
         temps = [];
         var liste_element = "";

         list_filter.forEach(element => {

            if (!temps.includes(element.filter_annee)) {
               let checked = ``;
               if (current_year == element.filter_annee) {
                  checked = ` <i class="fa fa-check-square" aria-hidden="true"></i>`;
                  document.getElementById("mois").innerHTML = setListeCombo_mois(current_year);
                  selectClient(current_year, "0");
               }

               liste_element += `
               <div class="iq-card">
                     <div class="iq-card-body" >
                   <a href="#" onclick="setCurrent('${element.filter_annee}')"><span class="badge badge-pill badge-primary font-weight-normal ml-auto mr-1">
                        ${checked}
                      </span>${element.filter_annee} </a> 
                  </div></div>`;
               temps.push(element.filter_annee);
            }

         });
         return liste_element;
      }

      function setListeCombo_mois(annee) {
         temps_mois = [];
         var liste_element = "";
         if (annee != "0") {
            list_filter.forEach(element => {

               if (element.filter_annee == annee) {
                  if (!temps_mois.includes(element.filter_mois)) {
                     let checked = ``;

                     if (current_mois == element.filter_mois) {
                        checked = ` <i class="fa fa-check-square" aria-hidden="true"></i>`;
                     }

                     liste_element += ` 
                                       <a href="#" onclick="setCurrent_mois('${element.filter_mois}')"><span class="badge badge-pill badge-primary font-weight-normal ml-auto mr-1">
                                             ${checked}
                                          </span>${list_mois[parseInt(element.filter_mois)-1]} <span class="badge badge-pill badge-success">${element.count_mois}</span>
                                       </a> &nbsp;`;
                     temps_mois.push(element.filter_mois);
                  }
               }


            });
         } else {
            liste_element = "Cette liste concerne toutes les années ; si vous voulez faire un tri, cliquez sur chaque année.";
         }

         return liste_element;
      }

      list_operations = [];
      var current_date = null;

      var list_tot = [];

      function selectClient(annee, mois) {

         HttpPost('/credit/loads_byNumCompte', {
            annee,
            mois
         }).then((res) => {
            var json = res.data;


            list_operations = json.data.credits;
            current_date = json.data.current_date;
            list_motifs = res.data.data.motifs;
            list_tot = res.data.data.total;
            document.getElementById("sele-motif").innerHTML = setListeCombo(list_motifs);

            loadAllOperation("Normal");
            loadTot();
         }).catch((error) => {
            console.log(error);
         });

      }

      function loadTot() {
         var tot = document.getElementById("tot_all");
         tot.innerHTML = "";
         list_autre = [];
         list_tot.forEach(element => {

            var etat = "danger";
            if (element.type_credit == "Normal") {
               etat = "primary";
            }
            var el = ` <tr>
                                    <td><a href="#" onclick='loadAllOperation("${element.type_credit}")' class="badge badge-${etat}"><strong>${element.type_credit}</strong></a></td>
                                    <td><h4><strong>${element.devise}</strong></h4></td>
                                    <td><h4><strong>${element.montant}</strong></h4></td>
                                    <td><h4><strong>${element.reste}</strong></h4></td>
                                    
                                 </tr>`;
            if (element.type_credit == "Normal") {
               tot.innerHTML += el;
            } else {
               list_autre.push(el);
            }

         });

         var tab = document.getElementById("tot_all1");
         tab.innerHTML = "";
         list_autre.forEach(element => {
            tab.innerHTML += element;
         });

      }


      var list_autre = [];

      function setListeCombo(liste = []) {
         var liste_element = "<option value=''>Select Motif</option>";

         liste.forEach(element => {

            liste_element += `<option value="${element.id}">${element.designation}</option>`;
         });
         return liste_element;
      };

      function setClient(nom, tel, img) {
         if (img == null) {
            img = "<?php url(); ?>views/images/defaultuser.png";
         } else {
            img = access_files + img;
         }
         document.getElementById("infos-client").innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="user-img img-fluid"><img src="${img}" class="rounded avatar-40"></div>
                            <div class="media-support-info ml-3">
                            <h4>${nom}</h4>
                            <p class="mb-0 font-size-12">Phone : ${tel}</p>
                            </div>
                        </div>
                        
                        `
      }

      function loadAllOperation(type) {

         var liste = document.getElementById("liste_credits");
         liste.innerHTML = "";
         list_operations.forEach(element => {

            if (type == element.type_credit) {
               liste.innerHTML += getElement(element);
            } else if (type == null) {
               liste.innerHTML += getElement(element);
            }


         });
      }

      function rechercher() {
         var txt = $("#recherche").val();
         if (txt.length > 0) {
            var liste = document.getElementById("liste_credits");
            liste.innerHTML = "";

            var data_filter = list_operations.filter(element => (element.compte_from.toLowerCase().indexOf(txt.toLowerCase()) !== -1 || (element.id_compte_from == txt)));

            data_filter.forEach(element => {

               liste.innerHTML += getElement(element);

            });
         }
      }

      function rechercherByMotif() {
         var txt = $("#sele-motif").val();
         var liste = document.getElementById("liste_credits");
         liste.innerHTML = "";

         var data_filter = list_operations.filter(element => (element.motif.trim().toLowerCase() == txt.trim().toLowerCase()));

         data_filter.forEach(element => {
            console.log(element.motif);
            liste.innerHTML += getElement(element);

         });

      }

      function getElement(element) {


         var img = '<?php url(); ?>views/images/defaultuser.png';

         if (element.img != null) {
            img = access_files + element.img;
         }

         var etat = DateDiff(current_date, element.date_fin);
         var txt = "Reste " + etat + " Jrs";
         if (etat <= 0) {
            txt = "Dépassé de " + etat + " Jrs";
         }
         var set = "danger";
         if (etat > 0) {
            set = "success";
         }

         var radier = "";
         if (element.type_credit != "Normal") {
            radier = `<a class='badge badge-danger'>${element.type_credit}</a>`;
         }

         var pay = ``;
         var r = `<span class="badge badge-pill badge-success">Terminé</span>`;
         if (element.reste > 0) {
            r = `<span class="badge badge-pill badge-warning">${element.reste}</span>`;
            pay = `
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#show_credit" 
                                    onclick="CallDetailles('${element.id}','${element.devise}');document.getElementById('id_compte').value='${element.compte_to}';document.getElementById('id_devise_').value='${element.devise}';document.getElementById('ref').value='${element.id}';document.getElementById('devise_id').value='${element.devise_id}'"
                                    >
                                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Afficher la progression des provisions
                                    </a>
            <a class="dropdown-item" href="#" href="#" data-toggle="modal" data-target=".payer_credit" 
                                    onclick="callPayer('${element.id}');document.getElementById('id_compte').value='${element.compte_to}';document.getElementById('id_devise_').value='${element.devise}';document.getElementById('ref').value='${element.id}';document.getElementById('devise_id').value='${element.devise_id}'"
                                    ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Payer</a> `;
         }
         tab_all_val.push(element);
         return ` 
                  <th>${element.id}</th>
                  <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>
                  <th>${element.compte_from}</th>
                  <th>${element.id_compte_from}</th>
                  <th>${element.date_debut}</th>
                  <th>${element.date_fin}</th>
                  <th>${element.montant}</th>
                  <th>${r}</th> 
                  <th><span class="badge badge-pill badge-${set}">${txt.replace('-','')}</span> ${radier}</th>
                  <th>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="#" onclick="show_avis_Credit('${element.id}')" data-toggle="modal" data-target=".avis_credit">
                                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Imprimer l' avis de crédit
                                    </a>
                                    <a class="dropdown-item"
                                    onclick="callUpdate('${element.id}');" href="#" data-toggle="modal" data-target=".update_credit"
                                    >
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;&nbsp;Modifier</a>
                                    ${pay}
                                    <a class="dropdown-item"
                                    onclick="deleteCredit('${element.id}');" href="#" onclick=""
                                    >
                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Supprimer</a>
                                    
                                    <a class="dropdown-item" onclick="setMessage('${element.compte_from}','${element.reste}','${element.devise}','${element.montant}');selectVal('${element.id}','${element.benefiaire_phone}');" data-toggle="modal" data-target=".send-sms"  href="#">
                                    <i class="fa fa-commenting-o"  aria-hidden="true"></i>&nbsp;&nbsp;Rappeler par SMS</a>
                                 </div>
                              </div>
                           </div> 
                   
                  </th>
      `;
      }

      function setMessage(nom,reste,devise,montant) {
         tab_selected_id = [];
         tab_selected_phone = [];
         document.getElementById("show-error").innerHTML="";
         document.getElementById("message-text").value = "Bonjour "+nom+". Nous vous rappllons le payement de votre crédit qui s'eleve aujourd'huit à "+reste+" "+devise+" sur "+montant+" "+devise;
      }

      function deleteCredit(id) {
         
         if (confirm("Ete vous sur de voiloire supprimer ce credit ?")) {
            HttpPost("/operations/deleteCredit", {
               id
            }).then(function(response) {
               var json = response.data;
               if (json.status == 200) {
                  location.reload();
               } else {
                  alert(json.message);
               }
            });
         }

      }

      function callUpdate(params) {

         list_operations.forEach(element => {

            if (element.id == params) {
               $("#title_x_modif").html("<strong>Modification du crédit : " + element.compte_from + "/ Numéro : <strong>" + element.id + "</strong>. Ref : " + element.id_operation + "</strong>");
               $("#datefin").val(element.date_fin);
               $("#montant_reste_payer").val(element.reste);
               $("#devise_reste_payer").val(element.devise);
               $("#motif_modification").val(element.observation_update);
               $("#id_credit_mod").val(element.id);
               $("#last_update").html("Dernière mise en jour en date du " + element.updateAt);
               $("#datedebut").val(element.date_debut);
               $("#montant_reste_donner").val(element.montant);
               $("#motif_credit_motif").val(element.motif);
               $("#montant_interet_donner").val(element.montant_interet);
               $("#montant_en_toute_lettre_modif").val(element.montant_toutelettre1);
            }
         });
      }

      function callPayer(params) {

         list_operations.forEach(element => {

            if (element.id == params) {

               console.log(element.id_devise);

               $("#compte_debit").val(element.compte_from);
               $("#compte_credit").val(element.compte_to);
               $("#devise_payer").val(element.devise);
               $("#id_credit_payer").val(element.id);
               $("#devise_id_payer").val(element.id_devise);
               $("#montant_payer").val(element.reste);
               $("#motif_payer").val("Remboursement du crédit numéro " + element.id);
               $("#reste_montant_payer").val(element.reste);

            }
         });
      }

      function DateDiff(date1, date2) {

         if (date2 == null) {
            date2 = date1;
         }

         var d1 = new Date(date1);
         var d2 = new Date(date2);
         return parseInt((d2 - d1) / (1000 * 60 * 60 * 24), 10);
      }

      function monthDiff(jours) {
         var xs = jours / 30;
         if (xs <= 1) {
            return 1;
         } else {
            return parseInt(xs);
         }

      }

      var list_calcus = [];

      function CallDetailles(numero, devise) {
         var tab = document.getElementById("table_credit");
         $("#id_credit").val(numero);
         tab.innerHTML = "";
         HttpPost("/credit/calculs", {
            id_credit: numero
         }).then(response => {
            var json = response.data;

            $("#id_m").html("Montant octroyé : " + json.data.montant);
            $("#message_").val($("#message_").val() + json.data.somme_valide + " " + json.data.devise);
            if (json.status = 200) {
               list_calcus = json.data.all;

               var tx = "";
               list_calcus.forEach(element => {
                  var es = "danger";
                  var dis = "desabled";
                  if (element.etat == 1) {
                     es = "success";
                     dis = "";
                  }


                  tx += `
                  <div dis class="d-flex align-items-center">
                           <div class="icon iq-icon-box rounded iq-bg-${es} mr-3">
                           <i class="fa fa-exclamation" aria-hidden="true"></i>
                           </div>
                           <div class="iq-details col-sm-9 p-0">
                              <div class="d-flex align-items-center justify-content-between">
                                 <span class="title text-dark">${element.date}</span>
                                 <div class="percentage"><b> ${element.pourcent} <span>%</span></b></div>
                              </div>
                              <div class="iq-progress-bar-linear d-inline-block w-100">
                                 <div class="iq-progress-bar">
                                    <span class="bg-${es}" data-percent="32"></span>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                                 <span class="">${element.interval} Jours</span>
                                 <div class="percentage">${element.montant}<span> ${devise}</span></div>
                              </div>
                              <a href="#" style="text-align:right;" onclick="document.getElementById('val_montant').value='${element.pourcent_montant}';document.getElementById('taux_').value='${element.pourcent}';document.getElementById('prevision').value='${element.pourcent_montant}';">
                           Ajouter <span style="color:red; font-weight:bold;">+ ${element. pourcent_montant}</span>
                           </div> 
                        </a>
                        </div>
                        <hr class="mt-4 mb-4">`;
               });

               $("#table_credit").html(tx);
            }
         });

      }

      function ChangeDate() {
         var nombre = monthDiff(DateDiff($("#date_debut").val(), $("#date_fin").val()));
         $("#mois").val(nombre);
      }

      function changeValue(params) {
         console.log(params);
      }

      function show_avis_debit(params) {

         list_operations.forEach(element => {
            if (params == element.id) {
               $("#ebit_av_numero_credit").html(" N° " + element.id + "/Ref : " + element.id_operation);

               $("#ebit_beneficiaire_").html("Béneficiaire : <strong>" + element.compte_from + "</strong>;N° Compte :" + element.id_compte_from);
               $("#ebit_av_montant").html("</strong>Montant démandé : <strong>" + element.montant + " " + element.devise + "</strong>");
               $("#ebit_toute_lettre").html("Montant en toutes lettre  : <strong>" + element.montant_toutelettre + "</strong>");
               $("#ebit_av_montant_interet").html("<strong>Intérêts retenus : " + element.montant_interet + " " + element.devise + "</strong>");
               $("#ebit_motif_operation").html("Motif : <strong>" + element.motif + "</strong>");
               $("#ebit_av_periode").html("Du : " + element.date_debut + " Au " + element.date_fin + " pour dire " + element.mois + " Mois");
               $("#ebit_av_dateop").html("Date de l'opération : " + element.createAt);

               $("#av_observation").html("Observation : " + element.observation);
            }


         });
      }

      function show_avis_Credit(params) {
         list_operations.forEach(element => {
            if (params == element.id) {
               $("#av_numero_credit").html(" N° " + element.id + "/Ref : " + element.id_operation);

               $("#beneficiaire_").html("Béneficiaire : <strong>" + element.compte_from + "</strong>;N° Compte :" + element.id_compte_from);
               $("#av_montant").html("</strong>Montant : <strong>" + element.montant + " " + element.devise + "</strong>");
               $("#toute_lettre").html("Montant en toutes lettre  : <strong>" + element.montant_toutelettre1 + "</strong>");
               $("#motif_operation").html("Motif : <strong>" + element.motif + "</strong>");
               $("#av_periode").html("Du : " + element.date_debut + " Au " + element.date_fin + " pour dire " + element.mois + " Mois");
               $("#av_dateop").html("Date de l'opération : " + element.createAt);

               $("#av_observation").html("Observation : " + element.observation);
               $("#user_nom").html("Signé : " + element.fullname_user + ";Tel : " + element.phone_user);
               $("#membre_nom").html(": " + element.compte_from + ";Tel : " + element.membre_phone);
            }
         });
      }

      function printDivContent() {
         var divElementContents = document.getElementById("print").innerHTML;
         var windows = window.open('', '', 'height=800, width=800');
         windows.document.write('<html>');
         windows.document.write('<body>');
         windows.document.write(divElementContents);
         windows.document.write('</body></html>');
         windows.document.close();
         windows.print();
      }
   </script>
   <script src="<?php url(); ?>views/js/popper.min.js"></script>
   <script src="<?php url(); ?>views/js/bootstrap.min.js"></script>
   <!-- Appear JavaScript -->
   <script src="<?php url(); ?>views/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="<?php url(); ?>views/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="<?php url(); ?>views/js/waypoints.min.js"></script>
   <script src="<?php url(); ?>views/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="<?php url(); ?>views/js/wow.min.js"></script>
   <!-- Apexcharts JavaScript -->
   <script src="<?php url(); ?>views/js/apexcharts.js"></script>
   <!-- Slick JavaScript -->
   <script src="<?php url(); ?>views/js/slick.min.js"></script>
   <!-- Select2 JavaScript -->
   <script src="<?php url(); ?>views/js/select2.min.js"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="<?php url(); ?>views/js/owl.carousel.min.js"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="<?php url(); ?>views/js/jquery.magnific-popup.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="<?php url(); ?>views/js/smooth-scrollbar.js"></script>
   <!-- lottie JavaScript -->
   <script src="<?php url(); ?>views/js/lottie.js"></script>
   <!-- am core JavaScript -->
   <script src="<?php url(); ?>views/js/core.js"></script>
   <!-- am charts JavaScript -->
   <script src="<?php url(); ?>views/js/charts.js"></script>
   <!-- am animated JavaScript -->
   <script src="<?php url(); ?>views/js/animated.js"></script>
   <!-- am kelly JavaScript -->
   <script src="<?php url(); ?>views/js/kelly.js"></script>
   <!-- am maps JavaScript -->
   <script src="<?php url(); ?>views/js/maps.js"></script>
   <!-- am worldLow JavaScript -->
   <script src="<?php url(); ?>views/js/worldLow.js"></script>
   <!-- Raphael-min JavaScript -->
   <script src="<?php url(); ?>views/js/raphael-min.js"></script>
   <!-- Morris JavaScript -->
   <script src="<?php url(); ?>views/js/morris.js"></script>
   <!-- Morris min JavaScript -->
   <script src="<?php url(); ?>views/js/morris.min.js"></script>
   <!-- Flatpicker Js -->
   <script src="<?php url(); ?>views/js/flatpickr.js"></script>
   <!-- Style Customizer -->
   <script src="<?php url(); ?>views/js/style-customizer.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="<?php url(); ?>views/js/chart-custom.js"></script>
   <!-- Custom JavaScript -->
   <script src="<?php url(); ?>views/js/custom.js"></script>



</body>

</html>