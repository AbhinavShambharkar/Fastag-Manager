<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="notification.css">
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

    <section id="notification_section">
        <h1>Notifications</h1>
        <table class="notification-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        session_start();
                        include_once("config.php");
                        $username=$_SESSION["username"];
                        $stmt = $db->prepare("SELECT * FROM notifications WHERE email=?");
                        $stmt->execute([$username]); 
                        $user = $stmt->fetchAll();

                        $count = 0;


                        while($count < Sizeof($user))
                        {
                            $mark ="";
                            $Date=$user[$count]['datetime'];
                            $message=$user[$count]['message'];
                            $status=$user[$count]['status'];
                           

                            if($status === '0'){
                                        
                                $mark= '<a><i class="fas fa-check"></i></a>';
                               
                        
                            }
                            else{
                                $mark='<a><i class="fas fa-check-double"></i></a>';   
                            }

                        echo 
                            '<tr>
                                <td>'.$Date.'</td>
                                <td>'.$message.'</td>
                                <td>
                                    '.$mark.'
                                </td>
            
                            </tr>';

                        $count++;   
                        }
                    ?>
                    	
                    
                </tr>

            </tbody>
        </table>
        <div class="markread">
            <form action="markread.php" method="post">
                <input type="submit" name="read" value="Mark All As Read">
            </form>
        </div>
</section>
<body>
</html>