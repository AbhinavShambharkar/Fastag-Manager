<?php
require_once('config.php');
if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (email,number,message) VALUES(?,?,?)";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute([$email,$number,$message]);
    if($result){
        include 'fastag.html';
        ?>
            <script>
                alert("Message sent successfully!!");
            </script>
        <?php 
    } 
    else{
        include 'fastag.html';
        ?>
            <script>
                alert("Error occured while sending message!! Please try again");
            </script>
        <?php 
    }
}

?>