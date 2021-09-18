<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseService.php';
require_once 'services/Api/SymptomeServices.php';

class SymptomeController{
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