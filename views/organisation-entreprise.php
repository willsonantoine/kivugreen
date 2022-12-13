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
   <link href='fullcalendar/core/main.css' rel='stylesheet' />
   <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
   <link href='fullcalendar/list/main.css' rel='stylesheet' />

   <link rel="stylesheet" href="<?php url(); ?>views/css/flatpickr.min.css">
   <script src="<?php url(); ?>views/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/var.js"></script>
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


            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Configuration</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <ul class="nav nav-tabs justify-content-end" id="myTab-4" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="home-tab-end" data-toggle="tab" href="#home-end" role="tab" aria-controls="home" aria-selected="true">Informations</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="contact-tab-end" data-toggle="tab" href="#contact-end" role="tab" aria-controls="contact" aria-selected="false">SMS Orange</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="myTabContent-5">
                     <div class="tab-pane fade show active" id="home-end" role="tabpanel" aria-labelledby="home-tab-end">
                        <div class="row">

                           <input type="hidden" id="config_id" value="00">
                           <div class="form-group col-md-8">
                              <label>Nom complet de l'entreprise</label>
                              <input type="text" id="config_nom" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-4">
                              <label>Sigle</label>
                              <input type="phone" id="config_sigle" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-6">
                              <label>Phone</label>
                              <input type="mail" id="config_phone" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-6">
                              <label>Email</label>
                              <input type="mail" id="config_email" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-3">
                              <label>RCCM</label>
                              <input type="mail" id="config_rccm" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-3">
                              <label>ID Nat</label>
                              <input type="mail" id="config_id_nat" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-3">
                              <label>Numéro Impot</label>
                              <input type="mail" id="config_num_impot" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-3">
                              <label>Autres infos</label>
                              <input type="mail" id="config_autres_infos" class="form-control setcolor">
                           </div>

                           <div class="form-group col-md-8">
                              <label>Adresse</label>
                              <input type="text" id="config_adresse" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-4">
                              <label>Type</label>
                              <select class="form-control setcolor" id="config_type">
                                 <option value="Entreprise">Entreprise</option>
                                 <option value="Organisation">Organisation</option>
                                 <option value="Partie Politique">Partie Politique</option>
                                 <option value="Micro Finance">Micro Finance</option>
                              </select>
                           </div>

                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-12">
                                    <span>Veiller importer les logos (Petit et larage)<br></span>
                                    <input type="file" id="icon1" onChange="readURL(document.getElementById('icon1'),'show_icon1');" style="display:none;">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <input type="button" id="param_btn_icon1" onclick="clickFile();" value="Sélectionner l'icon" class="btn btn-primary">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <img src="<?php url(); ?>views/images/icon.png" id="show_icon1" height="40">
                                 </div>

                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <label>Description</label>
                              <textarea id="param_description" class="form-control setcolor"></textarea>
                           </div>
                           <br>


                           <div class="form-group col-md-12" id="alx">

                           </div>
                           <div class="form-group col-md-12">
                              <label for="mere" style="color:white ;"></label>
                              <input type="button" onclick="save_organisation();" value="Enregistrer" class="btn btn-primary">
                           </div>
                        </div>
                     </div>



                     <div class="tab-pane fade" id="contact-end" role="tabpanel" aria-labelledby="contact-tab-end">
                        <div class="row">
                           <span class="form-group col-md-12">
                              Paramètres pour l'envoi de SMS Orange
                           </span>
                           <div class="form-group col-md-10">
                              <label>Orange Basic token Orange</label>
                              <input type="text" id="orange_token" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-2">
                              <label>Origine Phone number</label>
                              <input type="text" id="orange_origin_phone" class="form-control setcolor">
                           </div>
                           <div class="form-group col-md-12">
                              <label>Message d'enregistrement par défaut d'un Membre/Agent? </label>
                              <textarea id="orange_message_default" class="form-control setcolor" onkeyup="saisie();"></textarea>
                           </div>
                           <h3 class="col-md-12" id="exemple">Ex : </h3>
                           <div class="form-group col-md-12" id="alx_orange">
                           </div>
                           <div class="form-group col-md-6">
                              <input type="button" onclick="save_orange_config();" value="Enregistrer" class="btn btn-primary">
                           </div>
                           <div class="form-group col-md-2">
                              <input type="button" onclick="testmessage();" value="Envoyer un message de test" class="btn btn-primary">
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
      function saisie() {
         var premier = $("#orange_message_default").val();
         document.getElementById("exemple").innerHTML = "Ex : Cher(e) {NOM}," + premier + "; Votre Identification est : {ID}";
      }


      load();
      const list = document.getElementById("list");
      var succursale = [];
      var config = [];

      function load() {


         HttpPost("/parametres/config/load", {}).then((res) => { 
            config = res.data.data.config;
            access_files = url_base + res.data.file_folder;
            loadConfig(); 
         }).catch((error) => {
            $("#infos").html(setErreur(true, error.message));
         });

      }

      function loadConfig() {

         config.forEach(element => {

            $("#config_id").val(element.id);
            $("#config_nom").val(element.nom);
            $("#config_sigle").val(element.sigle);
            $("#config_email").val(element.email);
            $("#config_phone").val(element.tel);
            $("#config_id_nat").val(element.id_nat);
            $("#config_num_impot").val(element.numero_import);
            $("#config_autres_infos").val(element.autre_infos);
            $("#config_adresse").val(element.adresse);
            $("#config_rccm").val(element.rccm);
            $("#param_description").val(element.description);
            $("#orange_token").val(element.sms_basic_token);
            $("#orange_origin_phone").val(element.sms_origin_number);
            $("#orange_message_default").val(element.message_default);
            saisie();
            var img = '<?php url(); ?>views/images/defaultuser.png';

            if (element.logo != null) {
               img = access_files + element.logo;
            }
            $('#show_icon1').attr('src', img);

         });
      }



      function save_orange_config() {

         const formData = new FormData();

         formData.append("token", $("#orange_token").val());
         formData.append("id", $("#config_id").val());
         formData.append("tel_origine", $("#orange_origin_phone").val());
         formData.append("message_default", $("#orange_message_default").val());
         formData.append("parms", id_auth);

         HttpPost("/parametres/orgnisations/orange", formData).then(function(response) {
            var json = response.data;
            $("#alx_orange").html(setErreur((json.status != 200), json.message));
         });
      }

      function save_organisation() {

         const formData = new FormData();
         const logo = document.querySelector('#icon1');

         formData.append("logo", logo.files[0]);
         formData.append("id", $("#config_id").val());
         formData.append("nom", $("#config_nom").val());
         formData.append("sigle", $("#config_sigle").val());
         formData.append("tel", $("#config_phone").val());
         formData.append("num_impot", $("#config_num_impot").val());
         formData.append("id_nat", $("#config_id_nat").val());
         formData.append("autres", $("#config_autres_infos").val());
         formData.append("adresse", $("#config_adresse").val());
         formData.append("type", $("#config_type").val());
         formData.append("token", $("#config_token").val());
         formData.append("description", $("#param_description").val());
         formData.append("origine_phone", $("#config_origin_phone").val());
         formData.append("email", $("#config_email").val());
         formData.append("rccm", $("#config_rccm").val());
         formData.append("parms", id_auth);

         HttpPost("/parametres/orgnisations", formData).then(function(response) {
            var json = response.data;
            $("#alx").html(setErreur((json.status != 200), json.message));
         });
      }

      function clickFile() {
         $('#icon1').click();

      }




      function testmessage() {

         if (confirm('Êtes-vous sûr de vouloir envoyer ce message de test ?')) {

            HttpPost("/parametres/sms-test", {

            }).then((res) => {
               var data = res.data;

               if (data.status == 200) {
                  $("#alx_orange").html(setErreur(false, data.message));
               } else {
                  $("#alx_orange").html(setErreur(true, data.message));
               }
            }).catch((error) => {
               $("#alx_orange").html(setErreur(true, error.message));
            });

         }
      }
   </script>
   <!-- color-customizer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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