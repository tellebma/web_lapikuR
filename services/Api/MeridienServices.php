<?php

require_once 'services/DataBaseServices.php';

class MeridienServices{
    private $_db;

    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    /**
     * Lists content of the meridien table
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function listAll(){
        return(($this->_db)->query("SELECT * FROM meridien")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * List a meridien matching a given code
     * 
     * @param String $code, Code of a specifig meridien
     * @return Array, An array with all the resuts of the given query
     */
    function getByCode($code){
        return(($this->_db)->query("SELECT * FROM meridien
                                    WHERE meridien.code = $code")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * Lists all pathologies matching a given code
     * 
     * @param String $code, Code of a specifig meridien
     * @return Array, An array with all the resuts of the given query
     */
    function getPathologiesForMeridien($code){
        return(($this->_db)->query("SELECT patho.idP, patho.mer, patho.type, patho.desc FROM patho
                                    JOIN meridien ON patho.mer = meridien.code
                                    WHERE meridien.code = $code
                                    ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * Lists all pathologies by meridien
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function getPathologiesByMeridien(){
        $res = ($this->_db)->query("SELECT * FROM patho
                                    JOIN meridien ON patho.mer = meridien.code
                                    ORDER BY patho.idP");
        $i = 0;
        $j = 0;
        $lastMeridien = null;
        $array = null;
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            if ($row['nom'] != $lastMeridien){
                $j=0;
                $array[$i] = array(
                    "nom" => $row['nom'],
                    "code" => $row['mer'],
                    "type" => $row['type'],
                    "pathologies" => array(
                        $j => array(
                            "idP" => $row['idP'],
                            "desc" => $row['desc']
                        )
                    )
                );
                $j++;
                $i++;
            }else{
                array_push($array[$i-1]['pathologies'], array("idP" => $row['idP'], "desc" => $row['desc']));
            }
            $lastMeridien = $row['nom'];
        }
        return($array);
    }
} 

?>