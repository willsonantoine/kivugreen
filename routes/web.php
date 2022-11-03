<?php

use Slim\Http\Request;
use Slim\Http\Response;

include './db/WebApp.php';

$app->get("/", function (Request $request, Response $response) {
    $menu = "login";
    include './views/home/home.php';
});
