<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/KeywordServices.php';

class KeywordController{
    function routing($router){
        /**
         * Get keywords
         */
        $router->get('/api/keyword/all', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new KeywordServices())->listAll());
        });

        /**
         * Get a keyword thanks to it's id
         */
        $router->get('/api/keyword/:idOrName', function($idOrName){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new KeywordServices())->getById($idOrName));
        });
    }
}

?>