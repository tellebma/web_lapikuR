<?php

function OpenCon(){
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $db = 'web_db'

    //On établit la connexion
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
    return $conn;
}


function CloseCon($conn)
 {
 $conn -> close();
 }
?>