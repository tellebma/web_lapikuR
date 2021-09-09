<?php
include 'connexion.php';
OpenCon();

$id = '';
if (isset($_POST["ident_reg"])) {
    $id = $_POST["ident_reg"];
}
$pass = '';
if (isset($_POST["password_reg"]) {
    $pass = $_POST["password_reg"];
}


if (isset($id) && isset($pass)){
    if (strlen($pass) > 20){$pass = substr($pass, 0, 20);}
    if (strlen($id) > 20){$id = substr($id, 0, 20);}
    $conn = OpenCon();
    $q = "SELECT * FROM `user` WHERE `user` LIKE '".$id."' "
    $result = $conn->query($q);

    if ($result->num_rows > 0) {
      echo "Vous devez trouver un autre nom d'utilisateur !"
    } else {
        $q="INSERT INTO `user` (`id`, `user`, `pass`) VALUES (NULL, '".$id."', '".$pass."')";
    
        if ($conn->query($q) === TRUE) {
            echo "Vous pouvez maintenant vous connecter";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    CloseCon($conn)
}
/*
q=INSERT INTO `user` (`id`, `user`, `pass`) VALUES (NULL, 'maxime', 'password');
*/


?>