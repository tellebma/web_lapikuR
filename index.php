<?php

require 'vendor/autoload.php';

// Routing
$page = 'home';
if (isset($_GET['p'])){
    $page = $_GET['p'];
}

// Rendu du template

$loader = new Twig_Loader_Filesystem(__DIR__ . '/view/pages');
$twig = new Twig_Environment($loader);

if ($page === 'home'){
    echo $twig->render('index.twig');
}