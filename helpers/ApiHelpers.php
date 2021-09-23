<?php

class ApiHelpers{
    /**
     * Sets headers for the packet that's about to be sent. Used to tell the client we are sending Json Data and that it should be treated accordingly
     */
    function setHeaders(){
        header('Access-Control-Allow-Origin');
        header('Content-type: application/json');
    }
}

?>