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
   <link rel="stylesheet" href="<?php url() ?>views/css/bootstrap.min.css">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="<?php url() ?>views/css/typography.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="<?php url() ?>views/css/style.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="<?php url() ?>views/css/responsive.css">
   <!-- Full calendar -->
   <link href='<?php url() ?>views/fullcalendar/core/main.css' rel='stylesheet' />
   <link href='<?php url() ?>views/fullcalendar/daygrid/main.css' rel='stylesheet' />
   <link href='<?php url() ?>views/fullcalendar/timegrid/main.css' rel='stylesheet' />
   <link href='<?php url() ?>views/fullcalendar/list/main.css' rel='stylesheet' />

   <link rel="stylesheet" href="<?php url() ?>views/css/flatpickr.min.css">
   <script src="<?php url() ?>views/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php url() ?>in/axios.js"></script>
   <script type="text/javascript" src="<?php url() ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url() ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url() ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>

</head>

<style>
   .color {
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
                     <div class="iq-card-body profile-page p-0">
                        <div class="profile-header">
                           <div class="cover-container">
                              <img src="./<?php url() ?>views/images/bg-03.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                              <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                                 <li><a href="javascript:void();"><i class="ri-pencil-line"></i></a></li>
                                 <li><a href="javascript:void();"><i class="ri-settings-4-line"></i></a></li>
                              </ul>
                           </div>
                           <div class="user-detail text-center mb-3">
                              <div class="profile-img">
                                 <img src="./<?php url() ?>views/images/defaultuser.png" alt="profile-img" class="avatar-130 img-fluid" />
                              </div>
                              <div class="profile-detail">
                                 <h3 class="">VOTRE PROFIL</h3>
                              </div>
                           </div>
                           <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                              <!-- <div class="social-links">
                                 <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/08.png" class="img-fluid rounded" alt="facebook"></a>
                                    </li>
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/09.png" class="img-fluid rounded" alt="Twitter"></a>
                                    </li>
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/10.png" class="img-fluid rounded" alt="Instagram"></a>
                                    </li>
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/11.png" class="img-fluid rounded" alt="Google plus"></a>
                                    </li>
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/12.png" class="img-fluid rounded" alt="You tube"></a>
                                    </li>
                                    <li class="text-center pr-3">
                                       <a href="#"><img src="images/icon/13.png" class="img-fluid rounded" alt="linkedin"></a>
                                    </li>
                                 </ul>
                              </div> -->
                              <div class="social-info">
                                 <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                    <li class="text-center pl-3">
                                       <h6>Opérations</h6>
                                       <p class="mb-0">0</p>
                                    </li>
                                    <li class="text-center pl-3">
                                       <h6>Presences</h6>
                                       <p class="mb-0">0</p>
                                    </li>
                                    <li class="text-center pl-3">
                                       <h6>Solde</h6>
                                       <p class="mb-0">0</p>
                                    </li>
                                 </ul>
                              </div>

                           </div>

                        </div>

                     </div>

                  </div>


               </div>
            </div>

            <div class="row">
               <div class="col-md-4">
                  <!-- Liste des access -->
                  <?php foreach ($ALL_ACCESS as $key => $value) {
                  ?>
                     <div class="iq-card">
                        <div class="iq-card-body">
                           <a href="#"><span class="badge badge-pill badge-primary font-weight-normal ml-auto mr-1">
                                 <i class="fa fa-check-square" aria-hidden="true"></i>
                              </span> <?php echo $value; ?>
                           </a>
                        </div>
                     </div>
                  <?php
                  } ?>

                  <!-- EndLite -->
               </div>
               <div class="col-md-4">
                  <div class="iq-card">
                     <div class="iq-card-body">


                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="numero">Nom d'utilisateur</label>
                              <input type="text" class="form-control mb-0 color" id="profile_username">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="numero">Mot de passe utilisateur</label>
                              <input type="password" class="form-control mb-0 color" id="profile_password">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="numero">Confirmer Mot de passe</label>
                              <input type="password" class="form-control mb-0 color" id="profile_password2">
                           </div>
                           <div class="form-group col-md-12">
                              <div id="all"></div>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="numero"></label>
                              <input type="button" class="btn btn-primary mb-0" onclick="updateAccount();" value="Modifier vos informations" id="btn">
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



   <!-- Ajout Produit -->

   <script>
      $("#profile_username").val(localStorage.getItem("psedo"));

      function updateAccount() {
         var username = $("#profile_username").val();
         var password1 = $("#profile_password").val();
         var password2 = $("#profile_password2").val();

         HttpPost("/api/account/update", {
            username,
            password1,
            password2,
            parms: id_auth
         }).then(function(response) {
            var json = response.data;
            document.getElementById("all").innerHTML = setErreur((json.status != 200), json.message);
         });
      }

  


      document.getElementById("date_adhesion").valueAsDate = new Date();
   </script>

   <script src="<?php url() ?>views/js/popper.min.js"></script>
   <script src="<?php url() ?>views/js/bootstrap.min.js"></script>
   <!-- Appear JavaScript -->
   <script src="<?php url() ?>views/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="<?php url() ?>views/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="<?php url() ?>views/js/waypoints.min.js"></script>
   <script src="<?php url() ?>views/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="<?php url() ?>views/js/wow.min.js"></script>
   <!-- Apexcharts JavaScript -->
   <script src="<?php url() ?>views/js/apexcharts.js"></script>
   <!-- Slick JavaScript -->
   <script src="<?php url() ?>views/js/slick.min.js"></script>
   <!-- Select2 JavaScript -->
   <script src="<?php url() ?>views/js/select2.min.js"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="<?php url() ?>views/js/owl.carousel.min.js"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="<?php url() ?>views/js/jquery.magnific-popup.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="<?php url() ?>views/js/smooth-scrollbar.js"></script>
   <!-- lottie JavaScript -->
   <script src="<?php url() ?>views/js/lottie.js"></script>
   <!-- am core JavaScript -->
   <script src="<?php url() ?>views/js/core.js"></script>
   <!-- am charts JavaScript -->
   <script src="<?php url() ?>views/js/charts.js"></script>
   <!-- am animated JavaScript -->
   <script src="<?php url() ?>views/js/animated.js"></script>
   <!-- am kelly JavaScript -->
   <script src="<?php url() ?>views/js/kelly.js"></script>
   <!-- am maps JavaScript -->
   <script src="<?php url() ?>views/js/maps.js"></script>
   <!-- am worldLow JavaScript -->
   <script src="<?php url() ?>views/js/worldLow.js"></script>
   <!-- Raphael-min JavaScript -->
   <script src="<?php url() ?>views/js/raphael-min.js"></script>
   <!-- Morris JavaScript -->
   <script src="<?php url() ?>views/js/morris.js"></script>
   <!-- Morris min JavaScript -->
   <script src="<?php url() ?>views/js/morris.min.js"></script>
   <!-- Flatpicker Js -->
   <script src="<?php url() ?>views/js/flatpickr.js"></script>
   <!-- Style Customizer -->
   <script src="<?php url() ?>views/js/style-customizer.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="<?php url() ?>views/js/chart-custom.js"></script>
   <!-- Custom JavaScript -->
   <script src="<?php url() ?>views/js/custom.js"></script>


</body>


</html>