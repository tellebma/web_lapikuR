<?php

class UserManagementService {
    function elementExist($row,$element){
        $result = (Object)(new DataBaseService())->query("SELECT * FROM `user` WHERE `".$row."` LIKE '".$element."';");
        if ($result->rowCount() > 0){
            return True;
        }
        return False;
    }
    
    function passVerify($name, $pass){
        $log = False;
        if ($this->elementExist("name",$name)){
            $q = "SELECT * FROM `user` WHERE `name` = '".$name."';";
            $result = (Object)(new DataBaseService())->query($q); // It already was an object but was generating an error for some reason ?
            
            while ($row = $result->fetch()){ // C'est comme ça pour parse les results
                //FETCH_ASSOC => pour utiliser les $row['name...]
                //print_r($row);
                //print_r($row['pass']);//error
                $log = password_verify($pass,$row->pass); // En gros maintenant faut check si y a un résultat, et s'il y en a un ba on lui donne un token ou une merde comme ça
                
            }
        }

        return $log;
    }

    function getUser($name){
        if ($this->elementExist("name",$name)){
            $q = "SELECT * FROM `user` WHERE `name` = '".$name."';";
            $result = (Object)(new DataBaseService())->query($q); // It already was an object but was generating an error for some reason ?
            
            while ($row = $result->fetch()){ // C'est comme ça pour parse les results
                return $row;
            }
        }
        return False;
    }

    function login($name, $pass){
        //je ne sais pas comment l'utiliser...
        if ($this->passVerify($name, $pass)){
            $usr = $this->getUser($name);
            echo $GLOBALS['twig']->render('index.twig',[
                'name'=>$usr->name,
                'user_session'=>password_hash($usr->name.$usr->pass, PASSWORD_DEFAULT),
            ]);
            

        }
    }


    function register($name, $pass, $mail){
        if (!($this->elementExist("mail",$mail))){
            $res = (new DataBaseService())->query("INSERT INTO `user` (`mail`, `name`, `pass`) VALUES ( '".$mail."', '".$name."', '".password_hash($pass, PASSWORD_DEFAULT)."')");
            print_r($res);
        }
    }
} 

?>
