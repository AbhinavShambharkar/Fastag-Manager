<?php
require_once('config.php');
date_default_timezone_set("Asia/kolkata");
session_start();
if(isset($_POST['verify'])){
    $otp = $_POST['otp'];
    $pass = $_POST['password'];


    $stmt = $db->prepare("SELECT * FROM otp WHERE otp=? AND is_expired !=1 AND NOW() <= DATE_ADD(timestamp,INTERVAL 15 MINUTE) ");
    $stmt->execute([$otp]); 
    $count=$stmt->rowCount();

    if (!empty($count)) {
        $stmt = $db->prepare("UPDATE otp SET is_expired =1 WHERE otp=?");
        $stmt->execute([$otp]); 
        $user = $stmt->rowCount();

        $email = $_SESSION["email"];
        $stmt = $db->prepare("UPDATE user SET password=? WHERE email=? ");
        $stmt->execute([$pass,$email]); 
        $user = $stmt->rowCount();

        $message = "Your password has been reset successfully.";
        $sql = "INSERT INTO notifications (email,message,status,Timestamp) VALUES (?,?,0,'" . date("Y-m-d H:i:s") ."')";
        $stmt= $db->prepare($sql);
        $stmt->execute([$email,$message]);

        include "login.html";
        ?>
            <script>
                alert("password changed Succesfully !!!");
            </script>
        <?php 
    }
    else{
        include 'otp.html';
        ?>
            <script>
                alert("Invalid OTP!!");
            </script>
        <?php 
    }



}

?>
