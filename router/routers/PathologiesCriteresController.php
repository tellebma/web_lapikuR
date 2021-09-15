<?php

class PathologiesCriteresController {
    function routing($router){
        $router->get('/pathologies_C', function(){
            echo $GLOBALS['twig']->render('pathologies_C.twig');
        });      
    }
}

?>

