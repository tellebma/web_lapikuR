<?php

require_once 'services/DataBaseServices.php';

class KeywordServices{
    private $_db;

    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    /**
     * Lists content of the keyword table
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function listAll(){
        return(($this->_db)->query("SELECT * FROM keywords")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * List a keyword matching a given id
     * 
     * @param Int $id, Id of a specifig keyword
     * @return Array, An array with all the resuts of the given query
     */
    function getById($id){
        return(($this->_db)->query("SELECT * FROM keywords
                                    WHERE keywords.idK = $id
                                    ORDER BY keywords.idK")->fetchAll(PDO::FETCH_ASSOC));
    }
} 

?>