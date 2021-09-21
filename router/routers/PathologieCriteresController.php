<?php

require_once 'services/DataBaseServices.php';

require_once 'services/PathologieCriteresServices.php';
require_once 'services/Api/PathologieServices.php';
require_once 'services/Api/MeridienServices.php';
require_once 'services/Api/KeywordServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieCriteresController {
    function routing($router){
        $router->get('/pathologies_C', function(){
            echo $GLOBALS['twig']->render('pathologies_C.twig', [
                                                        'dataToDisplay' => (new PathologieCriteresServices())->getDataToDisplay("all", "all", "all", "all"),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologies_C/critmer=:meridiens-critpath=:pathologies-critcarac=:keywords-critsympt=:symptomes', function($meridiens, $pathologies, $keywords, $symptomes){
            echo $GLOBALS['twig']->render('pathologies_C.twig', [
                                                        'dataToDisplay' => (new PathologieCriteresServices())->getDataToDisplay($meridiens, $pathologies, $keywords, $symptomes),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

