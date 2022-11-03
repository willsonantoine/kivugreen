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
   <script type="text/javascript" src="<?php url(); ?>in/var.js"></script>
   <script type="text/javascript" src='<?php url(); ?>in/print/js/print.min.js'></script>
   <script src="https://cdn.jsdelivr.net/npm/json-to-csv-export"></script>
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
               <div class="col-md-9">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Liste des opérations</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="form-group col-md-2">
                                    <select class="form-control setcolor" id="succursale" onchange="loadAll('all','all');">

                                    </select>
                                 </div>
                                 <div class="form-group col-md-2">
                                    <select class="form-control setcolor" id="annee" onchange="loadAll('all','all');">

                                    </select>
                                 </div>

                                 <div class=" form-group col-md-1">
                                    <input type="button" class="btn btn-primary" onclick="loadOne();" id="actualiser" value="Actualiser">
                                 </div>
                                 <div class=" form-group col-md-2">
                                    <input type="text" class="form-control setcolor" onkeyup="rechercher();" placeholder="Rechercher ici ..." id="rechercher">
                                 </div>
                                 <div class=" form-group col-md-2">
                                    <select class="form-control setcolor" id="type_print" onclick="load_by(document.getElementById('type_print').value,null)">
                                       <option value="DEPOT">DEPOT</option>
                                       <option value="RETRAIT">RETRAIT</option>
                                       <option value="VIREMENT">VIREMENT</option>
                                       <option value="SORTIE">SORTIE</option>
                                       <option value="ENTREE">ENTREE</option>
                                       <option value="CREDIT">CREDIT</option>
                                    </select>
                                 </div>
                                 <div class=" form-group col-md-1">
                                    <input type="button" class="btn btn-secondary" onclick="ExportData();//printJS('user-list-table', 'html');" id="actualiser" value="Exporter en excel">
                                 </div>



                              </div>
                              <br>
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="iq-card col-md-10">
                                    <div class="iq-card-body" id="mois"></div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class=" form-group col-md-12">
                                       <select class="form-control setcolor" id="jour" onchange="loadByDay();">

                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

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
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Totals par type d'opération </h4>
                        </div>

                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <span>Pour filtrer la liste, vous devez cliquer sur le type d'opération. </span>
                           <table class="table mb-0 table-borderless">
                              <thead>
                                 <tr>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">DEVISE</th>
                                    <th scope="col">MONTANT</th>
                                 </tr>
                              </thead>
                              <tbody id="tot_all">


                              </tbody>
                           </table>

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
                  <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="#">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>

   <!-- Modal -->
   <?php include './views/operations/show_operations.php'; ?>

   <script>
      const d = new Date();
      var current_year = d.getFullYear();
      let current_mois = d.getMonth() + 1;
      let current_jour = d.getDate();

      const list_mois_all = ["Janvier", "Fevrier", "Mars", "Avril", "Mais", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];

      var tableau = [];
      var list_annee = [];
      var list_mois = [];
      var list_sicursale = [];
      var list_total = [];
      var all_mois = [];
      var all_jour = [];

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
                  } else if (element.type == 'ENTREE') {
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
                                    <thead classe="setBaroder">
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
                                        <tr>
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

      loadOne();

      function loadByDay() {
         current_jour = document.getElementById('jour').value;
         loadAll(current_mois, current_jour);
      }
      var name_file = null;

      function loadAll(mois, jour) {
         all_print_table = [];
         if (mois == "all") {
            mois = current_mois;
         }

         if (jour == "all") {
            jour = current_jour;
         }

         name_file = jour + "-" + current_mois + "-" + annee;

         var annee = $("#annee").val();
         var succursale = $("#succursale").val();

         HttpPost("/operations/list/all", {
            annee,
            succursale,
            mois,
            jour
         }).then(function(response) {
            var json = response.data;
            tableau = json.data.operations;
            list_total = json.data.totals;
            all_mois = json.data.all_mois;
            all_jour = json.data.all_jour;

            load_by(null);
            loadTot();

            $("#mois").html(setListeCombo_mois());
            loadComboJour("jour", all_jour);

            setSelectBoxByText("jour", current_jour.toString());
         });
      }

      function setCurrent_mois(mois) {

         if (mois == current_mois) {
            current_mois = "all";
            current_jour = "all";
         } else {
            current_mois = mois;
         }

         loadAll(current_mois, current_jour);
      }

      function setListeCombo_mois() {

         var liste_element = "";

         if (all_mois.length == 0) {
            liste_element = "Vous pouvez voir ici la liste des mois de l'année sélectionnée.";
         }
         all_mois.forEach(element => {

            let checked = ``;

            if (current_mois == element.mois) {
               checked = ` <i class="fa fa-check-square" aria-hidden="true"></i>`;
            }

            liste_element += ` 
                              <a href="#" onclick="setCurrent_mois('${element.mois}')"><span class="badge badge-pill badge-primary font-weight-normal ml-auto mr-1">
                                 ${checked}
                                </span>${list_mois_all[parseInt(element.mois)-1]} <span class="badge badge-pill badge-success">${element.nombre}</span>
                              </a> &nbsp;`;



         });


         return liste_element;
      }

      function loadTot() {
         var tot = document.getElementById("tot_all");
         tot.innerHTML = "";

         list_total.forEach(element => {

            tot.innerHTML += ` <tr>
                                    <td><a href="#"><span onclick="load_by('${element.type}','${element.devise}')" class="badge badge-${getEtat(element.type)}">${element.type} ( ${element.nombre} )</span></a></td>
                                    <td><h4><strong>${element.devise}</strong></h4></td>
                                    <td><h4><strong>${element.montant}</strong></h4></td>
                                 </tr>`;
         });

      }



      function load_by(type, devise) {
         all_print_table = [];
         var tab = document.getElementById("listeop");
         tab.innerHTML = "";
         var data_filter = tableau;

         if (type != null) {
            if (devise == null) {
               data_filter = tableau.filter(element => (element.type == type));
            } else {
               data_filter = tableau.filter(element => (element.type == type) && (element.devise == devise));
            }

         }

         data_filter.forEach(element => {
            tab.innerHTML += getElement(element);
         });

      }

      function rechercher() {
         var txt = document.getElementById('rechercher').value;

         var tab = document.getElementById("listeop");
         tab.innerHTML = "";
         var data_filter = tableau;

         if (txt.length >= 2) {
            data_filter = tableau.filter(element => (element.benefiaire.toLowerCase().indexOf(txt.toLowerCase()) !== -1) || (element.id_compte_ben == txt));
         }

         data_filter.forEach(element => {
            tab.innerHTML += getElement(element);
         });

      }

      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {

            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }

      function loadOne() {
         HttpPost("/operations/list/detailles", {}).then(function(response) {
            var json = response.data;
            list_annee = json.data.annee;
            list_sicursale = json.data.succursale;

            loadComboAnnee("annee", list_annee);
            loadCombo("succursale", list_sicursale);
            setSelectBoxByText("annee", current_year.toString());
            setSelectBoxByText("jour", current_jour.toString());
            loadAll("all", "all");
         });
      }

      function loadComboAnnee(id, liste = []) {
         var el = document.getElementById(id);
         el.innerHTML = `<option value="all">Toutes</option>`
         liste.forEach(element => {
            el.innerHTML += `<option value="${element.annee}">${element.annee}</option>`;
         });
      }

      function loadComboJour(id, liste = []) {
         var el = document.getElementById(id);
         el.innerHTML = `<option value="all">All</option>`
         liste.forEach(element => {
            el.innerHTML += `<option value="${element.jour}">Le ${element.jour} ( ${element.nombre} Op)</option>`;
         });
      }

      function loadCombo(id, liste = []) {
         var el = document.getElementById(id);
         el.innerHTML = ""
         liste.forEach(element => {
            el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
         });
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
      var all_print_table = [];

      function getElement(element) {


         var sty = getEtat(element.type);

         var etat = 'danger';
         if (element.etat == 1) {
            etat = 'success';
         }
         all_print_table.push(element);
         return `<tr> 
         <td>${element.numero}</td>
         <td><span class="badge badge-${sty}">${element.type}</span></td>
         <td>${element.montant} ${element.devise}</td> 
         <td>${element.motif}</span>
         <td>${element.benefiaire}</span>
         <td>${element.date_save} à ${element.heur}</span>
         </td>
         <td>
            <div class="flex align-items-center list-user-action">
                
               <a class="iq-bg-primary"  href="#" data-toggle="modal" data-target=".show_operation" onclick="show_operation('${element.id}');">
                    <i class="fa  fa-print"></i>
               </a> 
            </div>
         </td>
  
      </tr>`;
      }

      function getEtat(type) {
         sty = "primary";
         switch (type) {
            case 'SORTIE':
               sty = "danger";
               break;
            case 'ENTREE':
               sty = "success";
               break;
            case 'DEPOT':
               sty = "primary";
               break;
            case 'RETRAIT':
               sty = "success";
               break;
            case 'CREDIT':
               sty = "warning";
               break;
            case 'PENALITE':
               sty = "danger";
               break;
            case 'VIREMENT':
               sty = "warning";
               break;

            default:
               break;
         }
         return sty;
      }
   </script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
   <script>
      function ExportData() {
         filename = 'RELEVE DE COMPTE.xlsx';

         var ws = XLSX.utils.json_to_sheet(all_print_table);
         var wb = XLSX.utils.book_new();
         XLSX.utils.book_append_sheet(wb, ws, name_file);
         XLSX.writeFile(wb, filename);
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