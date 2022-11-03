<?php $menus = "produit"; ?>
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
               <div class="col-sm-4">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Groupes</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <p>La liste des groupes peut être organisée en fonction du contexte. Par exemple, des adresses, des zones, des domaines, ...</p>
                        <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb" id="all_group">

                           </ol>

                        </nav>

                        <div id="tab">

                        </div>
                        <br>

                        <a href="#" class="btn btn-success col-md-12" onclick="document.getElementById('txyx').innerHTML='';document.getElementById('tab_group').innerHTML = linkinfo; document.getElementById('id_parent').value='';" data-toggle="modal" data-target="#add_grouppe">Nouveau group</a>
                     </div>
                  </div>
               </div>
               <div class="col-sm-8">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Liste des membres par groupe</h4>
                        </div>
                     </div>

                     <div class="iq-card-body">
                        <div class="row" style="padding-left: 15px;">
                           <div class="col-md5-2">
                              <div class="custom-control custom-checkbox custom-control-inline">
                                 <input type="checkbox" class="custom-control-input" id="customCheck6">
                                 <label class="custom-control-label" onclick="selectAllVal()" for="customCheck6">Sélectionner tout</label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <h4 id="show-nombre"></h4>
                           </div>
                           <div class="col-md-3">
                              <input type="button" value="Envoyer un message" data-toggle="modal" data-target=".send-sms" class="btn btn-primary" onclick="document.getElementById('show-error').innerHTML='';">
                           </div>

                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead>
                              <tr>
                                 <th>Profile</th>
                                 <th>ID</th>
                                 <th>Nom</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Genre</th>
                                 <th>Adresse</th>
                                 <th>Action</th>
                                 <th>Select</th>
                              </tr>
                           </thead>
                           <tbody id="tableMembres">

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->

      <!-- Footer END -->


      <?php include './views/dialog/add_grouppe.php'; ?>
      <?php include './views/sms/send-sms.php'; ?>


      <!-- Ajout Produit -->

      <script>
         var current_date = null;
         var liste_membres = [];
         var liste_access = [];
         var liste_access_users = [];


         function sendGroupe() {
            HttpPost("/membres/groupe/create", {
               id: document.getElementById("id").value,
               id_parent: document.getElementById("groupe_parent").value,
               designation: document.getElementById("groupe_name").value,
               description: document.getElementById("groupe_description").value,
            }).then((res) => {
               var json = res.data.data;

               if (res.data.status == 200) {
                  document.getElementById("groupe_name").value = "";
                  document.getElementById("groupe_description").value = "";
                  loadGrouppes();
                  chargement(document.getElementById("id_parent").value);
                  document.getElementById("txyx").innerHTML = setErreur(false, res.data.message);
               } else {
                  document.getElementById("txyx").innerHTML = setErreur(true, res.data.message);
               }
            });
         }

         var list_group = [];
         var list_membres = [];
         loadGrouppes();

         function loadGrouppes() {
            HttpPost("/membres/groupe/load").then(function(response) {
               var json = response.data;
               list_group = json.data.groupes;
               list_membres = json.data.membres;
               chargement();
               load_table();
               load_membres(null);
            });
         }

         function load_membres(id) {
            tab_all_val = [];

            var tab = document.getElementById("tableMembres");
            tab.innerHTML = "";

            if (id != null) {
               tab_all_val = list_membres.filter(element => (element.id_territoire == id) || (element.id_chefferie == id) || (element.id_grouppement_clan == id));
            }


            tab_all_val.forEach(element => {

               tab.innerHTML += getElement_membre(element);
            });

         }

         var linkinfo = `<li class="breadcrumb-item"><a href="#" onclick="initLink(null);chargement(null);"><i class="ri-home-4-line mr-1 float-left"></i>Groupes</a></li>`;

         document.getElementById("all_group").innerHTML = linkinfo;

         function chargement(parent, group) {

            var tab = document.getElementById('tab');
            tab.innerHTML = "";
            list_group.forEach(element => {

               if (parent == element.id_parent) {

                  tab.innerHTML += getElement(element);

                  last_label = element.designation;

               }

            });


         }

         var tab_group = document.getElementById('all_group');
         var last_label = null;

         function selectGroup(id, group, id_parent, nom_groupe) {


            chargement(id);

            if (!tab_link_id.includes(id_parent)) {
               tab_link_element.push(addLink(id, group, id_parent, nom_groupe));
               tab_link_id.push(id_parent);
            }

            tab_group.innerHTML = linkinfo;
            var sx = 0;

            tab_link_id.forEach(element => {
               var index = sx;
               tab_group.innerHTML += tab_link_element[sx];
               tab_link.push(element);
               sx++;
            });

            $("#add_new").remove();

            tab_group.innerHTML += `<li id="add_new" class="breadcrumb-item"><a href="#" onclick="document.getElementById('txyx').innerHTML='';document.getElementById('id_parent').value='${id_parent}';setLabel('${nom_groupe}');" ; data-toggle="modal" data-target="#add_grouppe" style="color:red;">Ajouter</a></li>`;
            setParent(id_parent);
         }

         function initLink(index) {

            if (index == null || index == '') {
               tab_link_id = [];
               tab_link_element = [];
               tab_group.innerHTML = linkinfo;
            } else {
               var i = tab_link_id.indexOf(index);
               tab_link_element.splice(i);
               tab_link_id.splice(i);
            }


         }

         function setLabel(lab) {
            if (lab == last_label) {
               document.getElementById('groupe_name').value = "";
            } else {
               document.getElementById('groupe_name').value = last_label;
            }
         }

         var tab_link_element = [];
         var tab_link_id = [];
         var tab_link = [];

         function addLink(id, goup, id_parent, nom_groupe) {
            var count = getNumberValue(id);
            return `<li class="breadcrumb-item"><a href="#" onclick='initLink("${id}");selectGroup("${id}","${goup}","${id_parent}","${nom_groupe}");load_membres("${id}");'>${goup} (${count})</a></li>`;
         }

         function getElement(element) {

            var count = getNumberValue(element.id);
            var count_show = (count > 0) ? `<span class="badge badge-primary ml-2 text-right">${count}</span>` : '';
            return `
                        <button type="button" onclick='selectGroup("${element.id}","${element.description}","${element.id}","${element.designation}");load_membres("${element.id}");' class="btn mb-1 iq-bg-primary col-md-12 text-left">
                           >${element.designation} - ${element.description} ${count_show}
                        </button>
                        `;
         }

         function getNumberValue(params) {
            var x = 0;

            list_membres.forEach(element => {
               if ((element.id_chefferie == params) || (element.id_territoire == params) || (element.id_grouppement_clan == params)) {
                  x++;
               }
            });

            return x;
         }

         function del(arr = [], val) {
            for (var i = 0; i < arr.length; i++) {

               if (arr[i] === val) {
                  arr.splice(i, 1);
                  console.log("DELETED [" + val + "]");
                  i--;
               }
            }
            return arr;
         }

         function getUser(element) {
            var img = "<?php url(); ?>views/images/defaultuser.png";;
            if (element.img != null) {
               img = access_files + element.img;
            }
            return `<div class="d-flex align-items-center">
                            <div class="user-img img-fluid"><a href="#"><img src="${img}" class="rounded avatar-40"></a></div>
                            <div class="media-support-info ml-3">
                            <h5><a href="#">${element.nom}</a></h5>
                            <p class="mb-0 font-size-12">Phone : ${element.tel};Email : ${element.email}</p>
                            </div>
                        </div>
                        <hr>
                        `
         }

         function getElement_membre(element) {
            var img = './<?php url(); ?><?php url(); ?>views/images/defaultuser.png';

            if (element.img != null) {
               img = access_files + element.img;
            }

            var Checked = tab_selected_id.includes(element.id) ? 'Checked' : '';

            return `
                   <tr>
                        <td class="text-center"><img class="rounded img-fluid avatar-40" src="${img}" alt="profile"></td>
                        <td><span class="badge badge-primary">${element.id_compte}</span></td>
                        <td>${element.fullname}</td>
                        <td>${element.phone}</td>
                        <td>${element.mail}</td>
                        <td>${element.gender}</td>
                        <td>${element.adress}</td>   
                        <td>
                           
                           <div class="flex align-items-center list-user-action">  
                              <a class="iq-bg-primary"  href="<?php url(); ?>admin/show-profil/${element.id}">
                              <i class="fa fa-address-card" aria-hidden="true"></i>
                              </a>
                              <a onclick="deleteMembre('${element.id}')" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#">
                                 <i class="ri-delete-bin-line"></i>
                              </a>
                           </div>
                        </td>
                        <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                                 <input type="checkbox" class="custom-control-input" ${Checked} id="select_${element.id}" >
                                 <label class="custom-control-label" onclick='selectVal("${element.id}","${element.phone}");document.getElementById("show-error").innerHTML="";' for="select_${element.id}">Select</label>
                              </div>
                        </td>
                     </tr>`;
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

         function load_table() {

            var table = document.getElementById("tab_groupe");
            table.innerHTML = "";
            var ex = 1;
            list_group.forEach(element => {
               table.innerHTML += `
               <tr id='ligne${element.id}'> 
                  <td>${ex}</td> 
                  <td>${element.description}</td> 
                  <td>${element.createAt}</td>
                  <td>
                     <div class="flex align-items-center list-user-action">
                        <a class="iq-bg-primary" data-placement="top" title="Modifier" data-original-title="Modifier" href="#" 
                        onclick='selectClasse("${element.id}");'>
                           <i class="ri-pencil-line"></i>
                           </a>
                           <a class="iq-bg-primary" data-placement="top" title="Supprimer" data-original-title="Supprimer" href="#" 
                        onclick='deleteClasse("${element.id}","ligne${element.id}");'>
                        <i class="ri-delete-bin-line"></i>
                           </a>
                     </div>
                  </td>
               </tr>
               `;
               ex++;
            });

            setParent(null);
         }
         var list_parent = [];

         function setParent(parameters) {

            list_group.forEach(element => {
               if (element.id_parent == parameters) {
                  list_parent.push(element);
               }
            });

            document.getElementById("groupe_parent").innerHTML = `<option value="null">Principal</option>` + setListeCombo(list_parent);
         }

         function setListeCombo(liste = []) {
            var liste_element = "";
            var tempo = [];
            liste.forEach(element => {

               if (!tempo.includes(element.id)) {
                  liste_element += `<option value="${element.id}">${element.designation}</option>`;
                  tempo.push(element.id);
               }

            });
            return liste_element;
         }
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