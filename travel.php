<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="travel.css">
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
<section id="travel_section">
        <h1>Recent Travel History</h1>
        <table class="travel-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Toll Crossed</th>
                    <th>Amount</th>
                    <th>Toll Receipt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        session_start();
                        include_once("config.php");
                        $username=$_SESSION["username"];
                        $stmt = $db->prepare("SELECT * FROM travel_details WHERE email=?");
                        $stmt->execute([$username]); 
                        $user = $stmt->fetchAll();

                        $count = 0;

                        while($count < Sizeof($user))
                        {
                            $Date=$user[$count]['Date'];
                            $Time=$user[$count]['Time'];
                            $Toll_crossed=$user[$count]['Toll crossed'];
                            $Amount=$user[$count]['amount'];

                        echo 
                            '<tr>
                                <td>'.$Date.'</td>
                                <td>'.$Time.'</td>
                                <td>'.$Toll_crossed.'</td>
                                <td>'.$Amount.'</td>
                                <td><a href="receipt.php"><i class="fas fa-download"></i></a></td>
                            </tr>';

                        $count++;   
                        }
                    ?>
                    	
                </tr>
                
                
                
            </tbody>
        </table>
</section>
</body>
</html>