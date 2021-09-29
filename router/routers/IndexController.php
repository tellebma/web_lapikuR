<?php

require_once 'services/IndexServices.php';

class IndexController {
    function routing($router){
        /**
         * Display main page
         */
        $router->get('/', function(){
            session_start();
            // If the user is not logged in redirect to the login page...
            if (!isset($_SESSION['loggedin'])) {
                echo $GLOBALS['twig']->render('login.twig');
            }else   
            echo $GLOBALS['twig']->render('index.twig');
        });

        /**
         * Gets data from a form, connects to db and check credentials.
         */
        $router->post('/authentification', function(){
            session_start();
            $usrManagement = (new IndexServices());
            $name = $_POST["name"];
            $pass = $_POST["pass"];
            if ($usrManagement->login($name, $pass)){
                if (!isset($_SESSION['loggedin'])) {
                    echo $GLOBALS['twig']->render('login.twig');
                    return 1;
                }else{
                    echo $GLOBALS['twig']->render('index.twig');
                    return 1;
                }
            }
            echo $GLOBALS['twig']->render('login.twig',[
                'error'=>'La combinaison d\'identifiant/mot de passe est mauvaise !'
            ]);
        });

        /**
         * Gets data from a form, stores it into the db.
         */
        $router->post('/register', function(){
            session_start();
            $usrManagement = (new IndexServices());
            $name = $_POST["name"];
            $pass = $_POST["pass"];
            $mail = $_POST["mail"];
            if ($usrManagement->register($name, $pass, $mail)){
                $usrManagement->login($name, $pass);
                echo $GLOBALS['twig']->render('index.twig',[
                    'sucess'=>'Vous êtes bien Enregistré !'
                ]);
                return 1;
            }
            echo $GLOBALS['twig']->render('index.twig',[
                'error'=>'Vous n\'avez pas pu être enregistré !'
            ]);
            return 0;
            


        });

        $router->get('/logout', function(){
            session_start();
            session_destroy();
            header('Location: /');
        });
    }
};

?>