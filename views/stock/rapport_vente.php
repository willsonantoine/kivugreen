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
   input[type=text] {
      border-color: lightblue;
      color: black;
   }

   input[type=date] {
      border-color: lightblue;
      color: black;
   }

   textarea {
      border-color: lightblue;
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
                           <h4 class="card-title">LISTE DES FACTURES (Rapport de vente)</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <div class="row" style="padding-left: 20px;">

                                       <div class="form-group col-md-4">
                                          <input type="date" id="date" value="" class="form-control mr-2" onchange="load();">
                                       </div>
                                       <div class="form-group col-md-4">
                                          <input type="text" id="txt_recherche" value="" class="form-control mr-2" placeholder="Rechercher ici ... ">
                                       </div>
                                       <div class="form-group col-md-2">
                                          <input type="button" onclick="rechercher();" value="Rechercher" class="btn btn-primary mr-2">
                                       </div>
                                    </div>

                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-4">
                                 <div class="user-list-files d-flex float-right">
                                    <a href="./produit" class="iq-bg-primary">
                                       Liste des produits
                                    </a>
                                    <a class="iq-bg-primary" href="./fiche_de_stock">
                                       Etat de stock
                                    </a>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-sm-6 col-md-4 col-lg-2">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                       <div class="text-center">
                                          <h6> TOTAL VENTE</h6>
                                          <h2 class="mt-2"><b id="total_total">0.0</b></h2>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-2">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                       <div class="text-center">
                                          <h6> TOTAL CASH</h6>
                                          <h2 class="mt-2"><b id="total_vente">0</b></h2>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-2">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                       <div class="text-center">
                                          <h6> TOTAL CREDIT</h6>
                                          <h2 class="mt-2"><b id="total_credit">0</b></h2>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="xdiv"></div>
                           <div class="row">
                              <div class="col-md-8">
                                 <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                       <tr>
                                          <th>N°</th>
                                          <th>Montant</th>
                                          <th>Devise</th>
                                          <th>Client</th>
                                          <th>Reste</th>
                                          <th>Heur</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_produit">

                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-4">
                                 <br>
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title" id="titre">Detailles du facture </h4>
                                          <h6 id="catego_txt"></h6>
                                       </div>
                                       <div class="iq-card-header-toolbar d-flex align-items-center">
                                          <div class="dropdown">
                                             <span class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                       <div class="table-responsive">
                                          <table class="table mb-0 table-borderless" id="tab_">

                                          </table>
                                       </div>
                                    </div>

                                 </div>
                              </div>
                           </div>
                           <!-- <div class="row justify-content-between mt-3">
                           <div id="user-list-page-info" class="col-md-6">
                              <span>Showing 1 to 5 of 5 entries</span>
                           </div>
                           <div class="col-md-6">
                              <nav aria-label="Page navigation example">
                                 <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                       <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                       <a class="page-link" href="#">Next</a>
                                    </li>
                                 </ul>
                              </nav>
                           </div>
                        </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>



      <script>
         var all_vente = [];
         var total_vente = 0;
         var total_reste = 0;

         document.getElementById("date").valueAsDate = new Date();
         load();

         function load() {

            HttpPost("/produit/load-vente", {
               date: $("#date").val(),
            }).then((res) => {
               var json = res.data.data;
               all_vente = json.liste;
               loadProd();
            });
            
         }


         function rechercher() {
            var txt_recherche = document.getElementById("txt_recherche").value;
            txt_recherche = txt_recherche.toUpperCase();
            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            var xs = 1;
            all_vente.forEach(element => {
               if (element.client.toUpperCase().includes(txt_recherche) || element.numero.toUpperCase().includes(txt_recherche)) {
                  if (!list.includes(element.numero)) {
                     tab.innerHTML += getHeader(element);
                  }
               }
               xs++;
            });
         }

         var list = [];

         function loadProd() {
            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            var xs = 1;
            total_reste = 0;
            total_vente = 0;
            list = [];
            all_vente.forEach(element => {

               if (!list.includes(element.numero)) {
                  total_vente += parseFloat(element.montant);
                  total_reste += parseFloat(element.reste);
                  list.push(element.numero);
                  tab.innerHTML += getHeader(element);
               }
               xs++;
            });

            $("#total_vente").html(total_vente);
            $("#total_credit").html(total_reste);
            $("#total_total").html((total_reste + total_vente));
            
         }

         function loadBy(id) {
            var tab = document.getElementById("tab_");
            tab.innerHTML = `
                                     <thead>
                                       <tr>
                                          <th>N°</th>
                                          <th>Designation</th>
                                          <th>Qte</th>
                                          <th>P.U</th>
                                          <th>P.T</th>
                                          <th>Diff</th> 
                                       </tr>
                                    </thead>`;
            var i = 1;
            all_vente.forEach(element => {
               if (element.numero == id) {

                  tab.innerHTML += setElements(i, element);
                  i++;
               }
            });
         }

         function setElements(xs, element) {
            var etat = 'primary';
            if (parseFloat(element.qte) <= parseFloat(element.qte_min)) {
               etat = 'danger';
            }
            var pt = parseFloat(element.prix) * parseFloat(element.qte);
            var dif = parseFloat(element.prix) - parseFloat(element.prix_max);
            var et = 'warning';
            if (dif < 0) {
               et = 'danger';
            } else if (dif > 0) {
               et = 'success';
            }
            return `<tr>
                                       <td>${xs}</td> 
                                       <td>${element.produit}</td>
                                       <td><span class="badge badge-${etat}">${element.qte}</span></td>
                                       <td>${element.prix}</td>
                                       <td>${pt}</td>                     
                                       <td><span class="badge badge-${et}">${dif}</span></td>  
                                                          
                                    </tr>`;
         }

         function getHeader(element) {
            var phone = "";
            if (element.client_phone != null) {
               phone = element.client_phone;
            }

            return `
            <tr>
                                          <th>${element.numero}</th> 
                                          <th>${element.montant}</th>
                                          <th>${element.devise}</th>
                                          <th>${element.client} ${phone}</th>
                                          <th>${element.reste}</th>
                                          <th>${element.heur}</th>
                                          <th>
                                          <div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary"  href="#" onclick="loadBy('${element.numero}');" >
                                                <i class="fa fa-eye"></i>
                                          </a> 
                                       </div>
                                          </th>
                                       </tr>
            `;
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

      <script>
         loadCateg();
      </script>
</body>


</html>