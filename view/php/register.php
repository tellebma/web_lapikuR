<?php
include 'connexion.php';
OpenCon();

$id = '';
if (isset($_POST["ident_reg"])) {
    $id = $_POST["ident_reg"];
}
$pass = '';
if (isset($_POST["password_reg"])) {
    $pass = $_POST["password_reg"];
}
$email = '';
if (isset($_POST["mail"])) {
    $email = $_POST["mail"];
}


if (isset($id) && isset($pass) && isset($email)){
    if (strlen($pass) > 20){$pass = substr($pass, 0, 20);}
    if (strlen($id) > 20){$id = substr($id, 0, 20);}
    if (strlen($email) > 30){$email = substr($email, 0, 30);}
    $conn = OpenCon();
    $q = "SELECT * FROM `user_db` WHERE `user` LIKE '".$id."' ";
    $find = FALSE;
    foreach  ($conn->query($q) as $row) {
        if ($row["user"] == $id){
          $find = TRUE;
          break;
        }
      }
      if ($find == TRUE){
        echo "Vous devez trouver un autre nom d'utilisateur !";
      }else {
        $q="INSERT INTO `user_db` (`id`, `user`, `password` , `email`) VALUES (NULL, '".$id."', '".$pass."', '".$email."')";
    
        if ($conn->query($q) === TRUE) {
            echo "Vous pouvez maintenant vous connecter";
        } else {
            echo "Error: " . $q . "<br>" . $conn->error;
        }
    }
    
}
/*
q=INSERT INTO `user` (`id`, `user`, `pass`) VALUES (NULL, 'maxime', 'password');
*/


?>