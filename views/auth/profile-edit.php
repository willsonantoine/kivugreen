 <!doctype html>
 <html lang="en">

 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Db System</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php url(); ?>views/images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/responsive.css">
    <script src="<?php url(); ?>views/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>
 </head>
 <style>
    .setcolor {
       border-color: #1D335A;
       color: black;
    }
 </style>

 <body class="sidebar-main-active right-column-fixed">
    <!-- loader Start -->
    <div id="loading">
       <div id="loading-center">
       </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
       <!-- Sidebar  -->

       <!-- TOP Nav Bar -->
       <?php include './views/components/menus.php'; ?>
       <!-- TOP Nav Bar -->
       <?php include './views/components/barheader.php'; ?>
       <!-- Page Content  -->
       <div id="content-page" class="content-page">
          <div class="container-fluid">
             <div class="row">
                <div class="col-md-3">

                   <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                      <div class="iq-card-body">
                         <div class="box text-center">
                            <div class="icon rounded mb-4">
                               <img class="img-fluid avatar-90 rounded-circle" src="<?php echo URL_IMAGES . $profil->img; ?>" alt="">
                            </div>
                            <h5><?php echo $profil->fullname; ?></h5>
                            <p><?php echo $profil->type; ?></p>
                            <p class="">Né le <?php echo $profil->date_birth == null ? '-' : $profil->date_birth; ?> à <?php echo $profil->lieu_naiss == null ? '-' : $profil->lieu_naiss; ?></p>
                            <p class="">Tel <?php echo $profil->phone == null ? '-' : $profil->phone; ?>;Email <?php echo $profil->mail == null ? '-' : $profil->mail; ?></p>
                            <input type="button" class="btn btn-primary col-md-12" value="Informations de base" data-toggle="modal" data-target="#add_user_membre" onclick="selectV();">
                         </div>
                      </div>
                   </div>

                </div>
                <div class="col-md-9">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="iq-card">
                            <div class="iq-card-body p-0">
                               <div class="iq-edit-list">
                                  <ul class="iq-edit-profile d-flex nav nav-pills">
                                     <li class="col-md-2 p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#adress-physique">
                                           Adresse physique
                                        </a>
                                     </li>
                                     <li class="col-md-3 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#professionnelle">
                                           Informations professionnelles
                                        </a>
                                     </li>
                                     <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#ethnicite">
                                           Ethnicité et parenté
                                        </a>
                                     </li>
                                     <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#reseau-sociaux">
                                           Réseaux sociaux
                                        </a>
                                     </li> 
                                     <li class="col-md-3 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#apropos">
                                           Apropos
                                        </a>
                                     </li>

                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-12">
                         <div class="iq-edit-list-data">
                            <div class="tab-content">
                               <!-- Informations personnelle -->
                               <?php include './views/profil_update/adresse-phyisique.php'; ?>
                               <!-- Informations personnelle -->
                               <!-- Reseau sociaux -->
                               <?php include './views/profil_update/reseau-sociaux.php'; ?>
                               <!-- END Reseau sociaux -->
                               <!-- Ethnicite -->
                               <?php include './views/profil_update/ethnicite.php'; ?>
                               <!-- Etnicite -->
                               <!-- Informations professionnelle -->
                               <?php include './views/profil_update/informations-prof.php'; ?>
                               <!-- Informations professionnelle -->
                               <!-- Informations professionnelle -->
                               <?php include './views/profil_update/apropos.php'; ?>
                               <!-- Informations professionnelle -->

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
    <!-- Footer END -->
    <?php include './views/auth/add_user_membre.php'; ?>
    <script>
       var element = JSON.parse(`<?php echo json_encode($profil); ?>`);

       function selectV() {


          $("#id").val(element.id);
          $("#nom").val(element.fullname);
          $("#genre").val(element.gender);
          $("#etatcivil").val(element.etatcivil);
          $("#tel").val(element.phone);
          $("#email").val(element.mail);
          $("#datenaiss").val(element.date_birth);
          $("#lieunaiss").val(element.lieu_naiss);
          $("#nationalite").val(element.nationality);
          $("#carteid").val(element.id_national_card);
          $("#adresse").val(element.adress);
          $("#num_id").val(element.id_compte);
          $("#myfile").val(null);
          $("#categorie_membre").val(element.categorie);
          $("#date_adhesion").val(element.date_adhesion);
 

          setSelectBoxByText("etatcivil", element.etat_civil);
          setSelectBoxByText("genre", element.gender);
          setSelectBoxByText("type", element.type);
         

          var img = './<?php url(); ?>views/images/defaultuser.png';

          if (element.img != null) {
             img = access_files + element.img;
          }

          $('#blah').attr('src', img);

          document.getElementById("txy").innerHTML = "";
       }
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php url(); ?>views/js/jquery.min.js"></script>
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
    <!-- Style Customizer -->
    <script src="<?php url(); ?>views/js/style-customizer.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="<?php url(); ?>views/js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="<?php url(); ?>views/js/custom.js"></script>
 </body>


 </html>