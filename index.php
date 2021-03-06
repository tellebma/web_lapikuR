<?php

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

// Site
require_once 'router/routers/IndexController.php';
$indexController = (new IndexController())->routing($router);
require_once 'router/routers/PathologieCriteresController.php';
$pathologieCriteresController = (new PathologieCriteresController())->routing($router);
require_once 'router/routers/PathologieSymptomesController.php';
$pathologieSymptomesController = (new PathologieSymptomesController())->routing($router);
// Api
require_once 'router/routers/Api/KeywordController.php';
$apiController = (new KeywordController())->routing($router);
require_once 'router/routers/Api/MeridienController.php';
$apiController = (new MeridienController())->routing($router);
require_once 'router/routers/Api/PathologieController.php';
$apiController = (new PathologieController())->routing($router);
require_once 'router/routers/Api/SymptomeController.php';
$apiController = (new SymptomeController())->routing($router);
require_once 'router/routers/Api/UserController.php';
$apiController = (new UserController())->routing($router);

// Run routing
$router->run();