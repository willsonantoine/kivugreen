<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get("/admin", function (Request $request, Response $response) {
    $menu = "login";
    include './views/home/home.php';
});

$app->get("/error", function (Request $request, Response $response) {
    $message = $request->getParam('msg');
    include './views/error_page/404.php';
});

$app->get("/admin/start", function (Request $request, Response $response) {

    session_unset();
    session_destroy();
    session_start();

    if ($request->getParam("token") != null) {

        $_SESSION["token"] = $request->getParam("token");
        header("location:./home");

        exit();
    }

    $menu = "login";
    include './views/home/home.php';
});
$app->get("/admin/start/profil", function (Request $request, Response $response) {

    if ($request->getParam("token") != null) {
        $_SESSION["token"] = $request->getParam("token");
        header("location:./home");
        exit();
    }

    $menu = "login";
    include './views/home.php';
});

$app->get("/welcom", function (Request $request, Response $response) {
    session_unset();
    session_destroy();
    include './start.php';
});
