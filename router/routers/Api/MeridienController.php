<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/MeridienServices.php';

class MeridienController{
    function routing($router){
        /**
         * Get pathologies
         */
        $router->get('/api/pathologies', function(){
            (new ApiHelpers())->setHeaders();
        });

        /**
         * Get meridiens
         */
        $router->get('/api/meridiens', function(){
            // TODO
        });

        /**
         * Get keywords
         */
        $router->get('/api/keywords', function(){
            // TODO
        });

        /**
         * Get symptomes
         */
        $router->get('/api/symptomes', function(){
            // TODO
        });
    }
}

?>