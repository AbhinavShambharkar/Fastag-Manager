<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="recharge.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="sidebar">
        <header>My Profile</header>
        <ul>
            <li><a href="details.php"><i class ="fas fa-qrcode"></i>My Details</a></li>
            <li><a href="recharge.php"><i class ="fas fa-rupee-sign"></i>Recharge Wallet</a></li>
            <li><a href="travel.php"><i class ="fas fa-list"></i>Travel History</a></li>
            <li><a href="notification.php"><i class ="fas fa-bell"></i>Notifications    <?php 
                                                    error_reporting(0);
                                                    session_start();
                                                    include_once("config.php");
                                                    $email = $_SESSION["username"];
                                                    $stmt = $db->prepare("SELECT * FROM notifications WHERE email=? AND status=0");
                                                    $stmt->execute([$email]); 
                                                    $user = $stmt->rowCount();
                                                    echo "(";
                                                    echo "$user";
                                                    echo ")";?></i></a></li>
            <li><a href="help.php"><i class ="fas fa-question-circle"></i>Need Help?</a></li>
            <li><a href="fastag.html"><i class ="fas fa-sign-out-alt"></i>Sign Out</a></li>
        </ul>
    </div>

    <div class="recharge">
        <img src="recharge.jpg" alt=""> 
        <form action="Paytm_PHP_Sample-master/PaytmKit/pgRedirect.php" method="post">
            
                <input type="hidden" name="ORDER_ID" value="<?php echo "ORDS" . rand(10000,99999999);?>">
                <div class="box">
                    <div class="amt">
                        <h3>Enter Amount</h3>
                        <input type="text" placeholder="0" name="TXN_AMOUNT" >
                    </div> 
                
                    <div class="verify">
                        <button type="submit" name = "Recharge" class="nextbtn">Recharge Now  <i class="far fa-paper-plane"></i></button>
                    </div>
                   

                </div>
                
                <p>* Recharge amount should be minimum 200RS</p>
                
        </form>
    </div>
<body>
</html>