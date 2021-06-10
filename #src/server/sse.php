<?php 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include('connection.php');

$sth = $connect->prepare("SELECT `id`,`u_login`, `u_pass` FROM `sys_users`");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
$return = json_encode($result);

while(1) {
    echo "data: $return\n\n";

    ob_end_flush();
    flush();
    sleep(1);
}



?>
