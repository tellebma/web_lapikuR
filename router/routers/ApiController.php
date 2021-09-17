<?php

require_once 'services/DataBaseService.php';

class ApiController{
    function routing($router){
        /**
         * Get pathologies
         */
        $router->get('/api/pathologies', function(){
            echo json_encode((new DataBaseService())->query("SELECT * FROM patho")->fetchAll(PDO::FETCH_ASSOC));
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

