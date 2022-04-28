<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="help.css">
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
<section>
    <div class="box">
        <h1>We're here to help you</h1>
        <div class="contact">
            <div class="content">
                <img src="customer-service.jpg">
                <h3>+91 9860215374</h3>
            </div>
            <div class="content">
                <img src="mail.jpg">
                <h3>fastagsupport@gmail.com</h3>
            </div>
        </div>
       

       



    </div>
</section>
</body>
</html>