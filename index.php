<?php

require_once 'vendor/autoload.php';
require_once 'services/dataBase.php';

// Routing
$page = 'index';

if (isset($_GET['p'])){
    $page = $_GET['p'];
}

// Test

$db = (new DataBase())->connect();
$test = $db->query('SELECT * FROM meridien ORDER BY code DESC LIMIT 10');
$ttt = $test->fetchAll(PDO::FETCH_ASSOC);
foreach ($ttt as &$value){
    foreach($value as &$aled){
        echo $aled;
        echo "\r\n";
    }
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