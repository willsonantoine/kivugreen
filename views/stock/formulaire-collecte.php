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
                                <h5 style="font-size: 10px ;" class="text-center text-dark">Collecte d'informations du marché</h5>
                                <form class="mt-4">

                                    <div class="row">
                                        <div class="form-group col-md-4"> 
                                            <select class="form-control setcolor" id="produit">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-4"> 
                                            <select class="form-control setcolor" id="unite">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-4"> 
                                            <input type="number" class="form-control setcolor" id="prix" placeholder="Prix">
                                        </div>

                                    </div>

                                    <div id="infos"></div>
                                    <div class="sign-info text-center">
                                        <button type="button" id="log" class="btn btn-primary d-block w-100 mb-2">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php url() ?>in/collecte.js"></script>

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