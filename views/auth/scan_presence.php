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
    <script src="<?php url(); ?>views/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/axios.js"></script>
    <script type="text/javascript" src="<?php url(); ?>in/http.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/scan_presence.js?x=<?php echo random_int(1, 1000); ?>"></script>

</head>
<style>
    .icon {
        filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
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
                        <div class="col-md-5 bg-white sign-in-page-data">
                            <div class="sign-in-from">
                                <br>
                                <h4 class="mb-0 text-center">PRESENCE SCAN</h4>
                                <p class="text-center text-dark">Veillez saisir si bas le code ou placez le curseur du scanneur pour une saisie automatique</p>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" id="scan" autocomplete="off" class="form-control mb-0" placeholder="00000000000">
                                    </div>
                                    <div id="infos"></div>
                                    <div class="sign-info text-center">
                                        <button type="button" id="btn_scan" class="btn btn-primary d-block w-100 mb-2">Scan</button>
                                        <span class="text-dark dark-color d-inline-block line-height-2">Vous n'avez pas de
                                            compte? <a href="<?php url();?>admin/membres">Créer un compte membre</a>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-7 text-center sign-in-page-image">
                            <div class="sign-in-detail text-white">
                                <img id="img-user" src="./<?php url(); ?>views/images/1.png?x=1" class="img-fluid">
                                <br>
                                <h4 class="mb-1 text-white " id="show-nom">Scanner la presence</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var all_membres = [];
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


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
    <!-- lottie JavaScript -->
    <script src="<?php url(); ?>views/js/lottie.js"></script>
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
    <!-- Style Customizer -->
    <script src="<?php url(); ?>views/js/style-customizer.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="<?php url(); ?>views/js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="<?php url(); ?>views/js/custom.js"></script>



</body>

</html>