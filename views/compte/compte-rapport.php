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
   <link rel="stylesheet" href="views/css/bootstrap.min.css">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="views/css/typography.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="views/css/style.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="views/css/responsive.css">
   <!-- Full calendar -->
   <link href='fullcalendar/core/main.css' rel='stylesheet' />
   <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/list/main.css' rel='stylesheet' />

   <link rel="stylesheet" href="views/css/flatpickr.min.css">
   <script src="views/js/jquery.min.js"></script>
   <script type="text/javascript" src="in/axios.js"></script>
   <script type="text/javascript" src="in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="in/var.js"></script>

</head>
<style>
   .setcolor {
      border-color: #1D335A;
      color: black;
   }

   @media print {
      table {
         border: solid #000 !important;
         border-width: 1px 0 0 1px !important;
      }

      th,
      td {
         border: solid #000 !important;
         border-width: 0 1px 1px 0 !important;
      }
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
                        <input type="date" class="form-control setcolor" placeholder="Début" id="date1">
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="date" class="form-control setcolor" placeholder="Début" id="date2">
                     </div>

                     <div class="form-group col-md-2">
                        <select class="form-control setcolor" id="devise">

                        </select>
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-primary" onclick="load();" value="Actualiser">
                     </div>
                     <div class="form-group col-md-2" role="group">
                        <button id="btnGroupDrop1" type="button" onclick="printDivContent();" class="btn btn-primary">
                           Imprimer
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="tabx">

                        </div>
                     </div>
                  </div>
                  <br>
               </div>
            </div>
            <div class="row">
               <div class="col-md-5">

                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Situation globale </h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                              <thead>
                                 <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Compte principal</th>
                                    <th scope="col">Débit</th>
                                    <th scope="col">Crédit</th>
                                 </tr>
                              </thead>
                              <tbody id="tab_compte">


                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-7">
                  <div class="col-md-12" id="printDiv">

                     <h5 id="compte_">
                        <h6 id="periode"></h6>
                        <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info" style="text-align:center;">
                           <thead>
                              <tr>
                                 <th>N°</th>
                                 <th colspan="10">Numéro des comptes</th>
                                 <th colspan="10">Libelles</th>
                                 <th colspan="10">Montant</th>
                              </tr>
                           </thead>
                           <tbody id="listeop">

                           </tbody>
                           <flooter>
                              <tr>
                                 <th></th>
                                 <th colspan="20">Total</th>
                                 <th colspan="5"><a id="tot_debit"></a></th>
                                 <th colspan="5"><a id="tot_credit"></a></th>
                              </tr>

                           </flooter>
                        </table>
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



   <script>
      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }

      document.getElementById("date1").valueAsDate = new Date();
      document.getElementById("date2").valueAsDate = new Date();

      var list_compte = [];
      var list_operations = [];
      var list_devises = [];
      load();

      function load() {
         var date1 = $("#date1").val();
         var date2 = $("#date2").val();
         var compte = "all";
         var devise = $("#devise").val();
         var dev = $("#devise").val();
         $("#compte_").html("JOURNALISATION :" + compte);
         $("#periode").html("Du " + date1 + " Au " + date2);

         HttpPost("/comptabilite/rapport", {
            date1,
            date2,
            compte,
            devise
         }).then((res) => {
            var json = res.data;

            list_compte = json.data.comptes;
            list_operations = json.data.operations;
            list_devises = json.data.devises;

            document.getElementById("compte_").innerHTML += "[" + json.data.devise + "]";
            document.getElementById("devise").innerHTML = (setListeCombo(list_devises));
            setSelectBoxByText("devise",dev);
            loadOperations("all");
            loadComptes();
         });
      }

      function loadComptes() {
         var tab = document.getElementById("tab_compte");
         tab.innerHTML = "";
         var t = [];

         list_compte.forEach(element => {
            if (!t.includes(element.classe)) {
               var xtab = getTotals(element.classe);
               var icon_index = Math.floor(Math.random() * 5);
               tab.innerHTML += `<tr>
                                    <td><i class="${icons[icon_index]}"></i></td>
                                    <td><a href="#" onclick='loadOperations("${element.classe}");
                                       document.getElementById("compte_").innerHTML = "Classe: ${element.classe} / "+ document.getElementById("compte").value;
                                    '>${element.classe}</a></td>
                                    <td>${xtab[0]}</td>
                                    <td>${xtab[1]}</td>
                              </tr>`;
               t.push(element.classe);
            }

         });
      }

      function getTotals(classe) {

         var debit = 0;
         var credit = 0;
         list_operations.forEach(element => {
            console.log(element.classe);
            if (element.classe == classe) {
               if (element.type == "DEBIT") {
                  debit += parseFloat(element.montant);
               }
               if (element.type == "CREDIT") {
                  credit += parseFloat(element.montant);
               }
            }
         });
         return [debit, credit]
      }

      const icons = [
         "ri-bit-coin-line text-primary font-size-24 line-height",
         "ri-copper-diamond-line text-danger font-size-24 line-height",
         "ri-at-fill text-secondary font-size-24 line-height",
         "ri-stack-line text-info font-size-24 line-height",
         "ri-exchange-dollar-fill text-success font-size-24 line-height"
      ];

      var total_credit = 0;
      var total_debit = 0;

      function loadOperations(classe) {
         var tab = document.getElementById("listeop");
         total_credit = 0;
         total_debit = 0;
         var x = 1;
         tab.innerHTML = `
                        <tr>
                           <th></th>
                           <th colspan="5"><strong>Débit</strong></th>
                           <th colspan="5"><strong>Crédit</strong></th>
                           <th colspan="10"></th> 
                           <th colspan="5"><strong>Débit</strong></th>
                           <th colspan="5"><strong>Crédit</strong></th>
                        </tr>
                        `;

         list_operations.forEach(element => {
            if (classe == element.classe || classe == "all") {
               tab.innerHTML += getElement(x, element);
               x++;
            }

         });

         $("#tot_credit").html(total_credit);
         $("#tot_debit").html(total_debit);


      }

      function setListe(liste = []) {
         var liste_element = "";

         liste.forEach(element => {

            liste_element += `<option value="${element.compte}">${element.id}</option>`;
         });

         return liste_element;
      }

      function setListeCombo(liste = []) {
         var liste_element = "";

         liste.forEach(element => {

            liste_element += `<option value="${element.id}">${element.designation}</option>`;
         });

         return liste_element;
      }

      function getElement(x, element) {


         var D = "";
         var C = "";
         var DM = "";
         var CM = "";

         if (element.type == "DEBIT") {
            D = element.id_compte;
            DM = element.montant;
            total_debit += parseFloat(element.montant);
         } else {
            C = element.id_compte;
            CM = element.montant;
            total_credit += parseFloat(element.montant);
         }

         return `<tr>
                           <th>${x}</th>
                           <th colspan="5">${D}</th>
                           <th colspan="5">${C}</th>
                           <th colspan="10">${element.libelle}<br><a style="color:red;text-align:center;font-size:10px;">${element.createAt}</a></th> 
                           <th colspan="5">${DM}</th>
                           <th colspan="5">${CM}</th> 
                        </tr>`;
      }

      function printDivContent() {

         var divElementContents = document.getElementById("printDiv").innerHTML;
         var windows = window.open('', '', 'height=800, width=800');
         windows.document.write('<html>');
         windows.document.write('<body>');
         windows.document.write(divElementContents);
         windows.document.write('</body></html>');
         windows.document.close();
         windows.print();
      }
   </script>

   <script src="views/js/popper.min.js"></script>
   <script src="views/js/bootstrap.min.js"></script>
   <!-- Appear JavaScript -->
   <script src="views/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="views/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="views/js/waypoints.min.js"></script>
   <script src="views/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="views/js/wow.min.js"></script>
   <!-- Apexcharts JavaScript -->
   <script src="views/js/apexcharts.js"></script>
   <!-- Slick JavaScript -->
   <script src="views/js/slick.min.js"></script>
   <!-- Select2 JavaScript -->
   <script src="views/js/select2.min.js"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="views/js/owl.carousel.min.js"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="views/js/jquery.magnific-popup.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="views/js/smooth-scrollbar.js"></script>
   <!-- lottie JavaScript -->
   <script src="views/js/lottie.js"></script>
   <!-- am core JavaScript -->
   <script src="views/js/core.js"></script>
   <!-- am charts JavaScript -->
   <script src="views/js/charts.js"></script>
   <!-- am animated JavaScript -->
   <script src="views/js/animated.js"></script>
   <!-- am kelly JavaScript -->
   <script src="views/js/kelly.js"></script>
   <!-- am maps JavaScript -->
   <script src="views/js/maps.js"></script>
   <!-- am worldLow JavaScript -->
   <script src="views/js/worldLow.js"></script>
   <!-- Raphael-min JavaScript -->
   <script src="views/js/raphael-min.js"></script>
   <!-- Morris JavaScript -->
   <script src="views/js/morris.js"></script>
   <!-- Morris min JavaScript -->
   <script src="views/js/morris.min.js"></script>
   <!-- Flatpicker Js -->
   <script src="views/js/flatpickr.js"></script>
   <!-- Style Customizer -->
   <script src="views/js/style-customizer.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="views/js/chart-custom.js"></script>
   <!-- Custom JavaScript -->
   <script src="views/js/custom.js"></script>



</body>

</html>