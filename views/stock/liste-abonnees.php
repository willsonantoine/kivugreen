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
                           <h4 class="card-title">Liste des abonnees</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                         

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
                                          <th>Nom complet</th>
                                          <th>Phone</th>
                                          <th>Packet</th>
                                          <th>Marches</th>
                                          <th>Produits</th>
                                          <th>Solde SMS</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_abonnee">

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
         var list_marches = [];
         var all_collecte = [];
         var list_produits = [];
         var all_marches = [];
         var list_abonnees = [];

         load();


         function load() {


            HttpPost("/abonnement/load", {

            }).then((res) => {
               var json = res.data;
               list_abonnees = json.data.abonnees;
               list_marches = json.data.marches;
               list_produits = json.data.produits;
               chargement();
            });
         }

         function chargement() {

            var tab = document.getElementById("tab_abonnee");
            tab.innerHTML = "";
            var xs = 1;
            list_abonnees.forEach(element => {
               tab.innerHTML += setElements(xs, element);
               xs++;
            });
         }


         function setElements(x, element) {


            var img = './<?php url(); ?>views/images/defaultuser.png';

            if (element.img != null) {
               img = access_files + element.img;
            }

            var marches = getAll_marches(element.id_marche);
            var produits = getAll_produits(element.id_produits);
           

            return `<tr>
                                       <td>${x}</td>
                                       <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>                      
                                       <td>${element.fullname}</td> 
                                       <td>${element.phone}</td>
                                       <td>${element.packet} (${element.packet_sms} SMS)</td> 
                                       <td>${marches}</td>
                                       <td>${produits}</td>
                                       <td>${element.solde_sms}</td>
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

         function getAll_marches(tab = []) {
            let text = "";
            var new_tab = JSON.parse(tab);
            new_tab.forEach(element => {
               text += `<span style="margin:5px;" class="badge badge-primary">${getValMarche(element)}</span>`;
            });

            return text;
         }

         function getAll_produits(tab = []) {
            let text = "";
            var new_tab = JSON.parse(tab);
            new_tab.forEach(element => {
               text += `<span style="margin:5px;" class="badge badge-primary">${getValProduit(element)}</span>`;
            });

            return text;
         }

         function getValMarche(id) {
            var el = "";
            list_marches.forEach(element => {
              
               if (id == element.id) {
                  el =  element.designation;
               }

            });
             return el;
         }
         function getValProduit(id) {
            var el = "";
            list_produits.forEach(element => {
              
               if (id == element.id) {
                  el =  element.designation;
               }

            });
             return el;
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