<?php
session_start();
class PathologieSymptomesController {
    function routing($router){
        $router->get('/pathologieSymptomes', function(){
            session_start();
            echo $GLOBALS['twig']->render('pathologieSymptomes.twig', [
                                                        'session_name'=>($_SESSION['name'] ??= NULL),
                                                    ]);
        });
    } 
}

?>

