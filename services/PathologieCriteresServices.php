<?php

require_once 'services/DataBaseServices.php';

require_once 'helpers/PathologieHelpers.php';

class PathologieCriteresServices{
    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    /**
     * Gets data that should be displayed on the pathologieCriteres.twig page by storing all
     * elements selected by the client in an array and passing it to a function (getWhereString(...))
     * that will generate a string that will be concatenated to a MySQL query
     * 
     * @param String $meridiens, String containing all meridiens selected by the client
     * @param String $pathologies, String containing all pathologies selected by the client
     * @param String $keywords, String containing all keywords selected by the client
     * @return Array, An array with all the resuts of the given query
     */
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
