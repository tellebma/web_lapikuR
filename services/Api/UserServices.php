<?php

require_once 'services/DataBaseServices.php';

class UserServices{
    private $_db;

    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    function listAll(){
        return(($this->_db)->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC));
    }

    function getById(){

    }
    
    function getByName(){

    }

    function getByMail(){
        
    }
} 

?>