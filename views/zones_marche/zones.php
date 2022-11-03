 <?php include './views/components/link_header.php'; ?>

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
                            <h4 class="card-title">Liste des zones</h4>
                         </div>
                      </div>
                      <div class="iq-card-body">

                         <div class="row">
                            <div class="col-md-6">
                               <div class="row">
                                  <nav class="col-md-9" aria-label="breadcrumb">
                                     <ol class="breadcrumb" id="all_zones">

                                     </ol>
                                  </nav>
                                  <div class="form-group col-md-3">
                                     <button type="button" value="Rechercher" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add_zone">Ajouter une zone</button>
                                  </div>
                               </div>


                               <input type="hidden" id="current_id" value="null">
                               <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                  <thead>
                                     <tr>
                                        <th>N°</th>
                                        <th>Nom de la Zone</th>
                                        <th>Description</th>
                                        <th>Marché</th>
                                        <th>Date Ajout</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody id="tab_zones">


                                  </tbody>
                               </table>
                            </div>
                            <div class="col-md-6">
                               <div class="row">
                                  <h3 class="col-md-9">Liste des marchés de la zone : <span id="zones_"></span></h3>
                                  <div class="form-group col-md-3">
                                     <button type="button" value="Rechercher" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add_marche">Ajouter un Marché</button>
                                  </div>
                               </div>

                               <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                  <thead>
                                     <tr>
                                        <th>N°</th>
                                        <th>Nom du marché</th>
                                        <th>Jours du marché</th>
                                        <th>Embassadeur</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody id="tab_marches">


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


    <?php include './views/zones_marche/add_zone.php'; ?>
    <?php include './views/zones_marche/add_marche.php'; ?>

    <script>
       var liste_zones = [];
       var liste_marches = [];
       var liste_membres = [];
       var liste_selected_zones = [];
       var init_tree = `<li class="breadcrumb-item"><a href="#" onclick="chargement(null);">
                           <i class="ri-home-4-line mr-1 float-left"></i>Zones</a>
                        </li>`;
       var temps = [];



       function loadTreeZone(zone) {
          var tab = '';
          liste_selected_zones.forEach(element => {

             tab += `<li class="breadcrumb-item"><a href="#" onclick="chargement('${element.id}');">
                        ${element.zone}</a>
                     </li>`;


          });

          document.getElementById("all_zones").innerHTML = init_tree + tab;
       }

       var current_zone = null;

       function selectRow(id, zone) {
          current_zone = id;
          $('#id_parent').html(`<option value="${id}">${zone} (Principale)</option>` + setListe(liste_zones, id));
          if (countSub(id) > 0) {
             liste_selected_zones.push({
                id,
                zone
             });
             loadTreeZone(zone);
             chargement(id);

          }
          loadMarches(id, zone)

       }

       function del_zones(id, id_parent) {
          HttpPost("/zone/delete", {
             id
          }).then((res) => {
             var json = res.data;
             if (json.status == 200) {
                load();
             } else {
                alert(json.message);
             }
          })
       }

       function del_marche(id, id_parent) {
          HttpPost("/marche/delete", {
             id
          }).then((res) => {
             var json = res.data;
             if (json.status == 200) {
                liste_marches = json.data;
                chargement_marche(id_zone_marche);
             } else {
                alert(json.message);
             }
          })
       }

       function getElement_zone(x, element, id_parent) {

          var count = countSub(element.id);
          var countV = (count > 0) ? `<span class="badge badge-primary">${count}</span>` : '';

          return `<tr>
                     <td>${x}</td>
                     <td><a href='#' onclick='selectRow("${element.id}","${element.designation}")'>${element.designation}</a>   ${countV}</td>
                     <td>${element.description}</td>
                     <td><a href='#' onclick='loadMarches("${element.id}","${element.designation}")'>Marchés (${countMarche(element.id)})</a></td>
                     <td>${element.createAt.substr(0,10)}</td> 
                     <td>
                        <div class="flex align-items-center list-user-action">
                           <a class="iq-bg-primary" data-placement="top" title="" data-original-title="Modifier" href="#" data-toggle="modal" data-target="#add_zone" onclick="setVZone('${element.id}')">
                           <i class="ri-pencil-line"></i>
                           </a>
                           <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette zone ?')){del_zones('${element.id}','${id_parent}')} ">
                              <i class="ri-delete-bin-line"></i>
                           </a> 
                        </div>
                     </td>
                      
                  </tr>`;
       }

       function getElement_marche(x, element, id_parent) {


          return `<tr>
                     <td>${x}</td>
                     <td>${element.designation}</td>
                     <td>${element.description}</td>
                     <td>${element.ambassador}</td> 
                     <td>
                        <div class="flex align-items-center list-user-action">
                           <a class="iq-bg-primary" data-placement="top" title="" data-original-title="Modifier" href="#" data-toggle="modal" data-target="#add_marche" onclick="setVMarche('${element.id}')">
                           <i class="ri-pencil-line"></i>
                           </a>
                           <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette zone ?')){del_marche('${element.id}','${id_parent}')} ">
                              <i class="ri-delete-bin-line"></i>
                           </a> 
                        </div>
                     </td>
                      
                  </tr>`;
       }

       function loadMarches(id, marche) {
          $("#zones_").html("<strong>" + marche + "</strong>");
          $("#marche_marche").val(marche);


          id_zone_marche = id;
          chargement_marche(id);
       }

       var id_zone_marche = null;

       function countSub(id) {
          var x = 0;
          liste_zones.forEach(element => {

             if (element.id_parent == id) {
                x++;
             }
          });

          return x;
       }

       function countMarche(id) {
          var x = 0;
          liste_marches.forEach(element => {

             if (element.id_parent == id) {
                x++;
             }
          });

          return x;
       }

       function chargement(id_parent = null) {

          if (id_parent == null) {
             liste_selected_zones = [];
             loadTreeZone('zone');
          }
          var tab = document.getElementById("tab_zones");
          tab.innerHTML = '';
          var x = 1;
          liste_zones.forEach(element => {

             if (id_parent == element.id_parent) {
                tab.innerHTML += getElement_zone(x, element, id_parent);
                x++;
             }

          });

       }

       function chargement_marche(id_zone) {


          var tab = document.getElementById("tab_marches");
          tab.innerHTML = '';
          var x = 1;
          liste_marches.forEach(element => {
             if (id_zone == element.id_parent) {
                tab.innerHTML += getElement_marche(x, element, id_parent);
                x++;
             }

          });

       }

       function setVZone(id) {

          liste_zones.forEach(element => {

             if (id == element.id) {
                $("#zone_name").val(element.designation);
                $("#zone_description").val(element.description);
                $("#id_zone").val(element.id);
                setSelectBoxByText("id_parent", element.id_parent);
                chargement_marche(id);
             }
          });

       }

       function setVMarche(id) {

          liste_marches.forEach(element => {

             if (id == element.id) {

                $("#marche_nom").val(element.designation);
                $("#marche_jour").val(element.description);
                $("#marche_amabassadeur").val(element.ambassador);
                $("#id_marche").val(element.id);
                $("#infos_marche").html('');
             }
          });

       }

       function load() {

          HttpPost('/zone/load', {}).then((res) => {
             var json = res.data;

             liste_marches = json.data.marches;
             liste_zones = json.data.zones;
             liste_membres = json.data.membres;

             $('#id_parent').html(`<option value="">Principale</option>` + setListe(liste_zones));
             $('#zone_list').html(setListeAll(liste_membres));
             chargement();


          }).catch((errr) => {
             console.log(errr.message);
          });
       }

       function setListeAll(liste = []) {



          var liste_element = "";

          liste.forEach(element => {
             liste_element += `<option value="${element.designation}">${element.id}</option>`;
          });

          return liste_element;
       }

       function setListe(liste = [], filter_id = null) {

          var liste_element = "";

          liste.forEach(element => {
             if (filter_id == element.id_parent) {
                liste_element += `<option value="${element.id}">${element.designation}</option>`;
             }

          });

          return liste_element;
       }

       function setSelectBoxByText(eid, etxt) {
          var eid = document.getElementById(eid);
          for (var i = 0; i < eid.options.length; ++i) {
             if (eid.options[i].value === etxt) {
                eid.options[i].selected = true;
             }
          }
       }
    </script>

    <script src="<?php url(); ?>in/zones_marches.js"></script>
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