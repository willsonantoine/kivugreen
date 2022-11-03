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
    <script type="text/javascript" src="<?php url(); ?>in/login.js?x=<?php echo random_int(1, 1000); ?>"></script>
    <script type="text/javascript" src="<?php url(); ?>in/var.js?x=<?php echo random_int(1, 1000); ?>"></script>

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
                                <h1 class="mb-0 text-center">KIVUGREEN</h1>
                                <br>
                                <h4 class="mb-0 text-center">Se connecter</h4>
                                <p class="text-center text-dark">Veuillez saisir votre mot de passe et votre nom d'utilisateur</p>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <label for="username">Nom d'utulisateur</label>
                                        <input type="text" id="username" autocomplete="off" class="form-control mb-0" placeholder="Nom d'utilisateur">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <a href="#" class="float-right">Mot de passe oublié ?</a>
                                        <input type="password" autocomplete="off" class="form-control mb-0" id="password" placeholder="Mot de passe">
                                    </div>
                                    <div class="d-inline-block w-100">
                                        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Rester connecté</label>
                                        </div>
                                    </div>
                                    <div id="infos"></div>
                                    <div class="sign-info text-center">
                                        <button type="button" id="log" class="btn btn-primary d-block w-100 mb-2">Se connecter</button>
                                        <span class="text-dark dark-color d-inline-block line-height-2">Vous n'avez pas de
                                            compte? <a href="<?php url(); ?>admin/create-account">Créer un compte</a>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-7 text-center sign-in-page-image">
                            <div class="sign-in-detail text-white">
                                <a class="sign-in-logo mb-5" href="#"><img src="./<?php url(); ?>views/images/icon.png" class="img-fluid icon" alt="logo"></a>
                                <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                    <div class="item">
                                        <img src="./<?php url(); ?>views/images/banniere3.jpg" class="img-fluid mb-4" alt="Gestion des stocks et facturation">
                                        <h4 class="mb-1 text-white">Agriculture numérique</h4>
                                        <p>Oeuvrer pour l'agriculture numérique pour l'emergence de la RDC</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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


    <script>
        var xs = '<?php echo $exist; ?>';
        if (xs == '1') {
            localStorage.setItem('access_token', null);
        }
    </script>
</body>

</html>