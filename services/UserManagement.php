<?php

require 'services/DataBase.php';

class UserManagement {
    function login($name, $pass){
        $result = (Object)(new DataBase())->query("SELECT * FROM `user` WHERE `name` LIKE '".$name."' AND `pass` LIKE '".$pass."';"); // It already was an object but was generating an error for some reason ?
        while ($row = $result->fetch()){ // C'est comme ça pour parse les results
            print_r($row); // En gros maintenant faut check si y a un résultat, et s'il y en a un ba on lui donne un token ou une merde comme ça
        }
    }

    function register($name, $pass, $mail){
        $res = (new DataBase())->query("INSERT INTO `user` (`mail`, `name`, `pass`) VALUES ( '".$mail."', '".$name."', '".password_hash($pass, PASSWORD_DEFAULT)."'");
        print_r($res);
    }
} 

?>
