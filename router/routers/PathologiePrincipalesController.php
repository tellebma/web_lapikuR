<?php

require_once 'services/Api/PathologieServices.php';

class PathologiePrincipalesController {
    function routing($router){
        $router->get('/pathologiePrincipales', function(){
            session_start();
            if (!isset($_SESSION['loggedin'])) {
                //Non connecté
                $layout = 'layouts/layout.twig';
                
            }else{
                //Connecté
                $layout = 'layouts/loggedin_layout.twig';
            }
            echo $GLOBALS['twig']->render('pathologiePrincipales.twig', [
                                                        'layout' => $layout,
                                                        'symptomesByPathologie' => (new PathologieServices())->getSymptomesByPathologie(),
                                                        'pathologies' => (new PathologieServices())->listAll()
                                                    ]);
        });         
    }
}

?>