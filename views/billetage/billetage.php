<?php $menus = "produit"; ?>
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
      <!-- Sidebar  -->
      <?php include './views/components/menus.php'; ?>
      <!-- TOP Nav Bar -->
      <?php include './views/components/barheader.php'; ?>
      <!-- TOP Nav Bar END -->
      <!-- TOP Nav Bar END -->
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Stock des billets</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">

                           </div>
                           <div id="xdiv"></div>

                           <div class="row">

                              <div class="col-md-6" id="prinStock">
                                 <div class="iq-card-body" id="tot_" style="text-align:center ;">

                                 </div>
                                 <div class="row">
                                    <h4 class="col-md-3">Stock billetage du :</h4>
                                    <div class="form-group col-md-4">
                                       <input type="date" id="date" value="" class="form-control mr-2 setcolor" onchange="load();">
                                    </div>
                                    <input type="button" id="btn" value="Imprimer" class="btn btn-primary col-md-3" onclick="printDivContent('prinStock')">
                                 </div>
                                 <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                       <tr>
                                          <th>N°</th>
                                          <th>Devise</th>
                                          <th>Valeur</th>
                                          <th>Nombre</th>
                                          <th>Total</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_stock">

                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-6">
                                 <br>
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title" id="titre">Historique billetage journalière</h4>
                                          <h6 id="catego_txt"></h6>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                       <div class="row" style="padding-left: 20px;">
                                          <select class="form-control col-md-4 mr-2 setcolor" id="users" onchange="loadByUser();">
                                          </select>

                                          <div class="form-group col-md-2">
                                             <input type="button" id="btn" value="Print" class="btn-primary" onclick="printDivContent('historique_')">
                                          </div>
                                       </div>
                                       <div id="historique_">
                                          <h4>Historique billetage du : <a id="dx"></a></h4>
                                          <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                             <thead>
                                                <tr>
                                                   <th>Devise</th>
                                                   <th>Valeur</th>
                                                   <th>Nombre</th>
                                                   <th>Total</th>
                                                   <th>TYPE</th>
                                                </tr>
                                             </thead>
                                             <tbody id="tab_historique">

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
               </div>
            </div>
         </div>
      </div>

      <?php include './views/dialog/add_billetage.php'; ?>
      <?php include './views/billetage/update_billetage.php'; ?>

      <!-- Ajout Produit -->

      <script>
         document.getElementById("date").valueAsDate = new Date(); 
         var list_stock = [];
         var list_hostorique = [];
         var list_total = [];
         var list_users = [];

         load();

         function load() {

            var date = $("#date").val();
           
            HttpPost("/billetage/load", {
               date
            }).then((rs) => {
               var json = rs.data;
             

               if (json.status == 200) {
                  list_stock = json.data.stock;
                  list_total = json.data.total;
                  list_hostorique = json.data.historique;
                  loadStock(null);
                  loadTot();
                  loadHistorique();
               }

            });
         }

         function loadStock(devise) {
            var tab = document.getElementById("tab_stock");
            tab.innerHTML = "";
            var x = 1;
            list_stock.forEach(element => {

               if (devise == null) {
                  tab.innerHTML += getElementStock(x, element);
                  x++;
               } else {
                  if (devise == element.devise) {
                     tab.innerHTML += getElementStock(x, element);
                     x++;
                  }
               }

            });
         }

         function getElementStock(x, element) {



            return `<tr>
                                          <th>${x}</th>
                                          <th>${element.devise}</th>
                                          <th>${element.valeur}</th>
                                          <th>${element.qte}</th>
                                          <th>${element.pt}</th> 
                                          <th>
                                          <div class="flex align-items-center list-user-action"> 
                                            
                                             <a class="iq-bg-primary" href="#" data-toggle="modal" data-target=".billetage-update" onclick="selectValue('${element.id}');document.getElementById('show-error').innerHTML='';">
                                                <i class="ri-pencil-line"></i>
                                             </a>
                                             
                                          </div>
                                          </th> 
                                       </tr>`;
         }

         function selectValue(id) {

            list_stock.forEach(element => {
               if (element.id == id) {
                  $("#id_id").val(element.id);
                  $("#id_devise").val(element.devise);
                  $("#id_valeur").val(element.valeur);
                  $("#id_nombre").val(element.qte);
               }
            });

         }



         function loadHistorique() {
            var tab = document.getElementById("tab_historique");
            tab.innerHTML = "";

            list_hostorique.forEach(element => {
               if (!list_users.includes(element.user_psedo)) {
                  list_users.push(element.user_psedo);
               }
               tab.innerHTML += `<tr>
                                          <th>${element.devise}</th>
                                          <th>${element.valeur}</th>
                                          <th>${element.nombre}</th>
                                          <th>${parseFloat(element.valeur*parseFloat(element.nombre))}</th>
                                          <th>${element.type}</th> 
                                       </tr>`;
            });

            setListeUsers();
         }

         function loadByUser() {
            var tab = document.getElementById("tab_historique");
            var user = document.getElementById("users").value;
            tab.innerHTML = "";
            list_hostorique.forEach(element => {

               if (user == element.user_psedo || user == "all") {
                  tab.innerHTML += `<tr>
                                          <th>${element.devise}</th>
                                          <th>${element.valeur}</th>
                                          <th>${element.nombre}</th>
                                          <th>${parseFloat(element.valeur*parseFloat(element.nombre))}</th>
                                          <th>${element.type}</th> 
                                       </tr>`;
               }

            });

         }


         function setListeUsers() {
            var liste_element = "";
            var i = 0;
            list_users.forEach(element => {
               liste_element += `<option value="${element}">${element}</option>`;
            });

            $("#users").html(`<option value="all">All</option>` + liste_element);
         }

         function loadTot() {
            var tot = document.getElementById("tot_");
            tot.innerHTML = "";
            list_total.forEach(element => {

               tot.innerHTML += `
            <button type="button" onclick="loadStock('${element.devise}')" class="btn mb-1 btn-outline-primary col-md-4" >
                   (${element.devise})
                <span class="badge badge-primary ml-2">${element.total}</span>
            </button> `;
            });
         }

         loadCateg();

         function printDivContent(div) {

            var divElementContents = document.getElementById(div).innerHTML;
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

      <script>

      </script>
</body>


</html>