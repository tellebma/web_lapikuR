<?php

require_once 'services/PathologieSymptomesServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieSymptomesController {
    function routing($router){
        $router->get('/pathologieSymptomes', function(){
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'dataToDisplay' => (new PathologieSymptomesServices())->getDataToDisplay("all"),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologieSymptomes/critsympt=:symptomes', function($symptomes){
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'dataToDisplay' => (new PathologieSymptomesServices())->getDataToDisplay($symptomes),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

