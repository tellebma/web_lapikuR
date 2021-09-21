<?php

class PathologieHelpers{
    function formatCriterias($tabCriteria){
        $array = array();
        foreach($tabCriteria as $criteria){
            array_push($array, str_replace('_', ' ', $criteria));
        }
        return $array;
    }

    function formatString($criteria, $array, $strToAdd){
        foreach($array as $elem){
            if ($elem == 'all'){
                $strToAdd.= $criteria . " = " . $criteria . " AND ";
            }else{
                if ($elem === end($array)){
                    $strToAdd .= $criteria . " = '" . $elem . "' AND ";
                }else{
                    $strToAdd .= $criteria . " = '" . $elem . "' OR ";
                }
                
            }
        }
        return $strToAdd;
    }

    function getWhereString($numCurArg, $array){
        $newString = "";
        switch ($numCurArg){
            case 0:
                $newString = $this->formatString('meridien.nom', $array, $newString);
                break;
            case 1:
                $newString = $this->formatString('patho.desc', $array, $newString);
                break;
            case 2:
                $newString = $this->formatString('keywords.name', $array, $newString);
                break;
            case 3:
                $newString = $this->formatString('symptome.desc', $array, $newString);
                break;
        }
        return $newString;
    }
}

?>