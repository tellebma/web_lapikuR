<?php

require_once 'services/DataBaseServices.php';

class IndexServices{
    /**
     * Connection to the database
     */
    function __construct(){
        $this->_db = (new DataBaseServices())->connect();
    }

    function elementExist($row,$element){
        $result = ($this->_db)->query("SELECT * FROM `user` WHERE `".$row."` LIKE '".$element."';");
        if ($result->rowCount() > 0){
            return True;
        }
        return False;
    }
    
    function passVerify($name, $pass){
        $log = False;
        if ($this->elementExist("name",$name)){
            $q = "SELECT * FROM `user` WHERE `name` = '".$name."';";
            $result = ($this->_db)->query($q);
            
            while ($row = $result->fetch()){
                $log = password_verify($pass, $row['pass']);                
            }
        }
        return $log;
    }

    function login($name, $pass){
        if ($this->passVerify($name, $pass)){
            session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $name;
            return 1;          
        }
        return 0;
    }

    function register($name, $pass, $mail){
        if (!($this->elementExist("mail",$mail))){
            $res = ($this->_db)->query("INSERT INTO `user` (`mail`, `name`, `pass`) VALUES ( '".$mail."', '".$name."', '".password_hash($pass, PASSWORD_DEFAULT)."')");
            if ($this->elementExist("name",$name)){
                return 1;
            }
        }
        return 0;
    }
} 

?>
