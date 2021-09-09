<?php
include 'connexion.php';

$id = '';
if (isset($_POST["ident"])) {
    $id = $_POST["ident"];
}
$pass = '';
if (isset($_POST["password"]) {
    $pass = $_POST["password"];
}
if (isset($id) && isset($pass)){
    if (strlen($id) > 20){$id = substr($id, 0, 20);}
    if (strlen($pass) > 20){$pass = substr($pass, 0, 20);}
    $conn = OpenCon();
    $q = "SELECT * FROM `user` WHERE `user` LIKE '".$id."' "
    $result = $conn->query($q);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if ($row["password"]== $pass){
            #login = True;
        }
      }
    } else {
      echo "aucun utilisateur trouvé";
    }

    CloseCon($conn)
}
?>
