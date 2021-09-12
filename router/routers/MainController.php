<?php

require 'services/UserManagement.php';

class MainController {
    function routing($router){
        /**
         * Display main page
         */
        $router->get('/', function(){
            echo $GLOBALS['twig']->render('index.twig');
        });

        /**
         * Gets data from a form, connects to db and check credentials.
         */
        $router->post('/login', function(){
            $test = (new UserManagement())->login($_POST["ident"], $_POST["password"]);
            // CONNECT TO DB
            // RETRIEVE DATA FROM FORM
            // CHECK IF EQUAL TO WHAT S STORED IN DB
            // IF YES DO STUFF IF NO FUCK OFF this part is ?
        });

        /**
         * Gets data from a form, stores it into the db.
         */
        $router->post('/register', function(){
            echo "register";
        });
    }
}

?>

