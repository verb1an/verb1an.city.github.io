<?php

$dbname = "cityproblems";
$pass = "root";
$host = "127.0.0.1";
$dbuser = "root";

$connect = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $pass, array(
    PDO::ATTR_PERSISTENT => true
)); 

?>