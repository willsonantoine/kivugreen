<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app->get("/admin/login", function (Request $request, Response $response) {
   $exist = false;
   $menu = "login";
   include './views/auth/login.php';
});

$app->post("/admin/login-exit", function (Request $request, Response $response) {
   $exist = true;
   $menu = "login";
   session_unset();
   session_destroy();
   include './views/auth/login.php';
});

$app->get("/admin/login-exit", function (Request $request, Response $response) {
   $exist = true;
   $menu = "login";
   include './views/auth/login.php';
});

$app->get("/admin/home", function (Request $request, Response $response) {
   $menu = "home";
   include './views/home/home.php';
});
 

$app->get("/admin/utilisateurs", function (Request $request, Response $response) {
   $menu = "utilisateurs";
   include './views/auth/membres.php';
});
 
 
$app->get("/admin/profile", function (Request $request, Response $response) {
   $menu = "profil";
   include './views/auth/profil.php';
});
$app->get("/admin/membres-groupes", function (Request $request, Response $response) {
   $menu = "utilisateurs";
   include './views/auth/grouppe.php';
});

$app->get("/admin/organisation-entreprise", function (Request $request, Response $response) {
   $menu = "parametre";
   include './views/organisation-entreprise.php';
});
$app->get("/admin/informations", function (Request $request, Response $response) {
   $menu = "information";
   include './views/stock/informations-du-marche.php';
});

 
$app->get("/admin/collecte", function (Request $request, Response $response) {
   $menu = "collecte";
   include './views/stock/formulaire-collecte.php';
});

$app->get("/admin/collect-list", function (Request $request, Response $response) {
   $menu = "collecte";
   include './views/stock/liste_des_colletes.php';
});
$app->get("/admin/abonnement", function (Request $request, Response $response) {
   $menu = "abonnement";
   include './views/stock/abonnement_informations.php';
});
$app->get("/admin/abonnement-list", function (Request $request, Response $response) {
   $menu = "abonnement-list";
   include './views/stock/liste-abonnees.php';
});

 

$app->get("/admin/show-profil/{id}", function (Request $request, Response $response) {

   $menu = "identification";

   $id = $request->getAttribute('id');

   $data = getProfilData($id);


   if ($data->data) {

      $profil = $data->data;

      include './views/auth/profile-edit.php';
   } else {

      include './views/auth/membres.php';
   } 
});
 
