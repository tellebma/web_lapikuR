<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseService.php';
require_once 'services/Api/PathologieServices.php';

class PathologieController{
    function routing($router){
        /**
         * Get all pathologies
         */
        $router->get('/api/pathologie/pathologies', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->listAll());
        });

        /**
         * Get each symptomes by pathologie
         */
        $router->get('/api/pathologie/pathologies/symptomes', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getSymptomesByPathologie());
        });
        
        /**
         * Get symptomes for a pathologie thanks to it's Id
         */
        $router->get('/api/pathologie/:pathologieId/symptomes', function($pathologieId){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getSymptomesForPathologie($pathologieId));
        });

        
    }
}

?>

