<?php $menus = 'produit'; ?>
<?php include './views/components/link_header.php'; ?>
<style>
   input[type=text] {
      border-color: lightblue;
      color: black;
   }

   select[type=text] {
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
                           <h4 class="card-title">Approvisionnement</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">


                              <div class="col-sm-12 col-md-2">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <input type="date" class="form-control mb-0" id="date1" onchange="load();">
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-2 ">
                                 <div id="user_list_datatable_info" class="dataTables_filter" onchange="load();">
                                    <input type="date" class="form-control mb-0" id="date2">
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-2">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <select class="form-control mb-0" id="entrep" onchange="filtreByEntrep('entrep')">
                                       <option value="all">Toute les boutiques</option>

                                    </select>
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-2 mb-0">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <select class="form-control" id="categ" onchange="filtre('categ')">
                                       <option value="all">Tout les produits</option>

                                    </select>
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
                           <br>

                           <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                              <thead>
                                 <tr>
                                    <th>Etat</th>
                                    <th>Ref</th>
                                    <th>Designation</th>
                                    <th>QE</th>
                                    <th>Barcode</th>
                                    <th>Cout</th>
                                    <th>Fourinisseur</th>
                                    <th>Observation</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="tables">

                              </tbody>
                           </table>
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



   <?php include './views/dialog/transafert_produit.php' ?>


   <script>
      document.getElementById("date1").valueAsDate = new Date();
      document.getElementById("date2").valueAsDate = new Date();

      var list_produit = [];
      var list_categorie = [];
      var list_succursale = [];

      load();

      function load() {
         HttpPost("/produit/load-approvisionnement", {
            date1: $("#date1").val(),
            date2: $("#date2").val(),
         }).then((res) => {
            var json = res.data.data;
            if (res.data.status == 200) {
               list_categorie = json.categories;
               list_succursale = json.succursale;
               list_produit = json.produits;

               load_produit();
               loadCombo("categ", list_categorie);
               loadCombo("entrep", list_succursale);
               loadCombo("entrep_", list_succursale);
            } else {
               console.log("Empty list")
            }


         });
      }

      function loadCombo(id, liste = []) {
         var el = document.getElementById(id);
         el.innerHTML = `<option value="" selected>Select</option>`;
         liste.forEach(element => {
            el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
         });
      }

      function load_produit() {
         var tab = document.getElementById("tables");
         tab.innerHTML = "";
         list_produit.forEach(element => {
            tab.innerHTML += getElement(element);
         });
      }

      function getElement(element) {

         var id = element.id;
         var entreprise = element.entreprise;
         var produit = element.produit;
         var qe = element.qe

         var at = 'En cours';
         var ax = 'danger';
         var isV = false;
         var us = "";
         var ab = "";

         if (element.etat == 1) {
            at = 'Récue';
            ax = 'success';
            isV = true;
            us = ' Par <strong>' + element.user_validate + '</strong>';
            ab = 'Le ' + element.date_create;
         }

         var val = ``;
         if (element.etat == 0) {
            val = `<a class="dropdown-item" href="#" onclick='setVx("${id}");' data-placement="top" data-toggle="modal" data-target="#approvisionnement">
                         <i class="ri-add-box-line mr-2"></i>Valider approvisionnement
                   </a>`;
         }
         var val2 = ``;
         if (element.etat == 0) {
            val2 = `<a class="dropdown-item" href="#" onclick='deleteApprov("${id}");' data-placement="top" data-toggle="modal" data-target="#approvisionnement">
                         <i class="ri-add-box-line mr-2"></i>Supprimer
                   </a>`;
         }

         return `
                                    <tr>
                                       <td><span class="badge iq-bg-${ax}">${at}  ${ab} ${us}</span></td>
                                       <td>${id}</td>
                                       <td>${produit}</td>
                                       <td>${qe}</td> 
                                       <td>${element.barcode}</td>
                                       <td>${element.cout} ${element.devise}</td>
                                       <td>${element.fournisseur}</td>
                                       <td>${element.observation}</td>
                                       <td>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">

                                             <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                   <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right">  
                                                      ${val}          
                                                      <a class="dropdown-item" href="#" onclick='setVy("${id}","${produit}","${entreprise}","${qe}");' data-placement="top" data-original-title="transfert" data-toggle="modal" data-target="#transfert">
                                                         <i class="ri-share-line mr-2"></i>Transférer dans un autre boutique ou sicursale
                                                      </a>  
                                                      ${val2}
                                                </div>
                                             </div>
                                          </div>


                                       </td>
                                    </tr>`;
      }

      function setVx(params) {
         if (confirm("Êtes-vous sûr de pouvoir valider cet approvisionnement ?")) {
            HttpPost("/produits-approvisionnement-valisate", {
               id: params
            }).then((res) => {
               var json = res.data;
               if (json.status == 200) {
                  load();
               } else {
                  alert("Une erreur s'est produite");
               }
            });
         }

      }

      var appr = null;
      var qte = null;

      function setVy(id, produit, entreprise, qte_) {
         appr = id;
         qte = qte_;
         document.getElementById("produit_").value = produit;
         document.getElementById("boutique_").value = entreprise;
      }

      function filtreByEntrep(param) {
         var entrep = document.getElementById("entrep").value;
         var tab = document.getElementById("tables");
         tab.innerHTML = "";

         list_produit.forEach(element => {

            if (element.id_entrep == entrep) {
               tab.innerHTML += getElement(element);
            } else if (element.id_entrep == "all") {
               tab.innerHTML += getElement(element);
            }

         });

      }

      function filtre(param) {

         var categ = document.getElementById("categ").value;
         var entrep = document.getElementById("entrep").value;

         var tab = document.getElementById("tables");
         tab.innerHTML = "";

         list_produit.forEach(element => {

            if (element.id_categorie == categ && element.id_entrep == entrep) {
               tab.innerHTML += getElement(element);
            }

         });

      }

      function sendTransfert() {
         var quantite = document.getElementById('qte').value;

         HttpPost("/produits-transfert", {
            id_approv: appr,
            boutique: document.getElementById('entrep_').value,
            boutique_from: document.getElementById('boutique_').value,
            qte: quantite,
            description: document.getElementById('description').value,
         }).then((res) => {
            var json = res.data.data;
            if (res.data.status == 200) {
               document.getElementById('txx').innerHTML = setErreur(false, res.data.message);
               load();
            } else {
               document.getElementById('txx').innerHTML = setErreur(true, res.data.message);
            }

         });


      }
   </script>


 <?php include './views/components/link_flooter.php'; ?>

</body>


</html>