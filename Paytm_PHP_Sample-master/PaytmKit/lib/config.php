<?php
$server = "localhost:3307";
$db_user = "root";
$db_pass = "";
$db_name = "fastag";

$db = new PDO('mysql:host=localhost:3307;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>