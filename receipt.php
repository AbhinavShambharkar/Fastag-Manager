<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyFastag.com</title>
    <link rel="stylesheet" href="receipt.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="receipt">
        <div class="logo">
            <img src="NHAI.jpg" alt="">
            <img src="netc.png" alt="">
        </div>
        <hr>
        <?php
        session_start();
        include_once("config.php");
        $username=$_SESSION["username"];
        $stmt = $db->prepare("SELECT * FROM travel_details WHERE email=?");
        $stmt->execute([$username]); 
        $user = $stmt->fetchAll();

        $Date=$user[0]['Date'];
        $Time=$user[0]['Time'];
        $Toll_crossed=$user[0]['Toll crossed'];
        $Amount=$user[0]['amount'];
        $type=$user[0]['type'];

        $stmt = $db->prepare("SELECT * FROM user_data WHERE email=?");
        $stmt->execute([$username]); 
        $data = $stmt->fetch();

        $name = $data['fullname'];
        $vtype = $data['vtype'];
        ?>


        <div class="details">
            <table class="receipt_table">
                <tbody>
                    <tr>
                        <td>Toll Plaza :</td>
                        <td><?php echo "$Toll_crossed"?></td>
                    </tr>
                    <tr>
                        <td>Owners ID :</td>
                        <td><?php echo "$name"?></td>
                    </tr>
                    <tr>
                        <td>Date & Time :</td>
                        <td><?php echo "$Date"; echo " "; echo "$Time"; ?></td>
                    </tr>
                    <tr>
                        <td>Type of Vehicle :</td>
                        <td><?php echo "$vtype"?></td>
                    </tr>
                    <tr>
                        <td>Type of Journey :</td>
                        <td><?php echo "$type"?></td>
                    </tr>
                    <tr>
                        <td>Amount :</td>
                        <td><?php echo "$Amount"?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="footer">
            <p>*Terms & conditions Applied.</p>
            <p>*Valid Till Mid Night Of issued date</p>
            <h4>Happy Journey</h4>
        </div>
    </div>
</body>
</html>