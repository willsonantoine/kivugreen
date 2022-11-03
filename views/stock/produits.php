<?php $menus = "produit"; ?>

<?php include './views/components/link_header.php'; ?>

</head>

<style>
   input[type=text] {
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
                           <h4 class="card-title">Liste des produits</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <div class="row" style="padding-left: 20px;">
                                       <select class="form-control col-md-4 mr-2" id="categorie_filtre" onchange="loadProdByCategorie();">
                                       </select>
                                       <div class="form-group col-md-4">
                                          <input type="text" id="txt_recherche" value="" class="form-control mr-2" placeholder="Rechercher ici ... ">
                                       </div>
                                       <div class="form-group col-md-2">
                                          <input type="button" onclick="rechercher();" value="Rechercher" class="btn btn-primary mr-2">
                                       </div>
                                    </div>

                                 </div>
                              </div>

                              <div class="col-sm-3 col-md-3">
                                 <div class="user-list-files d-flex float-right">
                                    <a href="#" class="iq-bg-primary" data-toggle="modal" data-target="#addProduit">
                                       Nouveau produit
                                    </a>
                                    <a class="iq-bg-primary" href="#" data-toggle="modal" data-target="#addCategorie">
                                       Catégorie produit
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div id="xdiv"></div>
                           <div class="row">
                              <div class="col-md-8">
                                 <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                       <tr>
                                          <th>N°</th>
                                          <th>Designation</th>
                                          <th>Qte</th>
                                          <th>Prix Min</th>
                                          <th>Prix Max</th>
                                          <th> </th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="tab_produit">

                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-4">
                                 <br>
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title" id="titre">Nom du produit </h4>
                                          <h6 id="catego_txt"></h6>
                                       </div>
                                       <div class="iq-card-header-toolbar d-flex align-items-center">
                                          <div class="dropdown">
                                             <span class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                       <div class="table-responsive">
                                          <table class="table mb-0 table-borderless" id="tab_">

                                          </table>
                                       </div>
                                    </div>

                                 </div>
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
      <?php include './views/stock/add_approvisionnement.php'; ?>

      <!-- Ajout Produit -->



      <script>
         var all_categorie = [];
         var all_produits = [];
         var all_succursale = [];
         var all_fournisseur = [];

         load();

         function viewProduit(id) {

            HttpPost("/produit/loadbyid", {
               id
            }).then(function(response) {
               var json = response.data.data;

               var tab = document.getElementById("tab_");
               tab.innerHTML = "";
               var nom = null;
               var descr = null;
               var entrep = [];
               json.detailles_stock.forEach(element => {
                  if (!entrep.includes(element.entreprise)) {
                     tab.innerHTML += getTitle(element);
                     entrep.push(element.entreprise);
                  }
                  tab.innerHTML += get_ligne(element);
                  nom = element.produit;
                  descr = element.description;
               });
               tab.innerHTML += `</tbody>`;

               if (nom != null) {
                  $("#titre").html(nom);
                  $("#catego_txt").html(descr);
               } else {
                  $("#titre").html(`<a style="color:red;">Le stock est vide</a>`);
                  $("#catego_txt").html("");
               }

            });

         }

         function getTitle(element) {

            return `
                  <hr>
                  <thead>
                     <tr>
                        <th scope="col">${element.entreprise}</th>
                        <th scope="col">QE</th>
                        <th scope="col">Qte Dispo</th>
                     </tr>
                  </thead>
                  <tbody>                 
            `;
         }

         function get_ligne(element) {
            return `
                  <tr>
                     <td>${element.date_validate}</td>
                     <td>${element.qe}</td>
                     <td><span class="badge badge-primary">${element.qte_dispo}</span> <strong>[${element.barcode}]</strong></td>
                  </tr>
            `;
         }


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
                                                <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')){} "><i class="ri-delete-bin-line"></i></a>
                                             </div>
                                          </td>
                                       </tr>`;
               xx++;


            });

            loadCombo("categorie_filtre", all_categorie);
            loadCombo("categorie_produit", all_categorie);
            loadCombo("entrep", all_succursale);
            loadComboList("list_fournisseur", all_fournisseur);

            document.getElementById("numero").value = "31" + all_produits.length;
         }

         function load() {

            HttpPost("/produits-load", {}).then((res) => {
               var json = res.data.data;
               all_categorie = json.categories;
               all_produits = json.produits;
               all_succursale = json.succursale;
               all_fournisseur = json.fournisseur;
               access_files = url_base + res.data.file_folder;
               
               loadCateg();
               loadProd();
               $("#barcode").val(json.barcode);
            });
         }

         function calc() {
            var qte = document.getElementById("qte").value;
            var count = document.getElementById("cout").value;
            console.log((count * qte));
            document.getElementById("cout_total").value = (count * qte);
         }

         function rechercher() {
            var txt_recherche = document.getElementById("txt_recherche").value;
            txt_recherche = txt_recherche.toUpperCase();
            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            var xs = 0;
            all_produits.forEach(element => {
               if (element.produit.toUpperCase().includes(txt_recherche) || element.categorie.toUpperCase().includes(txt_recherche) || element.description.toUpperCase().includes(txt_recherche)) {
                  tab.innerHTML += setElements(element);
               }

            });
         }

         function loadProd() {
            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            var xs = 0;
            all_produits.forEach(element => {
               if (xs <= 100) {
                  tab.innerHTML += setElements(element);
               }
               xs++;
            });
         }

         function setV(id, designation) {
            idProd = id;
            $("#produit_").val(designation);
         }

         function loadProdByCategorie() {
            var categorie = document.getElementById("categorie_filtre").value;

            var tab = document.getElementById("tab_produit");
            tab.innerHTML = "";
            all_produits.forEach(element => {

               if (categorie == element.id_categorie) {
                  tab.innerHTML += setElements(element);
               }
            });
         }

         function setElements(element) {
            var etat = 'primary';
            if (parseFloat(element.qte) <= parseFloat(element.qte_min)) {
               etat = 'danger';
            }

            var img = './<?php url(); ?>views/images/defaultuser.png';

            if (element.img != null) {
               img = access_files + element.img;
            }

            return `<tr>
                                       <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>
                                       <td>${element.id}</td>
                                       <td>${element.produit}</td>
                                       <td><span class="badge badge-${etat}">${element.qte}</span></td>
                                       <td>${element.prix_min}</td>
                                       <td>${element.prix}</td> 
                                       <td><div class="flex align-items-center list-user-action">
                                          <a class="iq-bg-primary"  href="#" onclick="viewProduit('${element.id}');" >
                                                <i class="fa fa-eye"></i>
                                          </a> 
                                       </div></td>
                                       <td>
                                          <div class="iq-card-header-toolbar d-flex align-items-center">

                                             <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                   <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                   <a class="dropdown-item" href="#" onclick='setV("${element.id}","${element.produit}");' data-placement="top" data-original-title="Approvisionnement" data-toggle="modal" data-target="#approvisionnement">
                                                   <i class="fa fa-plus mr-2" aria-hidden="true"></i>Approvisionnement
                                                   </a>
                                                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProduit" onclick='showModifier("${element.id}","${element.produit}","${element.categorie}","${element.id_compte}","${element.qte_min}","${element.prix}","${element.prix_min}","${element.description}","${element.points}");'>
                                                      <i class="ri-delete-bin-6-fill mr-2"></i>Modifier
                                                   </a>
                                                   <a class="dropdown-item" href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce produit')){deleteThis('${element.id}')} ">
                                                      <i class="ri-pencil-fill mr-2">
                                                      </i>Supprimer
                                                   </a>
                                                   <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Mouvement du produit</a>
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

         function sendProd() {
            document.getElementById("txy").innerHTML = "";
            const formData = new FormData();
            const imagefile = document.querySelector('#myfile');

            formData.append("img", imagefile.files[0]);
            formData.append("id_prod", idProd);
            formData.append("produit", document.getElementById("produitv").value);
            formData.append("numero", document.getElementById("numero").value);
            formData.append("categorie", document.getElementById("categorie_produit").value);
            formData.append("pv", document.getElementById("pv").value);
            formData.append("pv_min", document.getElementById("qte_min").value);
            formData.append("qte_min", document.getElementById("pv_min").value);
            formData.append("description", document.getElementById("description_prod").value);
            formData.append("points", document.getElementById("points").value);
            formData.append("parms", id_auth);

            HttpPost("/produits-create", formData).then((res) => {

               var json = res.data;

               if (json.status == 200) {

                  if (idProd == "00") {

                     document.getElementById("txy").innerHTML = setErreur(false, json.message);
                     document.getElementById("produitv").value = "";
                     document.getElementById("numero").value = "";
                     document.getElementById("pv").value = "0";
                     document.getElementById("pv_min").value = "0";
                     document.getElementById("description_prod").value = "";
                     document.getElementById("qte_min").value = "0";
                     document.getElementById("points").value = "0";

                  } else {
                     idProd = "00";
                     $("#addProduit").modal('hide');
                  }

                  load();
               } else {
                  document.getElementById("txy").innerHTML = setErreur(true, json.message);
               }
            });



         }


         function showModifier(id, produit, categorie, numero, qte_min, prix, prix_min, description, points) {
            document.getElementById("txy").innerHTML = "";
            idProd = id;
            document.getElementById("produitv").value = produit;
            document.getElementById("numero").value = numero;
            document.getElementById("description_prod").value = description;
            document.getElementById("pv").value = prix;
            document.getElementById("pv_min").value = prix_min;
            document.getElementById("qte_min").value = qte_min;
            document.getElementById("points").value = points;

            setSelectBoxByText("categorie_produit", categorie);

         }


         function setSelectBoxByText(eid, etxt) {
            var eid = document.getElementById(eid);
            for (var i = 0; i < eid.options.length; ++i) {
               if (eid.options[i].text === etxt)
                  eid.options[i].selected = true;
            }
         }


         function sendApprov() {
            HttpPost("/produits/add/approvisionnement", {
               entrep: document.getElementById("entrep").value,
               produit: idProd,
               qte: document.getElementById("qte").value,
               cout: document.getElementById("cout").value,
               cout_total: document.getElementById("cout_total").value,
               fournisseur: document.getElementById("fournisseur").value,
               description: document.getElementById("description").value,
               date_exp: document.getElementById("date_exp").value,
               barcode: document.getElementById("barcode").value
            }).then((res) => {
               var json = res.data;

               if (json.status == 200) {
                  document.getElementById("tx").innerHTML = setErreur(false, json.message);
                  document.getElementById("qte").value = "0";
                  document.getElementById("cout").value = "0";
                  document.getElementById("cout_total").value = "0";
                  document.getElementById("description").value = "";
                  window.location.href = './approvisionnement';
               } else {
                  document.getElementById("tx").innerHTML = setErreur(true, json.message);
               }

            });

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

         var id_categ = "00";

         function sendCateg() {
            HttpPost("/produits-create-categ", {
               id: id_categ,
               designation: document.getElementById("designation_categ").value,
               description: document.getElementById("description_categ").value,
            }).then((res) => {
               var json = res.data.data;
               if (res.data.status == 200) {
                  document.getElementById("designation_categ").value = "";
                  document.getElementById("description_categ").value = "",
                     id_categ = "00";
                  load();
                  document.getElementById("txyx").innerHTML = setErreur(false, res.data.message);
               } else {
                  document.getElementById("txyx").innerHTML = setErreur(true, res.data.message);
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
      </script>


      <?php include './views/components/link_flooter.php'; ?>
      <script>
         loadCateg();
      </script>
</body>


</html>