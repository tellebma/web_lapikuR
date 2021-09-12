<?php

require 'services/DataBase.php';

class UserManagement {
    function login($ident, $pass){
        $result = ((new DataBase())->connect())->query("SELECT * FROM `user` WHERE `name` LIKE '".$ident."' ;");
        while ($row = $result->fetch()){
            print_r($row); // C'est comme ça pour seek des data
        }
    }
} 

?>