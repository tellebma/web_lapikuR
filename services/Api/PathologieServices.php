<?php

require_once 'services/DataBaseServices.php';

class PathologieServices{
    private $_db;

    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    /**
     * Lists content of the patho table
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function listAll(){
        return(($this->_db)->query("SELECT * FROM patho")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * List a pathologie matching a given id
     * 
     * @param Int $id, Id of a specifig pathologie
     * @return Array, An array with all the resuts of the given query
     */
    function getById($id){
        return(($this->_db)->query("SELECT * FROM patho
                                    WHERE patho.idP = $id
                                    ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * Lists all pathologies with matchin meridien name instead of code
     * 
     * @return Array, An array with all the resuts of the given query
     */
    function getMeridienByPathologie(){
        return(($this->_db)->query("SELECT patho.idP, patho.desc, meridien.nom FROM patho
                                    JOIN meridien ON patho.mer = meridien.code
                                    ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * Lists all symptomes for a given pathologie
     * 
     * @param Int $id, Id of a specifig pathologie
     * @return Array, An array with all the resuts of the given query
     */
    function getSymptomesForPathologie($pathologieId){
        return(($this->_db)->query("SELECT * FROM patho 
                                    JOIN symptPatho ON patho.idP = symptPatho.idP
                                    JOIN symptome ON symptPatho.idS = symptome.idS
                                    WHERE patho.idP = $pathologieId 
                                    ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * List all symptomes by pathologie
     * 
     * @return Array, An array with all the resuts of the given query
    */
    function getSymptomesByPathologie(){
        $res = ($this->_db)->query("SELECT patho.idP AS pidP, patho.desc AS pdesc, patho.mer, patho.type, meridien.nom, symptPatho.idP AS spidP, symptome.idS as sidS, symptome.desc as sdesc  FROM patho 
                                    JOIN symptPatho ON patho.idP = symptPatho.idP 
                                    JOIN symptome ON symptPatho.idS = symptome.idS 
                                    JOIN meridien ON patho.mer = meridien.code
                                    ORDER BY patho.idP");
        $i = 0;
        $j = 0;
        $lastpidP = null;
        $array = null;
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            if ($row['pidP'] != $lastpidP){
                $j=0;
                $array[$i] = array(
                    "desc" => $row['pdesc'],
                    "idP" => $row['pidP'],
                    "mer" => $row['nom'],
                    "type" => $row['type'],
                    "symptomes" => array(
                        $j => array(
                            "idS" => $row['sidS'],
                            "desc" => $row['sdesc']
                        )
                    )
                );
                $j++;
                $i++;
            }else{
                array_push($array[$i-1]['symptomes'], array("idS" => $row['sidS'], "desc" => $row['sdesc']));

            }
            $lastpidP = $row['pidP'];
        }
        return($array);
    }
} 

?>