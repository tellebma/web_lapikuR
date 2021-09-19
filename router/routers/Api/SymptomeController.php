<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseService.php';
require_once 'services/Api/SymptomeServices.php';

class SymptomeController{
    function routing($router){
        /**
         * Get symptomes
         */
        $router->get('/api/symptome/symptomes', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new SymptomeServices())->listAll());
        });

        /**
         * Get eaach keyword by symptomes
         */
        $router->get('/api/symptome/symptomes/keywords', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new SymptomeServices())->getKeywordsBySymptome());
        });
    }
}

?>