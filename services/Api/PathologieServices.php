<?php

require_once 'services/DataBaseService.php';

class PathologieServices{
    private $_db;

    function __construct(){
        $this->_db = (new DataBaseService())->connect();
    }

    function listAll(){
        return(($this->_db)->query("SELECT * FROM patho")->fetchAll(PDO::FETCH_ASSOC));
    }

    function getById(){

    }

    function getByMeridient(){

    }

    function getByType(){

    }

    function getByDesc(){

    }

    function getSymptomesForPathologie($pathologieId){
        return(($this->_db)->query("SELECT * FROM patho 
                                    JOIN symptPatho ON patho.idP = symptPatho.idP
                                    JOIN symptome ON symptPatho.idS = symptome.idS
                                    WHERE patho.idP = $pathologieId 
                                    ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }

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
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){ // C'est comme ça pour parse les results
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

    function getMeridienByPathologie(){

    }
} 

?>