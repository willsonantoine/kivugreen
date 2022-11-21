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
                                          <input type="date" id="date" class="form-control setcolor">
                                       </div>
                                       <div class="form-group col-md-2">
                                          <select class="form-control mr-2 setcolor" id="zones" onchange="loadProd(document.getElementById('categorie_filtre').value);">
                                          </select>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <input type="text" id="txt_recherche" value="" class="form-control mr-2 setcolor" placeholder="Rechercher ici ... ">
                                       </div>

                                       <div class="form-group col-md-2">
                                          <input type="button" onclick="load(document.getElementById('txt_recherche').value);" value="Rechercher" class="btn btn-primary mr-2">
                                       </div>
                                       <div class="form-group col-md-3">
                                          <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input" onchange="setValidateur();" id="non_validee">
                                             <label class="custom-control-label" for="mon_validee">Informations non validée </label>
                                          </div>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input" onchange="setValidateur();" id="validateur1">
                                             <label class="custom-control-label" for="validateur1">Informations validée </label>
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
                                          <th>Code</th>
                                          <th>Catégorie</th>
                                          <th>Description</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_produit">

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
         var all_produits = []; 
         var all_zones = [];

         load();

         function loadCateg() {

            var tab_categ = document.getElementById("tab_categ");
            tab_categ.innerHTML = "";
            var xx = 1;
            all_categorie.forEach(element => {
               var designation = element.designation;
               var description = element.description;
               var id = element.id;

               tab_categ.innerHTML += ` <tr>
                                          <td>${xx}</td>
                                          <td>${designation}</td>
                                          <td>${description}</td>
                                          <td>
                                             <div class="flex align-items-center list-user-action">
                                                <a class="iq-bg-primary" data-placement="top" title="" data-original-title="Modifier" href="#" onclick=" setxxs('${id}'); document.getElementById('designation_categ').value='${designation}'; document.getElementById('description_categ').value='${description}';">
                                                   <i class="ri-pencil-line"></i>
                                                </a>
                                                <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')){delete_categorie('${element.id}')} "><i class="ri-delete-bin-line"></i></a>
                                             </div>
                                          </td>
                                       </tr>`;
               xx++;


            });

            loadCombo("categorie_filtre", all_categorie);
            loadCombo("categorie_produit", all_categorie);


         }

         function load(search = null, categorie = null) {

            HttpPost("/produits-load", {
               search,
               categorie
            }).then((res) => {
               var json = res.data.data;
               all_categorie = json.categories;
               all_produits = json.produits;
               all_unite = json.all_zones;
               access_files = url_base + res.data.file_folder;
               loadCateg();
               loadProd();
               loadUnite();
               loadCateg();
            });
         }

         function loadProd(categ = null) {
            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            var xs = 1;
            all_produits.forEach(element => {
               if (categ == null || categ == '') {
                  tab.innerHTML += setElements(xs, element);
               } else {
                  if (categ == element.id_categorie) {
                     tab.innerHTML += setElements(xs, element);
                  }
               }
               xs++;
            });
         }


         function setElements(x, element) {


            var img = './<?php url(); ?>views/images/defaultimg.jpeg';

            if (element.img != null) {
               img = access_files + element.img;
            }

            return `<tr>
                                       <td>${x}</td>
                                       <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>                      
                                       <td>${element.produit}</td> 
                                       <td>${element.code}</td>
                                       <td>${element.categorie}</td> 
                                       <td>${element.description}</td>
                                       <td>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">

                                             <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                   <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  
                                                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProduit" onclick='showModifier("${element.id}");'>
                                                      <i class="ri-delete-bin-6-fill mr-2"></i>Modifier
                                                   </a>
                                                   <a class="dropdown-item" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce produit')){deleteThis('${element.id}')} ">
                                                      <i class="ri-pencil-fill mr-2">
                                                      </i>Supprimer
                                                   </a>
                                                    
                                                </div>
                                             </div>
                                          </div>

                                       </td>
                                    </tr>`;
         }

         function setxxs(id) {
            id_categ = id;
         }

         var idProd = "00";

         function showModifier(id) {

            document.getElementById("txy").innerHTML = "";
            idProd = id;
            all_produits.forEach(element => {

               if (id == element.id) {

                  document.getElementById("produit").value = element.produit;
                  document.getElementById("code_").value = element.code;
                  document.getElementById("description_produit").value = element.description;
                  setSelectBoxByText("categorie_produit", element.categorie);

                  var img = '<?php url(); ?>views/images/defaultimg.jpeg';
                  if (element.img != null) {
                     img = access_files + element.img;
                  }
                  $('#blah').attr('src', img);
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


         function deleteThis(id) {
            HttpPost("/produit/delete", {
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


         function loadCombo(id, liste = []) {
            var el = document.getElementById(id);
            el.innerHTML = `<option value="" selected>Select catégorie</option>`;
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