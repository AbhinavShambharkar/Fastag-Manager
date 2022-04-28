<?php
 session_start();
 include_once("config.php");
 $username=$_SESSION["username"];
if(isset($_POST['read'])){


    $stmt = $db->prepare("UPDATE notifications SET status = 1 WHERE email=? ");
    $stmt->execute([$username]); 

    if($stmt){
        include 'notification.php';

    }

    



}

?>