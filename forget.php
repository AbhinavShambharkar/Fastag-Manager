<?php
require_once('config.php');
session_start();
date_default_timezone_set("Asia/kolkata");
if(isset($_POST['sendotp'])){
    $email = $_POST['email'];

    $_SESSION['email']=$email;

    $stmt = $db->prepare("SELECT * FROM user_data WHERE email=?");
    $stmt->execute([$email]); 
    $user = $stmt->fetch();

    if ($user) {
        include 'reenter.html';

        $otp = rand(100000,999999);
        
        $to_email = $email;
        $subject = "OTP for fastag management system";
        $body = "One Time Password for resetting your password on fastag management System is (otp is Valid Only for 15 minutes)  ".$otp ;
        $headers = "From: sender email";

        if (mail($to_email, $subject, $body, $headers)) {
           /// $date=date("Y-m-d H:i:s");
            $sql = "INSERT INTO otp (email,otp,is_expired,Timestamp) VALUES (?,?,0,'" . date("Y-m-d H:i:s") ."')";
            $stmt= $db->prepare($sql);
            $stmt->execute([$email,$otp]);


        } else {
            echo "Email sending failed...";
        }   
    } else {
        include 'forget.html';
        ?>
            <script>
                alert("User With This Email Id does not Exists!!");
            </script>
        <?php 
    }


}
?>

