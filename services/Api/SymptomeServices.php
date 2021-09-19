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

    function getKeywordsBySymptome(){
        $res = ($this->_db)->query("SELECT symptome.idS AS sidS, symptome.desc, keySympt.idS AS ksidS, keySympt.idK as ksidK, keywords.idK AS kidK, keywords.name FROM symptome 
                                    JOIN keySympt ON symptome.idS = keySympt.idS 
                                    JOIN keywords ON keySympt.idK = keywords.idK 
                                    ORDER BY symptome.idS");
        $i = 0;
        $j = 0;
        $lastsidS = null;
        $array = null;
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){ // C'est comme ça pour parse les results
            if ($row['sidS'] != $lastsidS){
                $j=0;
                $array[$i] = array(
                    "idS" => $row['sidS'],
                    "desc" => $row['desc'],
                    "keywords" => array(
                        $j => array(
                            "idK" => $row['kidK'],
                            "name" => $row['name']
                        )
                    )
                );
                $j++;
                $i++;
            }else{
                array_push($array[$i-1]['keywords'], array("idK" => $row['kidK'], "name" => $row['name']));

            }
            $lastsidS = $row['sidS'];
        }
        return($array);
    }
} 

?>
