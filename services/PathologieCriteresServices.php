<?php

require_once 'helpers/PathologieHelpers.php';

class PathologieCriteresServices{
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    function getDataToDisplay($meridiens, $pathologies, $keywords){
        $i = 0;
        $whereString = "";

        foreach(func_get_args() as $arg){
            $array = (new PathologieHelpers())->formatCriterias(explode(".", $arg));
            $whereString .= (new PathologieHelpers())->getWhereString($i, $array) . "\r\n";
            $i++;
        }

        return(($this->_db)->query("SELECT DISTINCT patho.desc, patho.idP FROM patho 
                                    JOIN meridien ON patho.mer = meridien.code 
                                    JOIN symptPatho ON symptPatho.idP = patho.idP
                                    JOIN symptome ON symptome.idS = symptPatho.idS
                                    JOIN keySympt ON symptome.idS = keySympt.idS
                                    JOIN keywords ON keySympt.idK = keywords.idK 
                                    WHERE " . substr($whereString, 0, -6) . " ORDER BY patho.idP")->fetchAll(PDO::FETCH_ASSOC));
    }
} 
?>
