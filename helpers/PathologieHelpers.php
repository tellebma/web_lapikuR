<?php

class PathologieHelpers{
    /**
     * Formats criterias sent by the client. Will replace any ' ' by a '_'.
     * Example : "Gros Intestin" => "Gros_Intestin"
     * 
     * @param Array $tabCriteria, An array of elements chosen by the Client (Ex : ["Poumon", "Gros Intestin", ...])
     * @return Array An array with all the elements formated
     */
    function formatCriterias($tabCriteria){
        $array = array();
        foreach($tabCriteria as $criteria){
            array_push($array, str_replace('_', ' ', $criteria));
        }
        return $array;
    }

    /**
     * Creates a string that can be interpreted in SQL language according to an array and a criteria passed in paramaters.
     * Example : $criteria="crittest" & $array=["TestOne", "TestTwo"] => $output = "(critest="TestOne" OR critTest="TestTwo") AND"
     * 
     * @param String $criteria, A string that corresponds to the criteria in the database (Ex : 'meridien.nom', 'symptome.desc'...)
     * @param Array $array, An array of the elements selected by the client, already formated
     * @param String $strToAdd, String that will be concatenated in order to form the exploitable string
     * @return String The entire string corresponding to a criteria populated by the element of an array formated to fit MySQL requests
     */
    function formatString($criteria, $array, $strToAdd){
        $isFirst = true;
        foreach($array as $elem){
            if ($elem == 'all'){
                $strToAdd.= $criteria . " = " . $criteria . " AND ";
            }else{
                if (count($array)===1){
                    $strToAdd .= $criteria . " = \"" . $elem . "\" AND ";
                }
                else if ($isFirst){
                    $strToAdd .= "(" . $criteria . " = \"" . $elem . "\" OR ";
                    $isFirst = False;
                }
                else if ($elem === end($array)){
                    $strToAdd .= $criteria . " = \"" . $elem . "\") AND ";
                }else{
                    $strToAdd .= $criteria . " = \"" . $elem . "\" OR ";
                }
                
            }
        }
        return $strToAdd;
    }

    /**
     * Depending on the number given in paramaters, will return a string formated by 'formatString(...)' with a given criteria
     * 
     * @param Int $numCurArg, A number that'll be used to determine which case should be executed
     * @param Array $array, An array populated with the elements selected by the client but already formated
     * @return String $newString, The entire string corresponding to a criteria populated by the element of an array formated to fit MySQL requests
     */
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