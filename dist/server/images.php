<?php 
session_start();
if($_SESSION['user']) {
    $user = $_SESSION['user'];
}

$rs = explode('.', $_FILES['img']['name'])[1];
$imgname = 'avatar-' . $user['id'] . '_' . rand(99, 999) .  '.' . $rs ;

include('connection.php');

if($rs == 'jpg' || $rs == 'png') {
    if( move_uploaded_file($_FILES['img']['tmp_name'], '../images/users_images/' . $imgname) ) {
        echo 'true';
        $id =  $user['id'];
        $sth = $connect->prepare("UPDATE sys_users SET `image` = 'images/users_images/$imgname' WHERE `id` = $id");
        $sth->execute();
        $_SESSION['user']['image'] = "images/users_images/$imgname";
    }
}