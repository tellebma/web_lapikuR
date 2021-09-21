<?php

require_once 'helpers/PathologieHelpers.php';

class PathologieCriteresServices{
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    function getDataToDisplay($meridiens, $pathologies, $keywords, $symptomes){
        $i = 0;
        $whereString = "";

        foreach(func_get_args() as $arg){
            $array = (new PathologieHelpers())->formatCriterias(explode(".", $arg));
            $whereString .= (new PathologieHelpers())->getWhereString($i, $array) . "\r\n";
            $i++;
        }

        $res = ($this->_db)->query("SELECT DISTINCT patho.idP AS pidP, patho.desc AS pdesc, symptPatho.idP AS spidP, symptome.idS as sidS, symptome.desc as sdesc FROM patho 
                                    JOIN symptPatho ON patho.idP = symptPatho.idP 
                                    JOIN symptome ON symptPatho.idS = symptome.idS 
                                    JOIN meridien ON patho.mer = meridien.code
                                    JOIN keySympt ON symptome.idS = keySympt.idS
                                    JOIN keywords ON keySympt.idK = keywords.idK
                                    WHERE "
                                    .
                                    substr($whereString, 0, -6)
                                    . 
                                    " ORDER BY patho.idP");

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
