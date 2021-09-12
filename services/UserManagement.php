<?php

require 'services/DataBase.php';

class UserManagement {
    function login($ident, $pass){
        $result = ((new DataBase())->connect())->query("SELECT * FROM `user` WHERE `name` LIKE '".$ident."' AND `pass` LIKE '".$pass."';");
        while ($row = $result->fetch()){ // C'est comme ça pour parse les results
            print_r($row); // En gros maintenant faut check si y a un résultat, et s'il y en a un ba on lui donne un token ou une merde comme ça
        }
    }
} 

?>