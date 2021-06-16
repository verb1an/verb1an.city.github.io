<?php 
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include('connection.php');

$sth = $connect->prepare("SELECT `notify` FROM `sys_users` WHERE `id` = 1");

while(1) {
    $sth->execute();
    $result = $sth->fetch();
    if($result['notify'] > 0) {
        echo "data: true\n\n";
    }
    
    
    ob_end_flush();
    flush();
    sleep(1);
}

?>
