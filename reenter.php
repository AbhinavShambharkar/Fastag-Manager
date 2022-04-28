<?php
session_start();
require_once('config.php');
if(isset($_POST['changepass'])){
    $otp = $_POST['otp'];
    $newpass= $_POST['newpass']; 

    $email = $_SESSION["email"];

    $stmt = $db->prepare("SELECT * FROM otp WHERE otp=? AND is_expired !=1 AND NOW() <= DATE_ADD(timestamp,INTERVAL 15 MINUTE) ");
    $stmt->execute([$otp]); 
    $count=$stmt->rowCount();

    if (!empty($count)) {

        $stmt = $db->prepare("UPDATE otp SET is_expired =1 WHERE otp=? ");
        $stmt->execute([$otp]); 
        $user = $stmt->rowCount();

        $stmt = $db->prepare("UPDATE user_data SET password = ? WHERE email=? ");
        $stmt->execute([$newpass,$email]); 
        $user = $stmt->rowCount();

        include 'fastag.html';
        ?>
            <script>
                alert("Password Changed Successfully !!!");
            </script>
        <?php 

    }
    else{
        include 'forget.html';
        ?>
            <script>
                alert("Invalid OTP !!");
            </script>
        <?php 
    }



}

?>