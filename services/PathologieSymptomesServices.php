<?php

require_once 'services/DataBaseServices.php';

require_once 'helpers/PathologieHelpers.php';

class PathologieSymptomesServices{
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
     * @param String $symptomes, String containing all symptomes selected by the client
     * @return Array, An array with all the resuts of the given query
     */
    function getDataToDisplay($symptomes){
        $whereString = "";

        $array = (new PathologieHelpers())->formatCriterias(explode(".", $symptomes));
        $whereString .= (new PathologieHelpers())->getWhereString(3, $array) . "\r\n";

        $res = ($this->_db)->query("SELECT patho.idP AS pidP, patho.desc AS pdesc, symptPatho.idP AS spidP, symptome.idS AS sidS, symptome.desc AS sdesc FROM patho
                                    JOIN symptPatho ON patho.idP = symptPatho.idP
                                    JOIN symptome ON symptPatho.idS = symptome.idS
                                    WHERE patho.idP IN
                                    (
                                        SELECT
                                            patho.idP
                                        FROM
                                            patho
                                        JOIN symptPatho ON patho.idP = symptPatho.idP
                                        JOIN symptome ON symptPatho.idS = symptome.idS
                                        WHERE " . substr($whereString, 0, -6) . "
                                    )
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