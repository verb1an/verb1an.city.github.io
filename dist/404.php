<?php
session_start();
include('server/connection.php');
if ($_SESSION['user']) {
    include_once('server/user.php');
    $user->autologin($connect);
    $user_info = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP - Смотерть все заявки</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="js/index.js"></script>
</head>

<body>

<?php
    include('components/_header.php');
?>

<main class="main">
    <div class="container full">
        <div class="main__inner">
            <?php include('components/_menu.php'); ?>
            <div class="center--col">
                <section class="section" id="err404">
                    <div class="section__inner">
                        <div class="err404 siteblock">
                            <div class="content">
                                <img src="images/system/404.jpg" alt="">
                                <h2 class="name">Честно говоря я без понятия как бы сюда попали, но вам  <a class="link link--nodef" href="index.php">сюда</a></h2>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

</body>
</html>