<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FinDash</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php url(); ?>views/images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php url(); ?>views/css/responsive.css">
    <script src="<?php url() ?>views/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>
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
    <!-- Sign in Start -->
    <section class="sign-in-page">
        <div id="container-inside">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
        </div>
        <div class="container p-0">
            <div class="row no-gutters height-self-center">
                <div class="col-sm-12 align-self-center bg-primary rounded">
                    <div class="row m-0">
                        <div class="col-md-12 bg-white sign-in-page-data">
                            <div class="sign-in-from">
                                <img src="<?php url() ?>views/images/imagekg.webp" height="60">
                                <h5 style="font-size: 20px ;" class="text-center text-dark">Abonnement aux conseils agricole</h5>
                                <form class="mt-4">

                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <label for="marche">Numéro de téléphone</label>
                                            <input type="phone" class="form-control setcolor" id="phone" placeholder="+24300000000">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="marche">Liste des produits</label>
                                            <select class="form-control setcolor" multiple id="produit" onchange="">
                                            </select>
                                        </div>

 
                                        <div class="form-group col-md-4">
                                            <label for="marche">Langue</label>
                                            <select class="form-control setcolor" id="langue" onchange="">
                                                <option value="">Select langue</option>
                                                <option value="Francais">Francais</option>
                                                <option value="Swahili">Swahili</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div id="infos"></div>
                                    <div class="sign-info text-center">
                                        <button type="button" id="log" class="btn btn-primary d-block w-100 mb-2" onclick="save()">Ajouter</button>
                                    </div>
                                    <div class="sign-info text-center">
                                        <a href="<?php url(); ?>admin/home">Quitter</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var list_produits = [];
        var list_marches = [];
        var list_packets = [];

        load_init();

        function save() { 
            var produit = $("#produit").val();
            var langue = $("#langue").val();

            if (produit.length > 0) {

                HttpPost("/conseil/create-abonnement", {
                    phone: $("#phone").val(),
                    langue: langue,
                    produit: $("#produit").val(),
                }).then(function(res) {
                    var json = res.data;
                    document.getElementById("infos").innerHTML = setErreur((json.status != 200), json.message, "Alert", "log")
                    if (json.status == 200) {
                        $("#phone").val('');
                        $("#produit").val('');
                        $("#langue").val(''); 

                    }
                });
            } else {
                document.getElementById("infos").innerHTML = setErreur(200, "Le marché est vide !", "Alert", "log")
            }

        }

        function load_init() {
            HttpPost("/abonnement/load-infos", {}).then(function(res) {
                var json = res.data.data;
                list_marches = json.marches;
                list_packets = json.packets;
                list_produits = json.produits;
 
                loadCombo("produit", list_produits, " All");
            });
        }

        function loadCombo(id, liste = [], default_val = "Select") {
            var el = document.getElementById(id);
            el.innerHTML = `<option value="">${default_val}</option>`;
            liste.forEach(element => {
                el.innerHTML += `<option value="${element.id}">${element.designation}</option>`;
            });
        }
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="<?php url() ?>views/js/popper.min.js"></script>
    <script src="<?php url() ?>views/js/bootstrap.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="<?php url() ?>views/js/jquery.appear.js"></script>
    <!-- Countdown JavaScript -->
    <script src="<?php url() ?>views/js/countdown.min.js"></script>
    <!-- Counterup JavaScript -->
    <script src="<?php url() ?>views/js/waypoints.min.js"></script>
    <script src="<?php url() ?>views/js/jquery.counterup.min.js"></script>
    <!-- Wow JavaScript -->
    <script src="<?php url() ?>views/js/wow.min.js"></script>
    <!-- Apexcharts JavaScript -->
    <script src="<?php url() ?>views/js/apexcharts.js"></script>
    <!-- Slick JavaScript -->
    <script src="<?php url() ?>views/js/slick.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="<?php url() ?>views/js/select2.min.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="<?php url() ?>views/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="<?php url() ?>views/js/jquery.magnific-popup.min.js"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="<?php url() ?>views/js/smooth-scrollbar.js"></script>
    <!-- lottie JavaScript -->
    <script src="<?php url() ?>views/js/lottie.js"></script>
    <!-- am core JavaScript -->
    <script src="<?php url() ?>views/js/core.js"></script>
    <!-- am charts JavaScript -->
    <script src="<?php url() ?>views/js/charts.js"></script>
    <!-- am animated JavaScript -->
    <script src="<?php url() ?>views/js/animated.js"></script>
    <!-- am kelly JavaScript -->
    <script src="<?php url() ?>views/js/kelly.js"></script>
    <!-- am maps JavaScript -->
    <script src="<?php url() ?>views/js/maps.js"></script>
    <!-- am worldLow JavaScript -->
    <script src="<?php url() ?>views/js/worldLow.js"></script>
    <!-- Style Customizer -->
    <script src="<?php url() ?>views/js/style-customizer.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="<?php url() ?>views/js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="<?php url() ?>views/js/custom.js"></script>


</body>

</html>