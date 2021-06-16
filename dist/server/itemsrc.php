<?php 

session_start();
if($_SESSION['user']) {
    $user_info = $_SESSION['user'];
}

$rs = explode('.', $_FILES['img']['name'])[1];
$imgname = 'u' . $user['id'] . '_i' . rand(9999, 99999999) . '.' . $rs;

if($_FILES['img']) {
    if($rs == 'jpg' || $rs == 'png') {
        if( move_uploaded_file($_FILES['img']['tmp_name'], '../images/items_images/' . $imgname) ) {
            echo 'images/items_images/' . $imgname;
        }else{
            echo 'false';
        }
    }
}

if($_POST['del']) {
    unlink('../' . $_POST['del']);
}

include('connection.php');
if($_POST['newpost']) {
    $newpost = json_decode($_POST['newpost']);

    $query = $connect->prepare("INSERT INTO `sys_items` (`name`, `text`, `images`, `cats`, `show_name`, `date`, `user`) VALUES ('$newpost->name', '$newpost->text', '$newpost->images', '$newpost->cats', '$newpost->show_name', '$newpost->date', $user_info[id])");
    $query->execute();
    echo 'true';
}

if($_POST['editpost']) {
    $editpost = json_decode($_POST{'editpost'});
    $query = $connect->prepare("SELECT `version` FROM `sys_items` WHERE id =$_POST[item]");
    $query->execute();
    $version = $query->fetch(PDO::FETCH_ASSOC);

    $query = $connect->prepare("UPDATE `sys_items` SET `name` = ?, `text` = ?, `images` = ?, `cats` = ?, `show_name` = ?, `version` = ? WHERE id = $_POST[item]");
    $query->execute(array(
        "$editpost->name",
        "$editpost->text",
        "$editpost->images",
        "$editpost->cats",
        "$editpost->show_name",
        $version['version']+0.01
    ));

    $query = $connect->prepare("SELECT `version` FROM `sys_items` WHERE id =$_POST[item]");
    $query->execute();
    $newversion = $query->fetch(PDO::FETCH_ASSOC);

    if($version['version'] < $newversion['version']) {
        echo 'true';
    }
    
}

if($_POST['disabledpost']) {
    $query = $connect->prepare("UPDATE `sys_items` SET `status` = 'disabled' WHERE `id` = $_POST[disabledpost]");
    $query->execute();

    $query = $connect->prepare("SELECT `status` FROM `sys_items` WHERE id =$_POST[disabledpost]");
    $query->execute();
    $status = $query->fetch(PDO::FETCH_ASSOC);

    if($status['status'] == 'disabled') {
        echo 'true';
    }
}

if($_POST['status']) {
    $query = $connect->prepare("SELECT `status` FROM `sys_items` WHERE `id` = $_POST[itemid]");
    $query->execute();
    $status = $query->fetch();

    $query = $connect->prepare("UPDATE `sys_items` SET `status` = '$_POST[status]' WHERE `id` = $_POST[itemid]");
    $query->execute();

    $query = $connect->prepare("SELECT `status` FROM `sys_items` WHERE `id` = $_POST[itemid]");
    $query->execute();
    $newstatus = $query->fetch();

    if($newstatus['status'] != $status['status']) {
        echo 'true';
    }else{
        echo 'false';
    }
    
}