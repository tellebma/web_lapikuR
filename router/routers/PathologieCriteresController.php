<?php
session_start();
require_once 'services/PathologieCriteresServices.php';
require_once 'services/Api/PathologieServices.php';
require_once 'services/Api/MeridienServices.php';
require_once 'services/Api/KeywordServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieCriteresController {
    function routing($router){
        $router->get('/pathologieCriteres', function(){
            session_start();
            echo $GLOBALS['twig']->render('pathologieCriteres.twig', [
                                                        'session_name'=>($_SESSION['name'] ??= NULL),
                                                        'dataToDisplay' => (new PathologieCriteresServices())->getDataToDisplay("all", "all", "all"),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologieCriteres/critmer=:meridiens-critpath=:pathologies-critcarac=:keywords', function($meridiens, $pathologies, $keywords){
            session_start();
            echo $GLOBALS['twig']->render('pathologieCriteres.twig', [
                                                        'session_name'=>($_SESSION['name'] ??= NULL),
                                                        'dataToDisplay' => (new PathologieCriteresServices())->getDataToDisplay($meridiens, $pathologies, $keywords),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

