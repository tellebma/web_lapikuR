<?php
include 'connexion.php';

$id = '';
if (isset($_POST["ident"])) {
    $id = $_POST["ident"];
}
$pass = '';
if (isset($_POST["password"])) {
    $pass = $_POST["password"];
}

if (isset($id) && isset($pass)){
    //if (strlen($id) > 20){$id = substr($id, 0, 20);}
    //if (strlen($pass) > 20){$pass = substr($pass, 0, 20);}
    $conn = OpenCon();
    $q = "SELECT * FROM `user_db` WHERE `user` LIKE '".$id."' ;";
    $find = FALSE;
    foreach  ($conn->query($q) as $row) {
      if ($row["password"] == $pass){
        $find = TRUE;
        echo "</br>coucou";
        break;
      }
    }
    if ($find == FALSE){
      echo "</br>aucun utilisateur trouvé";
    }

    
}
?>
