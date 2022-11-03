<?php $menus = "produit"; ?>
<?php include './views/components/link_header.php'; ?>

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
                           <h4 class="card-title">Liste des produits en Stock</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <div class="row" style="padding-left: 20px;">
                                       <div class="form-group col-md-4">
                                          <input type="date" id="date" onchange="load();" class="form-control">
                                       </div>

                                    </div>

                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-6">
                                 <div class="user-list-files d-flex float-right">
                                    <a href="./produit" class="iq-bg-primary mr-4">
                                       Liste des produits
                                    </a>
                                    <a class="iq-bg-primary mr-4" href="./approvisionnement">
                                       Approvionnement
                                    </a>
                                    <a class="iq-bg-primary mr-4" href="#" onclick="cloture();">
                                       Cloture journalière
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="xdiv"></div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead>
                              <tr>
                                 <th>N°</th>
                                 <th>Designation</th>
                                 <th>Qte INITIALE</th>
                                 <th>Qte ENTREE</th>
                                 <th>Qte SORTIE</th>
                                 <th>Qte FINALE</th>
                                 <th>Mise en jour</th>
                                 <th>Qte DISPO</th>
                              </tr>
                           </thead>
                           <tbody id="tab_produit">


                           </tbody>
                        </table>
                     </div>
                     <div class="row justify-content-between mt-3">
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>


   <script>
      document.getElementById("date").valueAsDate = new Date();

      var all_produits = [];

      function loadProd() {

         var tab = document.getElementById("tab_produit");
         tab.innerHTML = "";
         var x = 1;
         all_produits.forEach(element => {

            tab.innerHTML += setElements(x, element);
            x++;
         });

      }

      function setElements(x, element) {
         return `<tr>
                                       <td>${x}</td>
                                       <td>${element.produit}</td>
                                       <td>${element.qi}</td>
                                       <td>${element.qe}</td>
                                       <td>${element.qs}</td>
                                       <td>${element.qf}</td>
                                       <td>${element.updateAt_time}</td> 
                                       <td><span class="badge badge-success"">${element.qte}</span></td> 
                                    </tr>`;
      }
 
      function load() {
         HttpPost("/produits/load-stock", {
            date: $("#date").val()
         }).then((res) => {
            var json = res.data;
            all_produits = json.data.stock;
            loadProd();
         });
      }

      function cloture() {
         HttpPost("/produits/cloture", {
            date: $("#date").val()
         }).then((res) => {
            var json = res.data;
            all_produits = json.data.stock;
            loadProd();
         });
      }

      load();
   </script>

<?php include './views/components/link_flooter.php'; ?>

</body>


</html>