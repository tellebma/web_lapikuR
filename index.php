<?php

// EN GROS : Faut reprendre le truc des autres commit, faire un switch sur L URL et en fonctions appeler le bon router, puis la fonction routing fera le taf !

require 'vendor/autoload.php';
require 'router/Router.php';
require 'router/Route.php';
require 'router/RouterException.php';

// Init Routing
$router = new Router($_GET['url']);

// Rendu du template

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, []);

// Routing
require 'router/routers/MainController.php';
$mainController = (new MainController())->routing($router);
require 'router/routers/PathologiesMotsClefsController.php';
$pathologiesMotsClefsController = (new PathologiesMotsClefsController())->routing($router);
require 'router/routers/PathologiesCriteresController.php';
$pathologiesCriteresController = (new PathologiesCriteresController())->routing($router);

// Run routing
$router->run();