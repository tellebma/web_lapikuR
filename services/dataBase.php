<?php

class DataBase {
    private $_dbName;
    private $_dbHost;
    private $_dbLogin;
    private $_dbPass;

    function __construct() {
        $this->_dbName = "web_db";
        $this->_dbHost = "localhost";
        $this->_dbLogin = "user";
        $this->_dbPass = "password";
    }

    function connect() {
        $pdo = new PDO('mysql:dbname=' . $this->_dbName . ';host=' . $this->_dbHost, $this->_dbLogin, $this->_dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }

    // Bref, J EN PEUX PLUS DE CETTE VM DE FILS DE PUTE QUI MET DES MAJS POUR RIEN
} 

?>