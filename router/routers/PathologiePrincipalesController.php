<?php

require_once 'services/Api/PathologieServices.php';

class PathologiePrincipalesController {
    function routing($router){
        $router->get('/pathologiePrincipales', function(){
            session_start();
            echo $GLOBALS['twig']->render('pathologiePrincipales.twig', [
                                                        'session_name'=>$_SESSION['name']
                                                    ]);
        });         
    }
}

?>