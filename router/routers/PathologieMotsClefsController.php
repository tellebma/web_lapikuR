<?php

class PathologieMotsClefsController {
    function routing($router){
        $router->get('/pathologies_MC', function(){
            echo $GLOBALS['twig']->render('pathologies_MC.twig');
        });
           
    }
}

?>