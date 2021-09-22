<?php

require_once 'services/DataBaseServices.php';

class UserServices{
    private $_db;

    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    /**
     * Lists content of the user table
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function listAll(){
        return(($this->_db)->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * List a user matching a given id
     * 
     * @param Int $id, Id of a specifig user
     * @return Array, An array with all the resuts of the given query
     */
    function getById($id){
        return(($this->_db)->query("SELECT * FROM user
                                    WHERE user.idP = $id")->fetchAll(PDO::FETCH_ASSOC));
    }


    /*
    function getByName($name){
        return(($this->_db)->query("SELECT * FROM user
                                    WHERE user.name = $name")->fetchAll(PDO::FETCH_ASSOC));
    }
    */
} 

?>