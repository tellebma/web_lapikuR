<?php

require_once 'services/PathologieSymptomesServices.php';
require_once 'services/Api/SymptomeServices.php';


class PathologieSymptomesController {
    function routing($router){
        $router->get('/pathologieSymptomes', function(){
            session_start();
            if (!isset($_SESSION['loggedin'])) {
                //Non connecté
                $layout = 'headers/layout.twig';
                
            }else{
                //Connecté
                $layout = 'headers/loggedin_layout.twig';
            }
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'layout' => $layout,
                                                        'dataToDisplay' => (new PathologieSymptomesServices())->getDataToDisplay("all"),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });   
        
        $router->get('/pathologieSymptomes/critsympt=:symptomes', function($symptomes){
            session_start();
            if (!isset($_SESSION['loggedin'])) {
                //Non connecté
                $layout = 'headers/layout.twig';
                
            }else{
                //Connecté
                $layout = 'headers/loggedin_layout.twig';
            }
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'layout' => $layout,
                                                        'dataToDisplay' => (new PathologieSymptomesServices())->getDataToDisplay($symptomes),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        }); 
    } 
}

?>

