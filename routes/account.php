<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/admin/create-account', function (Request $request, Response $response) {
    include './views/auth/creat_account.php';
});
$app->get('/admin/create-account/val', function (Request $request, Response $response) {
    if (isset($_GET["ra"])) {
        $email = $_GET["ra"];
        include './views/auth/code_validate_account.php';
    } else {
        include './views/auth/creat_account.php';
    }
});
