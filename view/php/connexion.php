<?php

function OpenCon(){
    $username = 'user';
    $password = 'password';

    
    // Create connection
    $conn = new PDO('mysql:host=localhost;dbname=web_db', $username, $password);

    // Check connection
    
    return $conn;

}

?>