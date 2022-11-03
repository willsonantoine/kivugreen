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

$app->get("/admin/create-operation", function (Request $request, Response $response) {
   $menu = "operation";
   include './views/operations/operations.php';
});

$app->get("/admin/operation-list", function (Request $request, Response $response) {
   $menu = "operation";
   include './views/operations/operations_liste.php';
});

$app->get("/admin/credit", function (Request $request, Response $response) {
   $menu = "credit";
   include './views/operations/credits.php';
});

$app->get("/admin/comptabilite-liste", function (Request $request, Response $response) {
   $menu = "comptabilite";
   include './views/compte/comptabilite.php';
});

$app->get("/admin/membres", function (Request $request, Response $response) {
   $menu = "identification";
   include './views/auth/membres.php';
});
$app->get("/admin/utilisateur", function (Request $request, Response $response) {
   $menu = "parametre";
   include './views/auth/utilisateurs.php';
});
$app->get("/admin/billetage", function (Request $request, Response $response) {
   $menu = "billetage";
   include './views/billetage/billetage.php';
});
$app->get("/admin/comptabilite-rapport", function (Request $request, Response $response) {
   $menu = "comptabilite";
   include './views/compte/compte-rapport.php';
});
$app->get("/admin/comptabilite-releve", function (Request $request, Response $response) {
   $menu = "comptabilite";
   include './views/compte/releve-compte.php';
});
$app->get("/admin/final-rapport", function (Request $request, Response $response) {
   $menu = "comptabilite";
   include './views/compte/rapport-final.php';
});
$app->get("/admin/prevision", function (Request $request, Response $response) {
   $menu = "credit";
   include './views/provision.php';
});
$app->get("/admin/profile", function (Request $request, Response $response) {
   $menu = "profil";
   include './views/auth/profil.php';
});
$app->get("/admin/membres-groupes", function (Request $request, Response $response) {
   $menu = "identification";
   include './views/auth/grouppe.php';
});

$app->get("/admin/organisation-entreprise", function (Request $request, Response $response) {
   $menu = "parametre";
   include './views/organisation-entreprise.php';
});

$app->get("/admin/web-manager", function (Request $request, Response $response) {
   $menu = "parametre";
   include './views/edit/blog_list.php';
});

$app->get("/admin/autre-releve", function (Request $request, Response $response) {
   $menu = "parametre";
   include './views/compte/releve_compte_membre.php';
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

$app->get("/admin/presence-scan", function (Request $request, Response $response) {

   include './views/auth/scan_presence.php';
});

$app->get("/admin/balance", function (Request $request, Response $response) {
   $menu = 'comptabilite';
   include './views/operations/balance.php';
});

