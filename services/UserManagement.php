<?php

require 'services/DataBase.php';

class UserManagement {
    function login($ident, $pass){
        $result = ((new DataBase())->connect())->query("SELECT * FROM `user` WHERE `name` LIKE '".$ident."' AND `pass` LIKE '".$pass."';");
        while ($row = $result->fetch()){ // C'est comme ça pour parse les results
            //$hash = base64_encode($ident.$pass)
            sessionStorage.setItem('user_session', base64_encode($ident.$pass));
            //print_r($row); // En gros maintenant faut check si y a un résultat, et s'il y en a un ba on lui donne un token ou une merde comme ça
        }
    }
    function register($id,$pass,$email){
        $result = ((new DataBase())->connect())->query("SELECT * FROM `user` WHERE `name` LIKE '".$id."';");
        $find = FALSE;
        foreach  ($result as $row) {
            if ($row["user"] == $id){
              $find = TRUE;
              break;
            }
          }
          if ($find == TRUE){
            print_r("Vous devez trouver un autre nom d'utilisateur !");
          }else {
              $result = ((new DataBase())->connect())->query("INSERT INTO `user_db` (`id`, `name`, `pass` , `email`) VALUES (NULL, '".$id."', '".$pass."', '".$email."');");
            if ($result === TRUE) {
                echo "Vous pouvez maintenant vous connecter");
            } else {
                print_r("Error: " . $q . "<br>" . $conn->error);
            }
    }
    }
} 

?>
