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

               <div class="col-md-9" id="printDiv">
                  <div id="alert"></div>
                  <h5 id="compte_">
                     <h6 id="periode"></h6>
                     <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                        <thead>
                           <tr>
                              <th>N°</th>
                              <th colspan="5">N° de compte</th>
                              <th colspan="5">Compte</th>
                              <th colspan="10">Libelles</th>
                              <th colspan="5">Débit</th>
                              <th colspan="5">Crédit</th>
                           </tr>
                        </thead>
                        <tbody id="listeop">

                        </tbody>
                        <flooter>
                           <tr>
                              <th></th>
                              <th colspan="20" style="text-align: right;">TOTAL</th>
                              <th colspan="5"><a id="tot_debit">0</a></th>
                              <th colspan="5"><a id="tot_credit">0</a></th>
                           </tr>
                           <!-- <tr>
                              <th></th>
                              <th colspan="20" style="text-align: right;">Solde</th>
                              <th colspan="10" style="text-align: center;"><a id="solde_x">0</a></th>
                           </tr> -->
                        </flooter>
                     </table>
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
      document.getElementById("date1").valueAsDate = new Date();
      document.getElementById("date2").valueAsDate = new Date();

      var list_compte = [];
      var list_operations = [];
      var list_devises = [];
      var devise_value = [];
      load();

      function load() {
         var dev = $("#devise").val();
         var date1 = $("#date1").val();
         var date2 = $("#date2").val();
         var devise = $("#devise").val();


         HttpPost("/comptabilite/rapport-final", {
            date1,
            date2,
            devise
         }).then((res) => {
            var json = res.data;

            list_operations = json.data.operations;
            list_devises = json.data.devises;
            devise_value = json.data.devise;

            document.getElementById("devise").innerHTML = (setListeCombo(list_devises));
            setSelectBoxByText("devise", dev);
            loadOperations("all");

         });


      }
      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }

      var total_credit = 0;
      var total_debit = 0;

      function getMontant(classe, type) {
         var val = 0;
         list_operations.forEach(element => {
            if (element.classe == classe && element.type == type) {
               val = element.montant;
            }
         });

         return val;
      }

      function loadOperations(compte) {

         var devise = $("#devise").val();
         $("#compte_").html(" [" + devise_value + "]");

         var date1 = $("#date1").val();
         var date2 = $("#date2").val();

         $("#periode").html("Du " + date1 + " Au " + date2);

         var tab = document.getElementById("listeop");
         tab.innerHTML = "";
         total_credit = 0;
         total_debit = 0;
         var x = 1;


         list_operations.forEach(element => {
            // if (element.type == 'DEBIT') {
            tab.innerHTML += getElement(x, element);
            x++;
            // }
         });


         $("#tot_credit").html(total_credit);
         $("#tot_debit").html(total_debit);



         // $("#solde_x").html(parseFloat(total_debit) - parseFloat(total_credit));




      }

      function setListeCombo(liste = []) {
         var liste_element = "";
         tembo = [];
         liste.forEach(element => {

            liste_element += `<option value="${element.id}">${element.designation}</option>`;
         });

         return liste_element;
      }

      var id_classse = null;
      var tembo = [];

      function getElement(x, element) {

         if (!tembo.includes(element.classe)) {
            var DM = "";
            var CM = "";

            DM = getMontant(element.classe, "DEBIT");
            total_debit += parseFloat(DM);

            CM = getMontant(element.classe, "CREDIT");
            total_credit += parseFloat(CM);


            id_classse = element.id_classe;
            tembo.push(element.classe);
            return `<tr>
                           <th>${x}</th>
                           <th colspan="5">${element.id_classe }</th>
                           <th colspan="5">${element.classe}</th>
                           <th colspan="10">--</th> 
                           <th colspan="5">${DM}</th>
                           <th colspan="5">${CM}</th> 
                     </tr>`;
         }

         return '';

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