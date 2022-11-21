<?php
 

require './vendor/autoload.php';

$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => false,
]);


include './db/variables.php';
include './routes/index.php';
include './routes/produit.php'; 
include './routes/login-start.php'; 
include './routes/zones_marche.php';


$app->run();
