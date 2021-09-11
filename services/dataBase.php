<?php

class DataBase {
    private $_dbName;
    private $_dbHost;
    private $_dbLogin;
    private $_dbPass;

    /**
     * Constrctor, initialise value needed to connect to the database.
     * 
     * @param String $_dbName Name of the database.
     * @param String $_dbHost Name of the host of the databse.
     * @param String $_dbLogin Login needed to connect to the databse.
     * @param String $_dbPass Pass needed to connect to the database.
     */
    function __construct() {
        $this->_dbName = "web_db";
        $this->_dbHost = "localhost";
        $this->_dbLogin = "user";
        $this->_dbPass = "password";
    }

    /**
     * Connects to the database.
     * 
     * @return Object $pdo Represents the database.
     */
    function connect() {
        $pdo = new PDO('mysql:dbname=' . $this->_dbName . ';host=' . $this->_dbHost, $this->_dbLogin, $this->_dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }

    /**
     * Requests everything from a table without restrictions.
     * 
     * @param Object $pdo Object representing the database.
     * @param String $tableName Name of the table that we want to retrieve data from.
     * @param String $orderElement Name of the element of the dable we want to use in order to order data received. 
     * @return Array The result of the request.
     */
    function queryAll($pdo, $tableName, $orderElement){
        return $pdo->query('SELECT * FROM ' . $tableName . ' ORDER BY ' . $orderElement . ' DESC');
    }
} 

?>