<?php

class PathologieService {
    function getPathologies(){
        $res = (new DataBaseService())->query("SELECT * FROM patho");
        return $res;
    }
} 

?>
