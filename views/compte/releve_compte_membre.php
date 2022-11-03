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
    <link href='<?php url(); ?>views/fullcalendar/core/main.css' rel='stylesheet' />
    <link href='<?php url(); ?>views/fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href='<?php url(); ?>views/fullcalendar/timegrid/main.css' rel='stylesheet' />
    <link href='<?php url(); ?>views/fullcalendar/list/main.css' rel='stylesheet' />

    <link rel="stylesheet" href="<?php url(); ?>views/css/flatpickr.min.css">
    <script src="<?php url(); ?>views/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/run.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/var.js"></script>
    <script type="text/javascript" src='<?php url(); ?>in/print/js/print.min.js'></script>


</head>
<style>
    .setcolor {
        border-color: #1D335A;
        color: black;
    }

    @media print {
        table {
            border: solid #000 !important;
            border-width: 1px 0 0 1px !important;
        }

        th,
        td {
            border: solid #000 !important;
            border-width: 0 1px 1px 0 !important;
        }
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
        <?php include './views/components/menus.php'; ?>

        <!-- TOP Nav Bar -->
        <?php include './views/components/barheader.php'; ?>
        <!-- TOP Nav Bar END -->

        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="form-group col-md-2">
                                <input type="number" class="form-control setcolor" id="id_compte">
                            </div>
                            <div class=" form-group col-md-2">
                                <input type="button" class="btn btn-primary" onclick="loadBy(document.getElementById('id_compte').value,'');" value="Charger">
                            </div>
                            <div class="form-group col-md-2" role="group">
                                <button id="btnGroupDrop1" type="button" onclick="printJS('printDiv', 'html');" class="btn btn-primary">
                                    Imprimer
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="tabx">

                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-body">

                                <div class="row" id="printDiv">
                                    <h4 class="card-title col-md-12">Etat de compte<a id="compte_x"></a></h4>
                                    <div class="col-md-3" id="tab-solde"></div>
                                    <div class="col-md-9">
                                        <div class="iq-card-body" id="tot_" style="text-align:center ;">

                                        </div>
                                        <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Type</th>
                                                    <th>Montant</th>
                                                    <th>Motif</th>
                                                    <th>Béneficiaire</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="listeop">

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
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>



    <script>
        var all_operations = [];
        var all_solde = [];
        var all_total = [];
        var list_membres = [];

        function loadBy(id_compte, compte) {

            HttpPost("/comptabilite/loadby/compte", {
                id_compte
            }).then((res) => {

                var data = res.data;

                all_operations = data.data.transactions;
                all_solde = data.data.solde;
                all_total = data.data.totals;


                loadOpperations(id_compte);
                loadSolde();
                loadTot();
                

            }).catch((error) => {
                console.log(error)
            });

        }


        function loadTot() {
            var tot = document.getElementById("tot_");
            tot.innerHTML = "";
            all_total.forEach(element => {
                var sty = "primary";
                switch (element.type) {
                    case 'SORTIE':
                        sty = "danger";
                        break;
                    case 'ENTREE':
                        sty = "success";
                        break;
                    case 'DEPOT':
                        sty = "success";
                        break;
                    case 'RETRAIT':
                        sty = "success";
                        break;
                    case 'CREDIT':
                        sty = "warning";
                        break;

                    default:
                        break;
                }
                tot.innerHTML += `
            <button type="button" class="btn mb-1 btn-outline-${sty} col-md-4" >
                   (${element.nombre})  ${element.type} 
                <span class="badge badge-${sty} ml-2">${element.montant}</span>
                <span class="badge badge-primary ml-2">${element.devise}</span>
            </button> `;
            });
        }

        function loadSolde() {

            var tab = document.getElementById("tab-solde");
            tab.innerHTML = `<div class="col-md-4 col-lg-12"><span>Solde disponible</span> </div><br>`;


            all_solde.forEach(element => {

                tab.innerHTML += `
                     <div class="col-md-4 col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height rounded">
                           <div class="iq-card-body">
                              
                              <div class="text-center">
                                 <h2>${element.solde} ${element.devise}</h2>
                                 <p class="mb-0">Mise en jour ${element.updateAt}</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     `;
            });
        }

        function loadOpperations(id_compte) {
            var listeop = document.getElementById("listeop");
            listeop.innerHTML = '';
            var compte = "";
            console.log(all_operations);
            all_operations.forEach(element => {
                compte = element.benefiaire;
                listeop.innerHTML += getElement(element.numero, element.type, element.montant, element.devise, element.motif, element.benefiaire, element.date_save, element.id);
            });
            
            $("#compte_x").html(` [  <strong>${compte} / ${id_compte}</strong>  ]`);
        }

        function getElement(numero, type, montant, devise, motif, beneficiaire, heur, id) {


            var e = "primary";
            if (type == "SORTIE") {
                e = "danger";
            }
            if (type == "CREDIT") {
                e = "warning";
            }
            if (type == "VENTE" || type == "PAYEMENT") {
                e = "primary";
            }
            if (type == "ENTREE") {
                e = "success";
            }
            if (type == "DEPOT") {
                e = "success";
            }
            return `<tr>
                  <td>${numero}</td>
                  <td><span class="badge badge-${e}">${type}</span></td>
                  <td>${montant} ${devise}</td>
                  <td>${motif}</td>
                  <td>${beneficiaire}</td>
                  <td>${heur}</td>
                  <td>
                    <a href="#" style="text-align:right;" onclick="delete_operation('${id}');"
                     <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    </td>
                </tr>`;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
    <script>
        function ExportData() {
            filename = 'RELEVE DE COMPTE.xlsx';

            var ws = XLSX.utils.json_to_sheet(tab_to_print);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, name_file);
            XLSX.writeFile(wb, filename);
        }
    </script>

</body>

</html>