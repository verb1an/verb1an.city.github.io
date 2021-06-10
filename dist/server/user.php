<?php
session_start();

include('connection.php');

class User {

    function validReg($reg) {
         foreach($reg as $key) {
              $c = preg_match($key[1], $key[0]);
              if( strlen($key[0]) < $key[2] ) {
                  $c = 0;
              }
              if( $c == 0 ) {
                  return (0);
              }
         }
         return (1);
    } 

    function register($cnct, $data) {
        $res = [];
        foreach($data as $key) {
            array_push($res, $key[0]);
        }
        $query = $cnct->prepare("INSERT INTO sys_users(u_name, u_email, u_login, u_pass, u_phone, u_date) values (
          '$res[0]', '$res[1]', '$res[2]', '$res[3]', '$res[5]', '$res[6]'
        )");
        $query->execute();
        echo "true";
    }

    function login($cnct, $user) {
        $sth = $cnct->prepare("SELECT `id`,`u_login`, `u_pass` FROM `sys_users`");
        $sth->execute();
        $result = $sth->fetchAll();
        $ret = 0;
        foreach($result as $key) {
            if( $key['u_login'] == $user->login && $key['u_pass'] == $user->pass ) {
                $query = $cnct->prepare("SELECT * FROM `sys_users` WHERE id=$key[id]");
                $query->execute();
                $res = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user'] = $res;
                return;
            }
        }
        echo $ret;
    }

    function logout() {
        $_SESSION['user'] = [];
        echo 'true';
    }

    function autologin($cnct) {
        $id = $_SESSION['user']['id'];
        $query = $cnct->prepare("SELECT * FROM `sys_users` WHERE `id` = '$id'");
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = $res;
    }

    function edit($cnct, $edit) {
        $sth = $cnct->prepare("UPDATE `sys_users` SET `u_name` = ?, `u_email` = ?, `u_date` = ?, `u_phone` = ?, `about` = ?, `u_pass` = ? WHERE `id` = " . $_SESSION['user']['id'] );
        $sth->execute($edit);
        $this->autologin($cnct);
        echo 'true';
    }

    function isUnique($cnct, $val) {
        $id = 0;
        if($_SESSION['user']) { $id = $_SESSION['user']['id'];  }
        $sth = $cnct->prepare("SELECT $val->col FROM `sys_users` WHERE `id` NOT IN ($id)");
        $sth->execute();
        $result = $sth->fetchAll();
        $ret = 0;
        foreach($result as $key) {
            if( $key[0] == $val->text ) {
                $ret = true;
            }
        }
        echo $ret;
    }



}

$user = new User;


if($_POST['reg_info']) {
    $reg_info = json_decode($_POST['reg_info']);
    $reg_mass = [
      "name" => [$reg_info->name, '/^[А-Яа-яё -]+$/u', 2],
      "email" => [$reg_info->email, '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', 6],
      "login" => [$reg_info->login, '/^[A-Za-z0-9]+$/', 4],
      "pass"  => [$reg_info->pass, '/[^\._\-\/\*\(\)]/', 6],
      "pass2" => [$reg_info->pass2, '/[^\._\-\/\*\(\)]/', 6],
      "phone" => [$reg_info->phone, '/\d+$/', 0],
      "birth" => [$reg_info->date, '/\d{4}(-|.)\d{2}(-|.)\d{2}/', 0]
    ];

    $date1 = "now";
    $date2 = "$reg_info->date";

    if( $user->validReg($reg_mass) && !$user->isUnique($connect, array("text" => $reg_info->email,"col" => "u_email")) && !$user->isUnique($connect, array("text" => $reg_info->login,"col" => "u_login")) ) {
        $user->register($connect, $reg_mass);
    }
}

if($_POST['log_info']) {
    $user_info = json_decode( $_POST['log_info'] );
    $user->login($connect, $user_info);
}

if($_POST['isunique']) {
    $list = json_decode($_POST['isunique']);
    $user->isUnique($connect, $list);
}

if($_POST['logout']) {
    $user->logout();
}

if($_POST['edit']) {
    $nojson = json_decode($_POST['edit']);
    $user->edit($connect, json_decode($_POST['edit']));
}

if($_POST['autologin']) {
    if($_SESSION['user']) {
        $user->autologin($connect);
    }
}

function datediff($date1, $date2) {
	$diff = strtotime($date2) - strtotime($date1);
	return abs( round(($diff)/(60*60*24)) );
}

?>