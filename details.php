<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="details.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="sidebar">
        <header>My Profile</header>
        <ul>
            <li><a href="#details_section"><i class ="fas fa-qrcode"></i>My Details</a></li>
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
    <section class="details_section">
        <div class="container">
            <div class="profile_header">
                <div class="profile_img">
                    <div class="pic">
                        <?php
                            error_reporting(0);
                            session_start();
                            include_once("config.php");
                            $username=$_SESSION["username"];
    
                            $stmt = $db->prepare("SELECT * FROM user_data WHERE email=?");
                            $stmt->execute([$username]); 
                            $user = $stmt->fetch();

                            $image = "<img src='image/".$user["photo"]."'>";
                            echo "$image"; 
                        ?>
                    </div>
                </div>
                <div class="profile_name">
                    <h3>Welcome,</h3>
                    <h3><?php echo '<span >' . $user['fullname'] . '</span>';?></h3>
                </div>  

                <div class="wallet">
                    <h3>Wallet</h3>
                    <h3>Balance</h3>
                    <?php
                            error_reporting(0);
                            session_start();
                            include_once("config.php");
                            $username=$_SESSION["username"];
    
                            $stmt = $db->prepare("SELECT * FROM wallet WHERE email=?");
                            $stmt->execute([$username]); 
                            $bal = $stmt->fetch();
                            
                    ?>
                    <h4><?php echo '<span >' . $bal[2] . '</span>';?></h4>
                </div>
            </div>
            <div class="main_body">
                <div class="info_side">
                    <div class="edit">
                        <i class="fas fa-edit"></i>
                    </div> 
                    <div class="profile_info">
                        <ul>
                            <li><a><i class="fas fa-user"></i><?php echo '<span >' . $user['fullname'] . '</span>';?></a></li>
                            <div class="phone">
                                <li><a><i class ="fa fa-phone fa-2x"></i><?php echo '<span >' . $user['phonenumber'] . '</span>';?></a></li>
                            </div>
                            <li><a><i class ="fa fa-envelope fa-2x"></i><?php echo '<span >' . $user['email'] . '</span>';?></a></li>
                            <li><a><i class="fas fa-map-marker-alt"></i><?php echo '<span >' . $user['address'] . '</span>';?></a><a><?php echo '<span >' . $user['pincode'] . '</span>';?></a><br><a><?php echo '<span >' . $user['state'] . '</span>';?></a></li>
                            <li><a><i class="fas fa-tag"></i><span>NPCI Vehicle class :</span><?php echo '<span >' . $user['npci'] . '</span>';?></a></li>
                            <li><a><i class="fas fa-car-side"></i><span>Vehicle Type :</span><?php echo '<span >' . $user['vtype'] . '</span>';?></a></li>
                        </ul>
                    </div>
                    
                </div>
                <div class="profile_side">
                    <div class="tab">
                        <button class="tablinks" onclick="opentab(event, 'Fastag')">Fastag</button>
                        <button class="tablinks" onclick="opentab(event, 'Document')">Documents</button>
                    </div>

                    <div id="Fastag" class="tabcontent" style="display:block">
                        <div class="code">
                            <div class="tag">
                                <?php
                                    $email=$_SESSION["username"];
                                    $stmt = $db->prepare("SELECT * FROM user_data  WHERE email=?");
                                    $stmt->execute([$email]); 
                                    $user = $stmt->fetch();

                                    $code = $user['fastag'];
                                    echo "<img alt='Image' src='barcode.php?codetype=Code39&size=50&text=".$code."' /> ";   
                                ?>
                            
                            </div>
                            <div class="Download">
                                <button><a href=<?php $code = $user['fastag']; echo '"barcode.php?codetype=Code39&size=50&text=".$code.';?> download><i class="fas fa-download"></i> Download</a></button>
                            </div>
                            <p>To receive your Fastag Code through E-Mail <a href="codemail.php">Click Here</a></p>
                        </div>
                    </div>

                    <div id="Document" class="tabcontent">
                        <script>
                            var val = <?php $user['aadhar'] ?> ;
                        </script>
                            <table class="my-table">
                                <thead>
                                    <tr>
                                    
                                        <th>Document</th>
                                        <th>Uploaded Document</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>	
                                    
                                        <td>Aadhar Card</td>
                                        <td><?php echo '<span >' . $user['aadhar'] . '</span>' ?> </td>
                                        <td><a href="image/<?php echo $user['aadhar']?>" download><i class="fas fa-download" name="aadhar" ></i></a></td>
                                    </tr>
                                    <tr>	
                                    
                                        <td>Driving License</td>
                                        <td><?php echo '<span >' . $user['license'] . '</span>' ?> </td>
                                        <td><a href="image/<?php echo $user['license']?>" download><i class="fas fa-download" name="license" ></i></a></td>
                                    </tr>
                                    <tr>	
                                    
                                        <td>Registration Certificate</td>
                                        <td><?php echo '<span >' . $user['rc'] . '</span>' ?> </td>
                                        <td><a href="image/<?php echo $user['rc']?>" download><i class="fas fa-download" name="rc" ></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="details.js"></script>
</body>
</html>