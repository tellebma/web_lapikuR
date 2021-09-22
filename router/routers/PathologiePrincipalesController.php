<?php

require_once 'services/Api/PathologieServices.php';

class PathologiePrincipalesController {
    function routing($router){
        $router->get('/pathologiePrincipales', function(){
            echo $GLOBALS['twig']->render('pathologiePrincipales.twig', [
                                                        'symptomesByPathologie' => (new PathologieServices())->getSymptomesByPathologie(),
                                                        'pathologies' => (new PathologieServices())->listAll()
                                                    ]);
        });         
    }
}

?>