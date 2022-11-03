<?php $menus = "produit"; ?>
<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="robots" content="noindex, nofollow">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Web Manage DB Syteme</title>
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

   <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
   <script src="<?php url(); ?>in/files.js?x=1"> </script>
   <script src="<?php url(); ?>views/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
   <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
   <script type="text/javascript" src="<?php url(); ?>in/var.js?x=1"></script>
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
                           <h4 class="card-title">Textes,Images et videos</h4>
                        </div>
                     </div>

                     <div class="iq-card-body">
                        <div class="table-responsive">

                           <div class="row">
                              <div class="col-md-2">
                                 <button class="iq-bg-primary rounded p-2 pointer" data-toggle="modal" data-target="#add_page">Paramètres des pages</button>
                              </div>
                              <div class="col-md-2">
                                 <select class="form-control setcolor" id="page_" onchange="loadContaint(document.getElementById('page_').value);">

                                 </select>
                              </div>
                              <div class="col-md-2">
                                 <input type="search" class="form-control setcolor" placeholder="Search" aria-controls="user-list-table">
                              </div>

                              <div class="form-group col-md-1">
                                 <select class="form-control setcolor" id="type_" onchange="loadContaint(document.getElementById('page_').value,document.getElementById('type_').value)">
                                    <option value="">Select type</option>
                                    <option value="Blog">Blog</option>
                                    <option value="Evenement">Evenement</option>
                                    <option value="Texte">Texte</option>
                                    <option value="Image">Image</option>
                                    <option value="Video">Video</option>
                                    <option value="Audio">Audio</option>
                                    <option value="Document">Document</option>
                                    <option value="Service">Service</option>
                                    <option value="Partenaire">Partenaire</option>
                                    <option value="Slider">Slider</option>
                                 </select>
                              </div>
                              <div class="col-md-1">
                                 <button class="iq-bg-primary rounded p-2 pointer" data-toggle="modal" data-target="#add_integration">Intégration</button>
                              </div>
                              <div class="col-md-2">
                                 <button class="iq-bg-primary rounded p-2 pointer" data-toggle="modal" data-target=".new-text">Nouveau contenue</button>
                              </div>
                              <div class="col-md-2">
                                 <button class="iq-bg-primary rounded p-2 pointer" data-toggle="modal" data-target=".parametres-site">Web Paramètres</button>
                              </div>
                           </div>

                           <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                              <thead>
                                 <tr>
                                    <th>N°</th>
                                    <th>Réf</th>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Mise en jour</th>
                                    <th>Status</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody id="tab_containt">

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



   <?php include './views/edit/new_text.php'; ?>
   <?php include './views/edit/add_page.php'; ?>
   <?php include './views/edit/add_integration.php'; ?>
   <?php include './views/edit/parametres_site.php'; ?>


   <script>
      CKEDITOR.replace('editor2', {
         height: 260,
         contentsCss: [
            'http://cdn.ckeditor.com/4.19.1/full-all/contents.css',
            'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/css/classic.css'
         ],
         removeButtons: 'PasteFromWord'
      });
      var liste_pages;
      var liste_containt;
      var list_config = [];
      var current_page = null;
      load();

      function loadContaint(page, type = null) {

         current_page = page;

         var tab = document.getElementById('tab_containt');
         tab.innerHTML = "";
         var data_filter = liste_containt;

         var data_filter;

         if (page != null) {
            if (type != null) {
               data_filter = liste_containt.filter(element => (element.id_page == page) && (element.type == type));
            } else {
               data_filter = liste_containt.filter(element => (element.id_page == page));
            }

         }


         data_filter.forEach(element => {


            tab.innerHTML += getElement(element);
         });


      }

      function loadPages() {
         var tab = document.getElementById("tab-page");
         tab.innerHTML = "";
         liste_pages.forEach(element => {
            tab.innerHTML += getElementPage(element);
         });
      }

      function getElement(element) {
         var img = element.file;

         var image = '<?php url(); ?>views/images/defaultuser.png';



         if (element.file != null) {
            image = access_files + JSON.parse(img)[1];
         }

         return `
                  <tr>
                                    <td class="text-center"><img class="rounded img-fluid avatar-40" src="${image}" alt="profile"></td>
                                    <td>${element.id_ref}</td>
                                    <td>${element.title}</td>
                                    <td>${element.type}</td>
                                    <td>${element.updateAt}</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td> 
                                    <td>
                                       <div class="flex align-items-center list-user-action"> 
                                          <a class="iq-bg-primary" onclick="selectVal('${element.id}')" data-toggle="modal" data-target=".new-text" href="#">
                                             <i class="ri-pencil-line" ></i>
                                             </a>
                                          <a class="iq-bg-primary" onclick="del('${element.id}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#">
                                             <i class="ri-delete-bin-line"></i>
                                             </a>
                                       </div>
                                    </td>
                                 </tr>
         `
      }

      function selectPage(id) {
         liste_pages.forEach(element => {
            if (element.id == id) {

               $("#page_id").val(element.id);
               $("#page_name").val(element.designation);
               $("#page_title").val(element.title);
               $("#page_description").val(element.description);

            }
         });
      }

      function getElementPage(element) {

         return `
                  <tr> 
                                    <td>${element.id}</td>
                                    <td>${element.designation}</td>
                                    <td>${element.title}</td>
                                    <td>${element.description}</td> 
                                    <td><span class="badge iq-bg-primary">Active</span></td> 
                                    <td>
                                       <div class="flex align-items-center list-user-action"> 
                                          <a class="iq-bg-primary" onclick="selectPage('${element.id}')" href="#">
                                             <i class="ri-pencil-line" ></i>
                                             </a>
                                          <a class="iq-bg-primary" onclick="delete_page('${element.id}')"  href="#">
                                             <i class="ri-delete-bin-line"></i>
                                             </a>
                                       </div>
                                    </td>
                                 </tr>
         `
      }

      function load() {
         HttpPost("/web-manage/load-all", {}).then(function(response) {
            var json = response.data;
            liste_containt = json.data.containt;
            liste_pages = json.data.pages;
            list_config = json.data.config;
            access_files = url_base + json.file_folder;

            loadContaint(current_page);
            loadPages();
            showConfig();
            document.getElementById("page_").innerHTML = setListe(liste_pages);
            setSelectBoxByValue("page_", current_page);
         });
      }

      function showConfig() {

         list_config.forEach(element => {
            $('#param_title').val(element.title);
            $('#param_phone').val(element.phone);
            $('#param_mail').val(element.email);
            $('#param_adresse').val(element.adresse);
            $('#param_description').val(element.description);
            $("#param_url_linkedin").val(element.linkedin);
            $("#param_url_facebook").val(element.facebook);
            $("#param_url_instagram").val(element.instagram);
            $("#param_url_tweeter").val(element.twitter);
            $("#param_adresse_map").val(element.adresse_map);
            $("#param_id").val(element.id);
            showImg("show_icon2", element.icon2);
            showImg("show_icon1", element.icon1);
         });
      }

      function del(id) {
         if (confirm("Êtes-vous sûr de vouloir supprimer cette information ?")) {

            HttpPost("/web-manage/containt/delete", {
               id
            }).then(function(response) {
               var json = response.data;
               if (json.status == 200) {
                  load();
               }

            });
         }


      }

      function setListe(liste = []) {

         var liste_element = `<option value="">Select Page</option>`;
         liste.forEach(element => {
            liste_element += `<option value="${element.id}">${element.designation}</option>`;
         });

         return liste_element;
      }

      function selectVal(id) {
         liste_containt.forEach(element => {
            if (element.id == id) {

               $("#id_").val(element.id);
               $("#titre_text").val(element.title);
               $("#url").val(element.url);
               $("#editor2").val(element.containt);
               $("#ref_integration").val(element.id_ref);
               $("#extrait").val(element.extrait);
               $("#url").val(element.url);
               setSelectBoxByText("type", element.type);
               setSelectBoxByValue("page_", element.id_page);
               current_page = element.id_page;
               CKEDITOR.instances['editor2'].setData(element.containt);
               $("#al").html("");

               var image = '<?php url(); ?>views/images/defaultuser.png';

               if (element.file != "[]") {
                  var file = JSON.parse(element.file);
                  var count = Object.keys(file).length;

                  var containt = document.getElementById("content");
                  containt.innerHTML = "";
                  for (const key in file) {
                     img = access_files + file[key];
                     containt.innerHTML += `<div class="col-md-4"><img src="${img}" width="100px" class="rounded ml-0"></div>`;

                  }
               }

            }
         });
      }

      function setSelectBoxByText(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].text === etxt)
               eid.options[i].selected = true;
         }
      }

      function setSelectBoxByValue(eid, etxt) {
         var eid = document.getElementById(eid);
         for (var i = 0; i < eid.options.length; ++i) {
            if (eid.options[i].value === etxt)
               eid.options[i].selected = true;
         }
      }

      $('#param_btn_icon1').click(function() {
         $('#icon1').click();
      })
      $('#param_btn_icon2').click(function() {
         $('#icon2').click();

      })

      function save_configuration() {

         var param_title = $('#param_title').val();
         var param_phone = $('#param_phone').val();
         var param_mail = $('#param_mail').val();
         var param_adresse = $('#param_adresse').val();
         var param_description = $('#param_description').val();
         var param_url_linkedin = $("#param_url_linkedin").val();
         var param_url_facebook = $("#param_url_facebook").val();
         var param_url_instagram = $("#param_url_instagram").val();
         var param_url_tweeter = $("#param_url_tweeter").val();
         var param_adresse_map = $("#param_adresse_map").val();
         var param_id = $("#param_id").val();

         const formData = new FormData();
         const imagefile1 = document.querySelector('#icon1');
         const imagefile2 = document.querySelector('#icon2');


         formData.append("id", param_id);
         formData.append("icon1", imagefile1.files[0]);
         formData.append("icon2", imagefile2.files[0]);
         formData.append("title", param_title);
         formData.append("email", param_mail);
         formData.append("phone", param_phone);
         formData.append("adresse", param_adresse);
         formData.append("description", param_description);
         formData.append("linkedin", param_url_linkedin);
         formData.append("facebook", param_url_facebook);
         formData.append("intagram", param_url_instagram);
         formData.append("adresse_map", param_adresse_map);
         formData.append("tweeter", param_url_tweeter);
         formData.append("parms", id_auth);

         HttpPost("/web-manage/create/configuration",
            formData
         ).then(function(response) {
            var json = response.data;

            document.getElementById("alx").innerHTML = setErreur((json.status != 200), json.message);

            if (json.status == 200) {
               load();
            }
         });


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