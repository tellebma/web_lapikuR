<?php

require_once 'services/DataBaseServices.php';

require_once 'services/PathologieCriteresServices.php';
require_once 'services/Api/PathologieServices.php';
require_once 'services/Api/MeridienServices.php';
require_once 'services/Api/KeywordServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieCriteresController {
    function routing($router){
        $router->get('/pathologieCriteres', function(){
            echo $GLOBALS['twig']->render('pathologieCriteres.twig', [
                                                        'dataToDisplay' => (new PathologieCriteresServices())->getDataToDisplay("all", "all", "all"),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologieCriteres/critmer=:meridiens-critpath=:pathologies-critcarac=:keywords', function($meridiens, $pathologies, $keywords){
            echo $GLOBALS['twig']->render('pathologieCriteres.twig', [
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

