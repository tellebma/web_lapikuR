<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/SymptomeServices.php';

class SymptomeController{
    function routing($router){
        /**
         * Get symptomes
         */
        $router->get('/api/symptome/all', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new SymptomeServices())->listAll());
        });

        /**
         * Get each keyword by symptomes
         */
        $router->get('/api/symptome/all/keywords', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new SymptomeServices())->getKeywordsBySymptome());
        });
        
        /**
         * Get symptome thanks to it's id
         */
        $router->get('/api/symptome/:id', function($id){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new SymptomeServices())->getById($id));
        });
    }
}

?>