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
   <link href='fullcalendar/core/main.css' rel='stylesheet' />
   <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/list/main.css' rel='stylesheet' />

   <link rel="stylesheet" href="<?php url(); ?>views/css/flatpickr.min.css">
   <script src="<?php url(); ?>views/js/jquery.min.js"></script>


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
            <div class="row" style="text-align: right">
               <select class="form-control col-md-3 setcolor" id="classe_load" style="margin: 10px;">
                  <option value="sicursale">Select Classe</option>
                  <option value="1">Comptes de ressources durables</option>
                  <option value="2">Comptes de l’actif immobilisé</option>
                  <option value="3">Comptes de Epargne/stocks</option>
                  <option value="4">Comptes de tiers</option>
                  <option value="5">Comptes de trésorerie</option>
                  <option value="6">Comptes de charges</option>
                  <option value="7">Comptes de produits</option>
               </select>
               <input type="text" id="recherche" class="form-control col-md-2 setcolor" style="margin: 10px ;" placeholder="Rechercher ici ...">
               <button type="button" id="btn-act" class="btn btn-primary col-md-2" style="margin: 10px ;">Rechecher</button>
               <button type="button" class="btn btn-primary col-md-2" style="margin: 10px ;" data-toggle="modal" data-target=".create-compte">Nouveau compte</button>
               <button type="button" class="btn btn-primary col-md-2" style="margin: 10px ;" data-toggle="modal" data-target=".create-transactions">Transactions</button>

            </div> <br>
            <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
               <thead>
                  <tr>
                     <th>N°</th>
                     <th>Nom</th>
                     <th>Description</th>
                     <th>Date de création</th>
                  </tr>
               </thead>
               <tbody id="liste">

               </tbody>
            </table>


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

   <!-- Modal -->
   <?php include './views/compte/compte.php'; ?>
   <?php include './views/compte/etat_compte.php'; ?>
   <?php include './views/dialog/transactions.php'; ?>
   <?php include './views/dialog/mandateurs.php'; ?>
   <!-- color-customizer END -->
   <!-- Optional JavaScript -->

   <script type="text/javascript">
      var all_operations = [];
      var all_solde = [];
      var all_total = [];
      var list_membres = [];

      function loadBy(id_compte, compte) {

         HttpPost("/comptabilite/loadby/compte", {
            id_compte
         }).then((res) => {

            var data = res.data;

            all_operations = data.data.transactions;
            all_solde = data.data.solde;
            all_total = data.data.totals;
 

            loadOpperations();
            loadSolde();
            loadTot();
            $("#compte_x").html(` [  <strong>${compte} / ${id_compte}</strong>  ]`);

         }).catch((error) => {
            console.log(error)
         });

      }

      function loadMandateurs(id, compte) {
         document.getElementById("infos_compte").innerHTML = `COMPTE : <span class="badge badge-primary">${id}</span> /  <strong>${compte}</strong`;
         load_mandateurs(id);
      }

      function load_mandateurs(id_compte) {
         var tab = document.getElementById("tab_membres_mandateurs");
         tab.innerHTML = "";
         HttpPost("/comptabilite/mandateur/load", {
            id_compte
         }).then(function(response) {
            var json = response.data;
            list_membres = json.data;
            var x = 1;
            list_membres.forEach(element => {
               if (element.etat == 1) {
                  tab.innerHTML += getElementTextMandateur(x, element);
                  x++;
               }

            });
         });

      }

      function delete_mand(id) {

         HttpPost("/comptabilite/mandateur/delete", {
            id
         }).then(function(response) {
            var json = response.data;
            if (json.status == 200) {
               load_mandateurs($("#id_compte_mandateur").val());
            }
         });

      }

      function getElementTextMandateur(x, element) {

         var img = './<?php url(); ?>views/images/defaultuser.png';

         if (element.img != null) {
            img = access_files + element.img;
         }

         return `<tr>
                  <td>${x}</td>
                  <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>
                  <td>${element.fullname}</td>
                  <td>${element.phone}</td>
                  <td>${element.type}</td> 
                  <td>${element.description}</td> 
                  <td><a class="badge badge-danger" href="#" onclick="delete_mand('${element.id}');">Supprimer</a></td> 
                </tr>`;
      }

      function loadTot() {
         var tot = document.getElementById("tot_");
         tot.innerHTML = "";
         all_total.forEach(element => {
            var sty = "primary";
            switch (element.type) {
               case 'SORTIE':
                  sty = "danger";
                  break;
               case 'ENTREE':
                  sty = "success";
                  break;
               case 'DEPOT':
                  sty = "success";
                  break;
               case 'RETRAIT':
                  sty = "success";
                  break;
               case 'CREDIT':
                  sty = "warning";
                  break;

               default:
                  break;
            }
            tot.innerHTML += `
            <button type="button" class="btn mb-1 btn-outline-${sty} col-md-4" >
                   (${element.nombre})  ${element.type} 
                <span class="badge badge-${sty} ml-2">${element.montant}</span>
                <span class="badge badge-primary ml-2">${element.devise}</span>
            </button> `;
         });
      }

      function loadSolde() {

         var tab = document.getElementById("tab-solde");
         tab.innerHTML = `<div class="col-md-4 col-lg-12"><span>Solde disponible</span> </div><br>`;


         all_solde.forEach(element => {

            tab.innerHTML += `
                     <div class="col-md-4 col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height rounded">
                           <div class="iq-card-body">
                              
                              <div class="text-center">
                                 <h2>${element.solde} ${element.devise}</h2>
                                 <p class="mb-0">Mise en jour ${element.updateAt}</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     `;
         });
      }

      function loadOpperations() {
         var listeop = document.getElementById("listeop");
         listeop.innerHTML = '';
         all_operations.forEach(element => {
            listeop.innerHTML += getElement(element.numero, element.type, element.montant, element.devise, element.motif, element.benefiaire, element.date_save, element.id);
         });

      }

      function getElement(numero, type, montant, devise, motif, beneficiaire, heur, id) {


         var e = "primary";
         if (type == "SORTIE") {
            e = "danger";
         }
         if (type == "CREDIT") {
            e = "warning";
         }
         if (type == "VENTE" || type == "PAYEMENT") {
            e = "primary";
         }
         if (type == "ENTREE") {
            e = "success";
         }
         if (type == "DEPOT") {
            e = "success";
         }
         return `<tr>
                  <td>${numero}</td>
                  <td><span class="badge badge-${e}">${type}</span></td>
                  <td>${montant} ${devise}</td>
                  <td>${motif}</td>
                  <td>${beneficiaire}</td>
                  <td>${heur}</td>
                  <td>
                  <a href="#" style="text-align:right;" onclick="delete_operation('${id}');"
                  <i class="fa fa-trash" aria-hidden="true"></i>
                   </a>
                        </td>
                </tr>`;
      }

      function delete_operation(id) {
         if (confirm('Êtes-vous sûr de vouloir supprimer cette opération?')) {
            HttpPost("/operations/historique/delete", {
               id
            }).then(function(response) {
               var json = response.data;
               if (json.status == 200) {
                 location.reload();
               }else{
                  alert(json.message);
               }
            });
         }
      }

      function show_transaction(params) {
         list_transactions.forEach(element => {

            if (element.id == params) {
               document.getElementById("id").value = element.id;
               document.getElementById("designation_").value = element.designation;
               document.getElementById("debit_").value = element.compte_to;
               document.getElementById("credit_").value = element.compte_from;
               document.getElementById("montant_").value = element.montant;
               document.getElementById("motif").value = element.motif;
               setSelectBoxByText("type_", element.type_);
            }

         });
      }
      var list_transactions = [];
   </script>

   <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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
   <script type="text/javascript" src="<?php url(); ?>in/var.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/comptabilite.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script>
      function setInfos(compte, description, id, id_classe, id_ref) {
         document.getElementById("numero").value = id,
            document.getElementById("designation").value = compte,
            document.getElementById("description").value = description;
         document.getElementById("id_ref").value = id_ref;
         setSelectBoxByText("classe", id_classe);
         document.getElementById("infos").innerHTML = "";

      }

      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }
   </script>

</body>

</html>