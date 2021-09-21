<?php

require_once 'services/DataBaseServices.php';

class MeridienServices{
    private $_db;

    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    function listAll(){
        return(($this->_db)->query("SELECT * FROM meridien")->fetchAll(PDO::FETCH_ASSOC));
    }

    function getByCode(){

    }
    
    function getByElement(){

    }

    function getByYin(){
        
    }
} 

?>