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
                           <h4 class="card-title">Liste des conseils</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">

                              <div class="form-group col-md-2">
                                 <select class="form-control mr-2 setcolor" id="produits" onchange="load(-1);">
                                 </select>
                              </div>
                              <div class="form-group col-md-2">
                                 <button id="btn_Send" class="btn btn-primary mr-2 setcolor" onclick="SendToAbonnees();">Envoyer aux abonnées</button>
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
                                          <th>Itineraire</th>
                                          <th>Information</th>
                                          <th>Code</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_conseil">

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
      <!-- Wrapper END -->
      <!-- Footer -->

      <!-- Footer END -->




      <?php include './views/stock/ajout_produit.php'; ?>
      <?php include './views/stock/ajout_categorie.php'; ?>
      <?php include './views/stock/add_unite.php'; ?>

      <!-- Ajout Produit -->



      <script>
         var list_marches = [];
         var all_collecte = [];
         var list_produits = [];
         var all_marches = [];
         var list_conseils = [];
         loadCombo("produits", [], 'Produit');
         load();

         var current_produit = null;

         function load() {
            current_produit = $("#produits").val();

            HttpPost("/conseil/agricole", {
               produit: current_produit
            }).then((res) => {
               var json = res.data;
               list_produits = json.data.produit;
               list_conseils = json.data.conseil;

               chargement();
               loadCombo("produits", list_produits, 'Produit');
               setSelectBoxByText("produits", current_produit);
            });


         }

         function chargement() {

            var tab = document.getElementById("tab_conseil");
            tab.innerHTML = "";
            var x = 1;
            list_conseils.forEach(element => {
               tab.innerHTML += setElements(x, element);
               x++;
            });

         }


         function setElements(x, element) {

            return `<tr>
                                       <td>${x}</td>                    
                                       <td>${element.itineraire}</td> 
                                       <td>${element.texte}</td>
                                       <td>${element.id}</td>  
                                       <td>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">

                                             <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                   <i class="ri-more-fill"></i>
                                                </span>
                                                
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


         function SendToAbonnees() {

            HttpPost("/conseils/send-to-all", {
               
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
      </script>


      <?php include './views/components/link_flooter.php'; ?>

</body>


</html>