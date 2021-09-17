<?php

header('Access-Control-Allow-Origin');
header('Content-type: application/json');

require_once 'vendor/autoload.php';
require_once 'router/Router.php';
require_once 'router/Route.php';
require_once 'router/RouterException.php';

// Rendu du template
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, ['debug' => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Init Routing
$router = new Router($_GET['url']);

// Routing
require_once 'router/routers/MainController.php';
$mainController = (new MainController())->routing($router);
require_once 'router/routers/PathologiesMotsClefsController.php';
$pathologiesMotsClefsController = (new PathologiesMotsClefsController())->routing($router);
require_once 'router/routers/PathologiesCriteresController.php';
$pathologiesCriteresController = (new PathologiesCriteresController())->routing($router);
require_once 'router/routers/PathologiesCriteresController.php';
$pathologiesCriteresController = (new PathologiesCriteresController())->routing($router);
require_once 'router/routers/ApiController.php';
$apiController = (new ApiController())->routing($router);

// Run routing
$router->run();