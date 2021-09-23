<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/PathologieServices.php';

class PathologieController{
    function routing($router){
        /**
         * Get all pathologies
         */
        $router->get('/api/pathologie/all', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->listAll());
        });

        /**
         * Get each symptomes by pathologie
         */
        $router->get('/api/pathologie/all/symptomes', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getSymptomesByPathologie());
        });

         /**
         * Get pathologies with actual meridian name
         */
        $router->get('/api/pathologie/all/meridian', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getMeridienByPathologie());
        });

        /**
         * Get symptomes for a pathologie thanks to it's Id
         */
        $router->get('/api/pathologie/:id/symptomes', function($id){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getSymptomesForPathologie($id));
        });

        /**
         * Get pathologie thanks to it's id
         */
        $router->get('/api/pathologie/:id', function($id){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new PathologieServices())->getById($id));
        });

        
    }
}

?>

