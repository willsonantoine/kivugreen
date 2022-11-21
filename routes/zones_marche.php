<?php

use Slim\Http\Request;

$app->get("/admin/marches",function(Request $request){
    $menu = "marche";
    include './views/zones_marche/zones.php';
});

$app->get("/admin/zones",function(Request $request){
    $menu = "marche";
    include './views/zones_marche/zones.php';
});
