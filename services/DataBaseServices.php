<?php

// Pour que ça fonctionne -> Faut faire un $db = new DatabaseServices(); partout ou y a vait des call de db avant, et apres refaire la mêmer equete avec $db a la place de (new DAtabaseServices())

class DataBaseServices{
    private $_dbName;
    private $_dbHost;
    private $_dbLogin;
    private $_dbPass;
    private $_pdo;

    /**
     * Constructor, initialise value needed to connect to the database.
     * 
     * @param String $_dbName Name of the database.
     * @param String $_dbHost Name of the host of the databse.
     * @param String $_dbLogin Login needed to connect to the databse.
     * @param String $_dbPass Pass needed to connect to the database.
     */
    function __construct(){
        $this->_dbName = "web_db";
        $this->_dbHost = "localhost";
        $this->_dbLogin = "user";
        $this->_dbPass = "password";
    }

    /**
     * Connection to the database
     * 
     * @return Object Represents the connection to the database
     */
    function connect(){
        $this->_pdo = new PDO('mysql:dbname=' . $this->_dbName . ';host=' . $this->_dbHost, $this->_dbLogin, $this->_dbPass);
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->_pdo;
    }
} 

?>