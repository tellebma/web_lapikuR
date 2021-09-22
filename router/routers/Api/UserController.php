<?php

require_once 'helpers/ApiHelpers.php';

require_once 'services/DataBaseServices.php';
require_once 'services/Api/UserServices.php';

class UserController{
    function routing($router){
        /**
         * Get users
         */
        $router->get('/api/user/all', function(){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new UserServices())->listAll());
        });

        /**
         * Get user thanks to it's id
         */
        $router->get('/api/user/:id', function($id){
            (new ApiHelpers())->setHeaders();
            echo json_encode((new UserServices())->getById($id));
        });
    }
}

?>