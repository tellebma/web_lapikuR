<?php

require 'vendor/autoload.php';
require 'router/Router.php';
require 'router/Route.php';
require 'router/RouterException.php';
require 'services/DataBase.php';

// Init Routing
$router = new Router($_GET['url']);

// Rendu du template

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, []);

$router->get('/', function(){
    echo $GLOBALS['twig']->render('index.twig');
});

$router->get('/pathologies_MC', function(){
    echo $GLOBALS['twig']->render('pathologies.twig');
});

$router->get('/pathologies_C', function(){
    echo $GLOBALS['twig']->render('criteres.twig');
});

// Run routing
$router->run();