<?php

class ApiHelpers{
    function setHeaders(){
        header('Access-Control-Allow-Origin');
        header('Content-type: application/json');
    }
}

?>