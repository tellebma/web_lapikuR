<?php

require_once 'services/DataBaseService.php';

class SymptomeServices{
    private $_db;

    function __construct(){
        $this->_db = (new DataBaseService())->connect();
    }

    function listAll(){
        return(($this->_db)->query("SELECT * FROM symptome")->fetchAll(PDO::FETCH_ASSOC));
    }

    function getById(){

    }

    function getByDesc(){
        
    }
} 

?>