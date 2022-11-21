<?php

use Slim\Http\Request;

$app->get("/admin/produit",function(Request $request){
    $menu = "produit";
    include './views/stock/produits.php';
});

