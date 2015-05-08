<?php
include 'sanitization.php';
$return = "fail";

if (isset($_POST['name']) && isset($_POST['password'])) {
    $username = sanitizeMYSQL($connection,$_POST['name']);
    $password = md5(sanitizeMYSQL($connection, $_POST['password']));
    
    $query = "SELECT * FROM Customer WHERE ID='" . $username. "' AND Password ='" . $password . "'";
    //$query = "SELECT * FROM Customer WHERE Name = 'Joseph Jones' AND Password = 'ee7e4705dd4ac06adfe650c2cdc39bdd'" ;
    $result = mysqli_query($connection, $query);
    if($result){
        $row_count = mysqli_num_rows($result);
        if($row_count==1){
            $row = mysqli_fetch_array($result);
            session_start();
            $_SESSION['start'] = time();
            $_SESSION["username"] = $row["ID"];
            ini_set('session.use_only_cookies', 1);
            $return="success";        
        }
    }
    echo $return;
}
else
    echo $return;
?>