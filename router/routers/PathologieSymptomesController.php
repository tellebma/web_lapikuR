<?php

require_once 'services/PathologieSymptomesServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieSymptomesController {
    function routing($router){
        $router->get('/pathologieSymptomes', function(){
            session_start();
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'session_name'=>$_SESSION['name'],
                                                    ]);
        });   
        
        $router->get('/pathologieSymptomes/critsympt=:symptomes', function($symptomes){
            session_start();
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'session_name'=>$_SESSION['name'],
                                                        'dataToDisplay' => (new PathologieSymptomesServices())->getDataToDisplay($symptomes),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

