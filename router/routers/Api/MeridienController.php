<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/MeridienServices.php';

class MeridienController{
    function routing($router){
        /**
         * Get meridiens
         */
        $router->get('/api/meridien/all', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new MeridienServices())->listAll());
        });

        /**
         * Get all pathologies by meridian
         */
        $router->get('/api/meridien/all/pathologies', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new MeridienServices())->getPathologiesByMeridien());
        });

        /**
         * Get all pathologies linked to a meridian
         */
        $router->get('/api/meridien/:code/pathologies', function($code){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new MeridienServices())->getPathologiesForMeridien($code));
        });

        /**
         * Get meridian thanks to it's code
         */
        $router->get('/api/meridien/:code', function($code){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new MeridienServices())->getByCode($code));
        });
    }
}

?>