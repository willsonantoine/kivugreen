<?php

use Slim\Http\Request;

$app->get("/admin/produit",function(Request $request){
    $menu = "produit";
    include './views/stock/produits.php';
});

$app->get("/admin/approvisionnement",function(Request $request){
    $menu = "produit";
    include './views/stock/approvisionnement.php';
});

$app->get("/admin/fiche_de_stock",function(Request $request){
    $menu = "produit";
    include './views/stock/stock.php';
});

$app->get("/admin/rapport_de_vente",function(Request $request){
    $menu = "produit";
    include './views/stock/rapport_vente.php';
});