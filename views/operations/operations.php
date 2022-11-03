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
   <script type="text/javascript" src="<?php url(); ?>in/operations.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/var.js?x=23"></script>

</head>
<style>
   .setcolor {
      border-color: #1D335A;
      color: black;
   }
   .setBaroder {

border: 1px solid black;
border-collapse: collapse;

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
               <div class="col-md-12">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <select class="form-control setcolor" id="sicursale">

                        </select>
                     </div>
                     <div class="form-group col-md-2">
                        <input type="date" class="form-control setcolor" placeholder="Début" id="date1">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="date" class="form-control setcolor" placeholder="Début" id="date2">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-primary" id="actualiser" value="Actualiser">
                     </div>
                     <div class="form-group col-md-3" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Nouvelle opération
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="tabx">

                        </div>
                     </div>
                  </div>
                  <br>
               </div>
            </div>
            <div class="row">
               <div class="col-md-9">
                  <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                     <thead>
                        <tr>

                           <th>N°</th>
                           <th>Type</th>
                           <th>Montant</th>
                           <th>Motif</th>
                           <th>Béneficiaire</th>
                           <th>Date Heur</th>
                        </tr>
                     </thead>
                     <tbody id="listeop">


                     </tbody>
                  </table>
               </div>
               <div class="col-md-3">
                  <div class="row">
                     <div class="iq-card-body col-md-12" id="tot_" style="text-align:center ;">

                     </div>
                     <span class="col-md-12">Veuillez saisir le numéro de compte ci-dessous pour voir le solde</span>
                     <div class="col-md-12">
                        <div class="row">
                           <div class="form-group col-md-5">
                              <label>N° Compte</label>
                              <input type="number" class="form-control setcolor" placeholder="Numéro de compte" id="numero_solde">
                           </div>
                           <div class="form-group col-md-4">
                              <label>Devise</label>
                              <select class="form-control setcolor" id="devise_solde">

                              </select>
                           </div>
                           <div class="form-group col-md-2">
                              <label style="color:white ;">OK</label>
                              <input type="button" class="btn btn-primary" onclick="getSolde();" value="Afficher">
                           </div>
                           <div class="form-group col-md-12" id="result_">
                           </div>
                        </div>
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

   <!-- Modal -->
   <?php include './views/operations/create_operation.php'; ?>
   <?php include './views/operations/show_operations.php'; ?>



   <!-- color-customizer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->

   <script>
      document.getElementById("date").valueAsDate = new Date();
      document.getElementById("date1").valueAsDate = new Date();
      document.getElementById("date2").valueAsDate = new Date();

      var tableau = [];
      var tableau_billetage = [];

      function show_operation(params) {

         HttpPost("/operations/by-id", {
            id: params
         }).then((res) => {
            var json = res.data;
            if (json.status == 200) {
               tableau = json.data.operations;
               tableau_billetage = json.data.billetage;

               tableau.forEach(element => {
                  $("#type_numero").html(element.type + " N° " + element.numero + "/Ref : " + element.id);
                  if (element.type == 'DEPOT') {
                     $("#beneficiaire_").html("Compte : <strong>" + element.compte_from + "</strong>");
                     $("#numero_compte").html("Numéro Compte  : <strong>" + element.id_compte_from + "</strong>; Montant : <strong>" + element.montant + " " + element.devise + "</strong>");
                  } else if (element.type == "CREDIT") {
                     $("#beneficiaire_").html("Compte : <strong>" + element.compte_from + "</strong>");
                     $("#numero_compte").html("Numéro Compte  : <strong>" + element.id_compte_from + "</strong>; Montant : <strong>" + element.montant + " " + element.devise + "</strong>");
                  } else if (element.type == "VIREMENT") {
                     $("#beneficiaire_").html("Compte : <strong>" + element.compte_from + "</strong>");
                     $("#numero_compte").html("Numéro Compte  : <strong>" + element.id_compte_from + "</strong>; Montant : <strong>" + element.montant + " " + element.devise + "</strong>");
                  } else {
                     $("#beneficiaire_").html("Compte : <strong>" + element.compte_to + "</strong>");
                     $("#numero_compte").html("Numéro Compte  : <strong>" + element.id_compte_to + "</strong>; Montant : <strong>" + element.montant + " " + element.devise + "</strong>");
                  }

                  $("#motif_operation").html("Motif : <strong>" + element.motif + "</strong>");
                  $("#toute_lettre").html("Montant en toute lettre :  <strong>" + element.montant_toutelettre + "</strong>");
                  $("#beneficiaire_personne").html("Béneficiaire  : <strong>" + element.benefiaire + "</strong>");
                  $("#date_operation").html("Date  : <strong>" + element.date_save + "</strong>");
                  $("#id_operation_").val(element.id);
                  $("#user_nom").html("Sé/" + element.fonction_user_create + " : " + element.fullname_user);
                  $("#valbtn").show();
                  $("#printBtn").hide();
                  $("#delbtn").show();

                  if (element.etat == 1) {
                     $("#valbtn").hide();
                     $("#delbtn").hide();
                     $("#printBtn").show();
                  }

               });


               var xs = 1;
               var bit_ = '';
               var nombre_billet = 0;
               var total_general = 0;
               tableau_billetage.forEach(element => {
                  nombre_billet += parseFloat(element.qte);
                  total_general += parseFloat(element.valeur) * parseInt(element.qte);
                  bit_ += `
                  <tr classe="setBaroder">
                      <td>${xs}</td>
                      <td>${element.devise}</td>
                      <td>${element.valeur}</td>
                      <td>${element.qte}</td>
                      <td>${parseFloat(element.valeur)*parseInt(element.qte)}</td>
                  </tr>`;
                  xs++;
               });
               var bit = null;
               document.getElementById("billetage_").innerHTML = (bit_ != null) ? `<div class="table-responsive">
                                <h4>Billetage</h4>
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">DEVISE</th>
                                            <th scope="col">VALEUR</th>
                                            <th scope="col">NOMBRE</th>
                                            <th scope="col">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bit">


                                    </tbody>
                                </table>

                            </div>` : '';
               var bit = document.getElementById("bit");
               bit.innerHTML = bit_ + `
                                     <thead>
                                        <tr classe="setBaroder">
                                            <th scope="col">Total</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">${nombre_billet}</th>
                                            <th scope="col">${total_general}</th>
                                        </tr>
                                    </thead>
               `;


            }
         });

      }

      function getSolde() {
         var id_compte = $("#numero_solde").val();
         var devise = $("#devise_solde").val();

         HttpPost("/operation/compte/solde", {
            id_compte,
            devise
         }).then(function(response) {
            var json = response.data;
            document.getElementById("result_").innerHTML = setErreur((json.status != 200), json.message, "Informations sur la solde");
         });

      }


      //Billetage
      var billetage_valeur = [];
      var billetage_nombre = [];
      var billetage_devise = [];

      function addBilletage() {

         var nombre = document.getElementById("nombre").value;
         var valeur = document.getElementById("valeur").value;
         var devise = document.getElementById("devise_billet").value;
         if (devise != null && devise != "") {

            if (billetage_valeur.includes(valeur) && billetage_devise.includes(devise)) {
               document.getElementById("inx").innerHTML = "<a style='color:red;'>Ces billets existent dejà dans le panier</a>";
            } else {
               billetage_nombre.push(nombre);
               billetage_valeur.push(valeur);
               billetage_devise.push(devise);
               document.getElementById("inx").innerHTML = "";
            }
         } else {
            document.getElementById("inx").innerHTML = "<a style='color:red;'>Veiller sélectionner la devise svp !.</a>";
         }


         loadBilletage();

      }


      function removeBilletage(index) {

         billetage_valeur.splice(index, 1);
         billetage_nombre.splice(index, 1);
         billetage_devise.splice(index, 1);
         loadBilletage();
      }

      function save_billetage(id_operation) {
         var i = 0;
         var is = false;
         billetage_nombre.forEach(element => {
            var devise = billetage_devise[i];
            var valeur = billetage_valeur[i];
            var nombre = billetage_nombre[i];
            HttpPost("/operations-billetage", {
               id_operation,
               valeur,
               devise,
               nombre
            }).then(response => {
               var json = response.data;
               if (json.status == 200) {
                  is = true;
               }
            });
            i++;
         });

         billetage_nombre = [];
         billetage_valeur = [];
         billetage_devise = [];

         loadBilletage();
         return is;
      }

      function update(array, index, newValue) {
         array[index] = newValue;
      }
      var total_billetage = 0;

      function loadBilletage() {
         var tab = document.getElementById('tab_xman');
         tab.innerHTML = '';
         var i = 0;
         total_billetage = 0;
         billetage_valeur.forEach(element => {

            var val = billetage_valeur[i];
            var nbr = billetage_nombre[i];
            var devise = billetage_devise[i];
            var tot = (val * nbr);
            total_billetage += tot;
            tab.innerHTML += ` <tr>
                    <td>${devise}</td>
                    <td>${val}</td>
                    <td>${nbr}</td>
                    <td>${tot}</td>
                    <td>
                    <div class="flex align-items-center list-user-action"> 
                        <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" 
                            data-original-title="Supprimer" href="#" onclick="removeBilletage('${i}')" ><i class="ri-delete-bin-line"></i>
                        </a>
                    </div>
                    </td>
                </tr>`
            i++;
         });

         $("#total_billetage").html("Total : " + total_billetage);
      }

      function printDivContent() {
         var divElementContents = document.getElementById("print").innerHTML;
         var windows = window.open('', '', 'height=800, width=800');
         windows.document.write('<html>');
         windows.document.write('<title>' + document.getElementById("type_numero").innerHTML + '</title>');
         windows.document.write('<body>');
         windows.document.write(divElementContents);
         windows.document.write('</body></html>');
         windows.document.close();
         windows.print();
      }
      var list_transactions = [];

      function choixop(id) {
         list_transactions.forEach(element => {
            if (element.id == id) {
               document.getElementById("type").value = element.type_;
               document.getElementById("credit_").value = element.compte_from != null ? element.compte_from : '';
               document.getElementById("debit_").value = element.compte_to != null ? element.compte_to : '';
               document.getElementById("montant").value = element.montant;
               document.getElementById("motif").value = element.motif;
               document.getElementById("infos").innerHTML = "";
            }
         });
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