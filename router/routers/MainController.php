<?php

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
            $usrManagement = (new UserManagementService());
            $name = $_POST["name"];
            $pass = $_POST["pass"];
            if ($usrManagement->passVerify($name, $pass)){
                $usr = $usrManagement->getUser($name);
                echo $GLOBALS['twig']->render('index.twig',[
                    'name'=>$usr->name,
                    'user_session'=>password_hash($usr->name.$usr->pass, PASSWORD_DEFAULT),
                ]);
                
    
            }else{
                echo $GLOBALS['twig']->render('index.twig',[
                    'error'=>'une erreur stylé !'
                ]);
            }
            
            
            // CONNECT TO DB
            // RETRIEVE DATA FROM FORM
            // CHECK IF EQUAL TO WHAT S STORED IN DB
            // IF YES DO STUFF IF NO FUCK OFF this part is ?
        });

        /**
         * Gets data from a form, stores it into the db.
         */
        $router->post('/register', function(){
            (new UserManagementService())->register($_POST["name"], $_POST["pass"], $_POST["mail"]);
        });
    }
}

?>

