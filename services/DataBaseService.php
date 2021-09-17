<?php

class DataBaseService {
    private $_dbName;
    private $_dbHost;
    private $_dbLogin;
    private $_dbPass;
    private \PDO $_pdo;

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
        $this->pdo = new PDO('mysql:dbname=' . $this->_dbName . ';host=' . $this->_dbHost, $this->_dbLogin, $this->_dbPass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * Requests everything from a table without restrictions.
     * 
     * @param Object $pdo Object representing the database.
     * @param String $query Query that is going to be sent to the database.
     * @return Array The result of the request.
     */
    function query($query){
        return ($this->pdo)->query($query);
    }
} 

?>