<?php

require_once 'services/DataBaseService.php';

require_once 'services/Api/PathologieServices.php';

class PathologiesCriteresController {
    function routing($router){
        $router->get('/pathologies_C', function(){
            echo $GLOBALS['twig']->render('pathologies_C.twig', [
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologies_C/:meridiens-:pathologies-:keywords-:symptomes', function($meridiens, $pathologies, $keywords, $symptomes){
            echo $meridiens;
            echo $pathologies;
            echo $keywords;
            echo $symptomes;
            echo $GLOBALS['twig']->render('pathologies_C.twig', [
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

