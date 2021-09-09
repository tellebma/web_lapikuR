<?php

require_once 'vendor/autoload.php';

// Routing
$page = 'index';

if (isset($_GET['p'])){
    $page = $_GET['p'];
}

// Rendu du template

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, []);

switch ($page) {
    case 'index':
        echo $twig->render('index.twig');
        break;
    case 'pathologies':
        echo $twig->render('pathologies.twig');
        break;
    case 'criteres':
        echo $twig->render('criteres.twig');
        break;
}