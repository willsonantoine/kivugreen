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
                            <h4 class="card-title">Liste des membres</h4>
                         </div>
                      </div>
                      <div class="iq-card-body">
                         <div class="row">
                            <div class="col-md-8">
                               <div class="row">
                                  <div class="form-group col-md-3 ">
                                     <select class="form-control setcolor" id="type_filtre" onchange="loadProdByType();">
                                        <option value="all">Select type</option>
                                        <option value="Agriculteur">Agriculteur</option>
                                        <option value="Vendeur">Vendeur</option>
                                        <option value="Acheteur">Acheteur</option>
                                        <option value="Agent">Utilisateur/Agent</option> 
                                        <option value="Default">Default</option>
                                     </select>
                                  </div>
                                  <div class="form-group col-md-3 ">
                                     <input list="fonction_list_filter" id="categorie_filtre" class="form-control setcolor" onchange="loadProdByCategorie();" placeholder="Select fonction">
                                     <datalist id="fonction_list_filter">

                                     </datalist>
                                  </div>

                                  <div class="form-group col-md-3">
                                     <input type="text" id="txt_recherche" value="" class="form-control setcolor" placeholder="Rechercher ici ... ">
                                  </div>

                                  <div class="form-group col-md-2">
                                     <input type="button" onclick="loadProdByRecherche();" value="Rechercher" class="btn btn-primary mr-2">
                                  </div>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div class="row">

                                  <div class="form-group col-md-6">
                                     <input type="text" id="txt_recherche_id" value="" class="form-control setcolor" onkeyup="loadProdByRechercheById();" placeholder="Par ID ">
                                  </div>

                                  <div class="form-group col-md-4 dropdown">
                                     <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                        <button type="button" onclick="loadProdByRecherche();" value="Rechercher" class="btn btn-primary mr-2">Parametres</button>
                                     </span>
                                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add_user_membre" onclick="initForm()">
                                           <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nouvelle Identification
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add_user_membre_categorie">
                                           <i class="fa fa-address-book-o" aria-hidden="true"></i></i>&nbsp;&nbsp;Fonction ou Groupe
                                        </a>

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statistiques">
                                           <i class="fa fa-window-restore" aria-hidden="true"></i>&nbsp;&nbsp;Type d'identification
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target=".statistiques">
                                           <i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;&nbsp;Statistiques
                                        </a>

                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div id="xdiv"></div>
                         <div class="row">
                            <div class="col-md-12">
                               <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                  <thead>
                                     <tr>
                                        <th>Profile</th>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Genre</th>
                                        <th>Age</th>
                                        <th>Adresse</th>
                                        <th>Enreg Date</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody id="tab">


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



    <?php include './views/auth/generate_qr_code.php'; ?>
    <?php include './views/auth/add_user_membre.php'; ?>
    <?php include './views/auth/add_user_membre_categorie.php'; ?>
    <?php include './views/sms/send-sms.php'; ?>
    <?php include './views/auth/access_users.php'; ?>
    <?php include './views/auth/statistiques.php'; ?>


    <!-- Ajout Produit -->

    <script>
       function setxxs(id) {
          id_categ = id;
       }

       var current_date = null;
       var liste_membres = [];
       var liste_access = [];
       var liste_access_users = [];
       var liste_cooperative = [];

       load();
       loadCategorie_1();

       var id_categ = "00";

       function loadCombo(id, liste = [], isInvese = false) {

          var el = document.getElementById(id);
          el.innerHTML = `<option value="all" selected>Select fonction</option>`;
          liste.forEach(element => {
             if (!isInvese) {
                el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
             } else {
                el.innerHTML += `<option value="${element.designation}">${element.id}</option>`;
             }

          });
       }

       function sendCateg() {
          HttpPost("/users-create-categ", {
             id: id_categ,
             designation: document.getElementById("designation_categ").value,
             description: document.getElementById("description_categ").value,
          }).then((res) => {
             var json = res.data.data;
             if (res.data.status == 200) {
                document.getElementById("designation_categ").value = "";
                document.getElementById("description_categ").value = "",
                   id_categ = "00";
                loadCategorie_1();
                document.getElementById("txyx").innerHTML = setErreur(false, res.data.message);
             } else {
                document.getElementById("txyx").innerHTML = setErreur(true, res.data.message);
             }
          });
       }

       var all_categorie = [];

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
          loadCombo("categorie_membre", all_categorie);

       }


       function loadCategorie_1() {

          HttpPost("/loadCateg-membres").then(function(response) {
             var json = response.data;
             all_categorie = json.data;
             document.getElementById("fonction_list").innerHTML = setListe(all_categorie);
             document.getElementById("fonction_list_filter").innerHTML = setListe(all_categorie);
             loadCateg();
          });
       }

       function deleteMembre(id) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cette identification ?")) {
             HttpPost("/membres/delete", {
                id
             }).then(function(response) {
                var json = response.data;
                if (json.status == 200) {
                   location.reload();
                } else {
                   alert(json.message);
                }
             });
          }

       }

       var all_users = [];

       function getIdUser(id_membre) {
          var i = null;
          all_users.forEach(element => {
             if (id_membre == element.id_membre) {
                i = element.id;
             }
          });
          return i;
       }

       function load() {

          HttpPost("/membre", {}).then(function(response) {
             var json = response.data;
             access_files = url_base + json.file_folder;
             liste_membres = json.data.membres;
             current_date = json.data.current_date;
             all_users = json.data.users;
             liste_access = json.data.access;
             liste_access_users = json.data.access_users;
             liste_cooperative = json.data.cooperatives;
             all_stat = json.data.stat;
             max = json.data.max;

             $("#num_id").val(json.data.id);

             if (current_type != null) {
                setSelectBoxByText("type_filtre", current_type)
             }

             loadCombo("cooperative_list", liste_cooperative, true);
             loadProdByType()
             load_liste_access();
             loadStat();

          }).catch(function(err) {
             console.log(err.message);
             document.getElementById("txy").innerHTML = setErreur(true, err.message);
             if (err.message == "Request failed with status code 401") {
                window.location.href = "../login";
             }
          });
       }

       function setListe2(liste = []) {
          var liste_element = "";
          liste.forEach(element => {
             liste_element.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
          });
          return liste_element;
       }


       function load_liste_access() {
          var tab_interfaces = document.getElementById("tab_interfaces");
          var tab_taches = document.getElementById("tab_taches");
          var tab_operations = document.getElementById("tab_operations");
          tab_operations.innerHTML = "";
          tab_interfaces.innerHTML = "";
          tab_taches.innerHTML = "";
          liste_access.forEach(element => {
             if (element.type == 'interface') {
                tab_interfaces.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }
             if (element.type == 'tache') {
                tab_taches.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }
             if (element.type == 'operation') {
                tab_operations.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }

          });
       }

       function loadList(params) {
          var tab = document.getElementById("tab");
          tab.innerHTML = "";
          var i = 0;
          liste_membres.forEach(element => {
             if (i < 100) {
                tab.innerHTML += getElement(element);
                i++
             }
          });
       }

       function getElement(element) {
          var img = './<?php url(); ?>views/images/defaultuser.png';

          if (element.img != null) {
             img = access_files + element.img;
          }

          var age = "-";
          if (element.date_birth != null) {
             age = DateDiff(element.date_birth, current_date);
             age = parseInt(age / 360);
          }

          var etat = getEtat(element.id);
          var etat_validator = getEtat_validator(element.id);

          var str_etat = true;
          if (etat == 0) {
             str_etat = false;
          }
          var str_etat_validator = true;
          if (etat_validator == 0) {
             str_etat_validator = false;
          }

          var str_on_web = (element.on_web == 1);

          var isAC = (isAccess) ? `<a class="dropdown-item" href="#" onclick="load_liste_access();selectAccess('${element.id}');document.getElementById('id_user_access').value ='${element.id}'; document.getElementById('customSwitch1').checked = ${str_etat};document.getElementById('show_on_web').checked = ${str_on_web};document.getElementById('validateur1').checked = ${str_etat_validator};document.getElementById('all').innerHTML='';" data-toggle="modal" data-target=".access-users"  >
                                 <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Gérer les access pour cette personne
                              </a>` : '';
          var isSM = (isSendSMS) ? `<a class="dropdown-item" data-toggle="modal" data-target=".send-sms" onclick='selectVal("${element.id}","${element.phone}");document.getElementById("show-error").innerHTML="";'   href="#">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Envoyer un sms
                              </a>` : '';

          return `
                   <tr>
                        <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>
                        <td><span class="badge badge-primary">${element.id_compte}</span></td>
                        <td>${element.fullname}</td>
                        <td>${element.phone}</td>
                        <td>${element.mail}</td>
                        <td>${element.gender}</td>
                        <td>${age} ans</td>
                        <td>${element.adress}</td> 
                        <td>${element.date_adhesion}</td> 
                        <td> 
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    
                                    <a class="dropdown-item"  href="#" data-toggle="modal" data-target="#add_user_membre" onclick="selectV('${element.id}');">
                                       <i class="ri-pencil-line"></i>&nbsp;&nbsp;Modifier
                                    </a>
                                    <a class="dropdown-item"  href="<?php url(); ?>admin/show-profil/${element.id}">
                                       <i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Afficher le profil complet
                                    </a>
                                    ${isSM}
                                    ${isAC}
                                    <a onclick="deleteMembre('${element.id}')" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#">
                                       <i class="ri-delete-bin-line"></i>&nbsp;&nbsp;Supprimer
                                    </a>

                                    <a class="dropdown-item" href="#" onclick="generateQrCode('${element.id_compte}','${element.fullname}');" data-toggle="modal" data-target="#generate_qr_code">
                                       <i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp;&nbsp;Générer le code QR
                                    </a>
                                  
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>`;
       }

       function getEtat(params) {
          var etat = 0;

          all_users.forEach(element => {
             if (params == element.id_membre) {
                etat = element.etat;
             }
          });

          return etat;
       }

       function getEtat_validator(params) {
          var etat = 0;
          all_users.forEach(element => {
             if (params == element.id_membre) {
                etat = element.is_validator;
             }
          });
          return etat;
       }

       function getEtat(params) {
          var etat = 0;
          all_users.forEach(element => {
             if (params == element.id_membre) {
                etat = element.etat;
             }
          });
          return etat;
       }

       function getEtat_validator(params) {
          var etat = 0;
          all_users.forEach(element => {
             if (params == element.id_membre) {
                etat = element.is_validator;
             }
          });
          return etat;
       }

       function selectV(params) {
          liste_membres.forEach(element => {

             if (element.id == params) {

                $("#id").val(params);
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

                var img = '<?php url(); ?>views/images/defaultuser.png';

                if (element.img != null) {
                   img = access_files + element.img;
                }

                $('#blah').attr('src', img);
                document.getElementById("txy").innerHTML = "";
             }
          });
       }

       function DateDiff(date1, date2) {

          if (date2 == null) {
             date2 = date1;
          }

          var d1 = new Date(date1);
          var d2 = new Date(date2);
          return parseInt((d2 - d1) / (1000 * 60 * 60 * 24), 10);
       }

       function setSelectBoxByText(eid, etxt) {

          var eid = document.getElementById(eid);
          for (var i = 0; i < eid.options.length; ++i) {
             if (eid.options[i].value === etxt)
                eid.options[i].selected = true;
          }

       }

       function initForm() {
          $("#id").val("00");
          $("#nom").val("");
          $("#genre").val("");
          $("#etatcivil").val("");
          $("#tel").val("");
          $("#email").val("");
          $("#datenaiss").val("");
          $("#lieunaiss").val("");
          $("#nationalite").val("");
          $("#carteid").val("");
          $("#adresse").val("");
          $("#myfile").val("");
          $("#type").val("");
          $("#categorie_membre").val("");
          $('#blah').attr('src', "<?php url(); ?>views/images/defaultuser.png");

          document.getElementById("txy").innerHTML = "";
       }

       function loadProdByRechercheById() {

          var txt_recherche = document.getElementById("txt_recherche_id").value;

          var tab = document.getElementById("tab");
          tab.innerHTML = "";
          var data_filter = liste_membres;


          data_filter = liste_membres.filter(element => element.id_compte == txt_recherche);


          data_filter.forEach(element => {
             tab.innerHTML += getElement(element);

          });
       }

       function loadProdByRecherche() {
          var txt_recherche = document.getElementById("txt_recherche").value;

          if (txt_recherche.length > 0) {
             var tab = document.getElementById("tab");
             tab.innerHTML = "";

             var data_filter = liste_membres.filter(element => (element.fullname.toLowerCase().indexOf(txt_recherche.toLowerCase()) !== -1));


             data_filter.forEach(element => {

                tab.innerHTML += getElement(element);

             });
          }

       }

       function loadProdByCategorie() {

          var categorie = document.getElementById("categorie_filtre").value;
          var type = document.getElementById("type_filtre").value;

          var tab = document.getElementById("tab");
          tab.innerHTML = "";
          liste_membres.forEach(element => {

             if (categorie == element.id_categ && type == element.type) {
                tab.innerHTML += getElement(element);
             } else if (categorie == "all") {
                tab.innerHTML += getElement(element);
             }
          });
       }

       var current_type = null;

       function loadProdByType() {

          current_type = document.getElementById("type_filtre").value;

          var tab = document.getElementById("tab");
          tab.innerHTML = "";
          var i = 0;
          liste_membres.forEach(element => {
             if (i < 50) {
                if (current_type == element.type) {
                   tab.innerHTML += getElement(element);
                } else if (current_type == "all") {
                   if (element.type != 'Default') {
                      tab.innerHTML += getElement(element);
                   }

                }
                i++;
             }
          });
       }

       function load_liste_access() {
          var tab_interfaces = document.getElementById("tab_interfaces");
          var tab_taches = document.getElementById("tab_taches");
          var tab_operations = document.getElementById("tab_operations");
          tab_operations.innerHTML = "";
          tab_interfaces.innerHTML = "";
          tab_taches.innerHTML = "";

          liste_access.forEach(element => {
             if (element.type == 'interface') {
                tab_interfaces.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }
             if (element.type == 'tache') {
                tab_taches.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }
             if (element.type == 'operation') {
                tab_operations.innerHTML += `<div class="custom-control col-md-12 custom-switch">
                                    <input type="checkbox" class="custom-control-input" onchange="setAccess('${element.id}');" id="access_${element.id}">
                                    <label class="custom-control-label" for="access_${element.id}">${element.designation} </label>
                                </div>`;
             }

          });
       }

       document.getElementById("date_adhesion").valueAsDate = new Date();
    </script>

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