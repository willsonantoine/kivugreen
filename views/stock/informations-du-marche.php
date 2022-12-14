<?php $menus = "produit"; ?>

<?php include './views/components/link_header.php'; ?>

</head>

<style>
   .setcolor {
      border-color: #29B572;
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
                           <h4 class="card-title">Informations du marché</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-12">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <div class="row" style="padding-left: 10px;">

                                       <div class="form-group col-md-2">
                                          <select class="form-control mr-2 setcolor" id="zones" onchange="load(-1);">
                                          </select>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <select class="form-control mr-2 setcolor" id="marches" onchange="load(-1);">
                                          </select>
                                       </div>

                                       <div class="form-group col-md-3">
                                          <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input" onchange="load(0);" id="non_validee">
                                             <label class="custom-control-label" for="non_validee">Informations non validée </label>
                                          </div>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input" onchange="load(1);" id="validee">
                                             <label class="custom-control-label" for="validee">Informations validée </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-12">
                                 <div class="row" style="padding-left:20px ;">

                                 </div>
                              </div>
                           </div>

                           <div id="xdiv"></div>
                           <div class="row">
                              <div class="col-md-12">
                                 <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                       <tr>
                                          <th>N°</th>
                                          <th>Image</th>
                                          <th>Designation</th>
                                          <th>Prix</th>
                                          <th>Devise</th>
                                          <th>Unite</th>
                                          <th>Collecteur</th>
                                          <th id="title_x">Collecteur</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_collecte">

                                    </tbody>
                                 </table>
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
      <!-- Wrapper END -->
      <!-- Footer -->

      <!-- Footer END -->




      <?php include './views/stock/ajout_produit.php'; ?>
      <?php include './views/stock/ajout_categorie.php'; ?>
      <?php include './views/stock/add_unite.php'; ?>

      <!-- Ajout Produit -->



      <script>
         var all_categorie = [];
         var all_collecte = [];
         var all_zones = [];
         var all_marches = [];

         load();


         var current_etat = 0;

         function load(etat = 0) {

            if (etat == -1) {
               etat = current_etat;
            }

            var zone = $("#zones").val();
            var marche = $("#marches").val();

            HttpPost("/produit/collecte/load", {
               etat,
               zone,
               marche
            }).then((res) => {
               var json = res.data.data;
               all_collecte = json.collecte;
               access_files = url_base + res.data.file_folder;
               all_zones = json.zones;
               all_marches = json.marche;

               loadCombo("marches", all_marches, "Marché");
               loadCombo("zones", all_zones, "Zone");
               chargement();

               document.getElementById("non_validee").checked = (etat == 0);
               document.getElementById("validee").checked = (etat == 1);

               setSelectBoxByText("marches", marche);
               setSelectBoxByText("zones", zone);

               current_etat = etat;
               if (etat == 0) {
                  $("#title_x").html("Date collection");
               } else {
                  $("#title_x").html("Date validation");
               }
            });
         }

         function chargement() {

            var tab = document.getElementById("tab_collecte");
            tab.innerHTML = "";
            var xs = 1;
            all_collecte.forEach(element => {

               tab.innerHTML += setElements(xs, element);
               xs++;
            });
         }


         function setElements(x, element) {


            var img = './<?php url(); ?>views/images/defaultimg.jpeg';

            if (element.img != null) {
               img = access_files + element.img;
            }

            var act = `<div class="dropdown-menu dropdown-menu-right">
                                                  
                                                  <a class="dropdown-item" href="#" onclick='validateThis("${element.id}");'>
                                                     <i class="ri-delete-bin-6-fill mr-2"></i>Valider
                                                  </a>
                                                  <a class="dropdown-item" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette information')){deleteThis('${element.id}')} ">
                                                     <i class="ri-pencil-fill mr-2">
                                                     </i>Supprimer
                                                  </a>
                                                   
                                               </div>`;
            if (element.etat == 1) {
               act = "";
            }

            date = (element.etat == 1) ? element.date_validate : element.createAt;

            return `<tr>
                                       <td>${x}</td>
                                       <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>                      
                                       <td>${element.produit}</td> 
                                       <td>${element.prix}</td>
                                       <td>${element.devise}</td> 
                                       <td>${element.unites} [ ${element.valeur_kg} Kg ]</td>
                                       <td>${element.fullname}</td>
                                       <td>${date}</td>
                                       <td>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">

                                             <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                   <i class="ri-more-fill"></i>
                                                </span>
                                                ${act}
                                             </div>
                                          </div>

                                       </td>
                                    </tr>`;
         }




         function setSelectBoxByText(eid, etxt) {

            var eid = document.getElementById(eid);
            for (var i = 0; i < eid.options.length; ++i) {
               if (eid.options[i].value === etxt)
                  eid.options[i].selected = true;
            }

         }


         function deleteThis(id) {

            HttpPost("/produit/collecte/delete", {
               id
            }).then((res) => {
               var json = res.data;
               if (json.status == 200) {
                  document.getElementById("xdiv").innerHTML = setErreur(false, json.message);
                  load();
               } else {
                  document.getElementById("xdiv").innerHTML = setErreur(true, json.message);
               }
            });
            
         }

         function validateThis(id) {
            HttpPost("/produit/collecte/validate", {
               id
            }).then((res) => {
               var json = res.data;
               if (json.status == 200) {
                  document.getElementById("xdiv").innerHTML = setErreur(false, json.message);
                  load();
               } else {
                  document.getElementById("xdiv").innerHTML = setErreur(true, json.message);
               }
            });

         }


         function loadCombo(id, liste = [], default_ = "") {
            var el = document.getElementById(id);
            el.innerHTML = `<option value="" selected>Select ${default_}</option>`;
            liste.forEach(element => {
               el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
            });
         }

         function loadComboList(id, liste = []) {
            var el = document.getElementById(id);
            el.innerHTML = `<option value="" selected>Select</option>`;
            liste.forEach(element => {
               el.innerHTML += `<option value="${element.designation}">${element.id}</option>`;
            });
         }

         function initForm() {
            document.getElementById("produit").value = "";
            document.getElementById("code_").value = "";
            document.getElementById("description_produit").value = "";
            idProd = "00";
            document.getElementById("txy").innerHTML = "";
            $('#blah').attr('src', '<?php url(); ?>views/images/defaultimg.jpeg');
         }
      </script>


      <?php include './views/components/link_flooter.php'; ?>

</body>


</html>