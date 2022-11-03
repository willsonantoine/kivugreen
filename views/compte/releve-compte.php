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
                        <input list="compte_list" id="compte" value="" onchange="loadOperations(document.getElementById('compte').value);" class="form-control setcolor" placeholder="Select">
                        <datalist id="compte_list">
                        </datalist>
                     </div>
                     <div class="form-group col-md-2">
                        <select class="form-control setcolor" id="devise">

                        </select>
                     </div>
                     <div class=" form-group col-md-2">
                        <input type="button" class="btn btn-primary" onclick="load();" value="Actualiser">
                     </div>
                     <div class="form-group col-md-2" role="group">
                        <button id="btnGroupDrop1" type="button" onclick="ExportData();//printJS('printDiv', 'html');" class="btn btn-primary">
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
                  <h4 id="compte_"></h4>
                  <h5 id="periode"></h5>
                  <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                     <thead>
                        <tr>
                           <th>N°</th>
                           <th colspan="5">Date</th>
                           <th colspan="5">Ref</th>
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
                        <tr>
                           <th></th>
                           <th colspan="20" style="text-align: right;">Solde</th>
                           <th colspan="10" style="text-align: center;"><a id="solde_x">0</a></th>
                        </tr>
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



      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }

      var list_compte = [];
      var list_operations = [];
      var list_devises = [];
      var devise_value = [];
      var current_id_account = null;
      load();

      function load() {
         var dev = $("#devise").val();

         var date1 = $("#date1").val();
         var date2 = $("#date2").val();

         var compte = "all";

         var devise = $("#devise").val();

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
            devise_value = json.data.devise;

            document.getElementById("compte_list").innerHTML = (setListe(list_compte));
            document.getElementById("devise").innerHTML = (setListeCombo(list_devises));
            setSelectBoxByText("devise", dev);
            loadOperations("all");

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
      var name_file = "";
      const icons = [
         "ri-bit-coin-line text-primary font-size-24 line-height",
         "ri-copper-diamond-line text-danger font-size-24 line-height",
         "ri-at-fill text-secondary font-size-24 line-height",
         "ri-stack-line text-info font-size-24 line-height",
         "ri-exchange-dollar-fill text-success font-size-24 line-height"
      ];

      var total_credit = 0;
      var total_debit = 0;
      var classe = null;

      function loadOperations(compte) {

         if ($("#compte").val().length > 0) {
            compte = $("#compte").val();

         }

         var devise = $("#devise").val();
         $("#compte_").html("RELEVE DE COMPTE : <a style='color:red;'>" + compte + " / " + current_id_account + " [" + devise_value + "]</a>");
         name_file =  compte + " " + devise_value ;
         var date1 = $("#date1").val();
         var date2 = $("#date2").val();

         $("#periode").html("Du " + date1 + " Au " + date2);

         var tab = document.getElementById("listeop");
         tab.innerHTML = "";
         total_credit = 0;
         total_debit = 0;
         var x = 1;


         list_operations.forEach(element => {



            if (compte == element.compte) {
               current_id_account = element.id_compte;
               classe = element.id_classe;
               tab.innerHTML += getElement(x, element);
               tab_to_print.push(element);
               x++;
            }

         });


         $("#tot_credit").html(total_credit);
         $("#tot_debit").html(total_debit);



         if (classe == '3') {
            $("#solde_x").html(parseFloat(total_credit) - parseFloat(total_debit));
         } else {
            $("#solde_x").html(parseFloat(total_debit) - parseFloat(total_credit));
         }


      }
      var tab_to_print = [];
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

      var id_classse = null;

      function getElement(x, element) {

         var DM = "";
         var CM = "";

         if (element.type == "DEBIT") {
            DM = element.montant;
            total_debit += parseFloat(element.montant);
         } else {
            CM = element.montant;
            total_credit += parseFloat(element.montant);
         }

         id_classse = element.id_classe;

         return `<tr>
                           <th>${x}</th>
                           <th colspan="5">${element.createAt.substr(0,10)}</th>
                           <th colspan="5">${element.id_operation} </th>
                           <th colspan="10">${element.libelle} [${element.id_compte_to}]</th> 
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
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
   <script>
      function ExportData() {
         filename = 'RELEVE DE COMPTE.xlsx';

         var ws = XLSX.utils.json_to_sheet(tab_to_print);
         var wb = XLSX.utils.book_new();
         XLSX.utils.book_append_sheet(wb, ws, name_file);
         XLSX.writeFile(wb, filename);
      }
   </script>

</body>

</html>