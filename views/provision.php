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
 
                  <span>Liste des crédits provision : </span>
                  <div class="d-flex mb-4 align-items-center justify-content-between" id="infos-client">

                  </div>
                  <hr width="100%" size="10">
                  <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                     <thead>
                        <tr>
                           <th>N°</th>
                           <th>Compte</th>
                           <th>Début</th>
                           <th>Fin échance</th>
                           <th>Montant</th>
                           <th>Reste</th>
                           <th>Durée</th>
                           <th>Taux</th>
                           <th>Provision atteri</th>
                           <th>Dotation provision</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody id="liste_credits">


                     </tbody>
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
   <!-- color-customizer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script>
      load();
      var liste_credit = [];
      function load() {
         HttpPost("/credit/liste-prevision", {}).then(function(response) {
            var json = response.data;
            liste_credit = json.data;
            console.log(liste_credit);
            chargement();
         });

      }

      function chargement() {
         var tab = document.getElementById("liste_credits");
         liste_credit.forEach(element => {

            

            tab.innerHTML +=`
            <tr>
                           <th>${element.id}</th>
                           <th>${element.compte}</th>
                           <th>${element.date_debut.substr(0,10)}</th>
                           <th>${element.dete_fin.substr(0,10)}</th>
                           <th>${element.montant}</th>
                           <th>${element.reste}</th>
                           <th>${element.duree} Jrs</th>
                           <th>${element.taux}</th>
                           <th>${element.prevision_atteri}</th>
                           <th>${element.dotation_provision}</th>
                           <th>${parseFloat(element.dotation_provision)+parseFloat(element.prevision_atteri)}</th>
                        </tr>
            `;
         });
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