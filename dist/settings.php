<?php  
session_start();
    if($_SESSION['user']) {
        include_once('server/user.php');
        include('server/connection.php');
        $user->autologin($connect);
        $user_info = $_SESSION['user'];
    }else{
        header('Location: login.php');
    }
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Problems</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="libs/validprecept.js"></script>
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
                    <section class="section" id="settings">
                        <div class="section__inner">
                            <div class="settings siteblock">
                                <div class="headers">
                                    <h2 class="title">Настройки - информация</h2>
                                </div>
                                <div class="content">
                                    <div class="field">
                                        <label for="edit--name">Имя</label>
                                        <div class="inp setvalidation"
                                            ><input type="text" name="inpr--login" data-valid-id="0" id="edit--name" class="input-text" value="<?php echo $user_info['u_name'] ?>">
                                            <ul class="precept__list">
                                                <li>Только кириллица</li>
                                                <li>Не менее 2 букв</li>
                                                <li>Не более 45</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--email">Email</label>
                                        <div class="inp setvalidation">
                                            <input type="email" name="inpr--email" data-valid-id="1" id="edit--email" class="input-text" value="<?php echo $user_info['u_email'] ?>">
                                            <ul class="precept__list">
                                                <li>Валидный email</li>
                                                <li>Не менее 2 букв</li>
                                                <li>Не более 45</li>
                                                <li>Уникальный</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--date">Дата рождения</label>
                                        <div class="inp setvalidation">
                                            <input type="date" name="inpr--date" data-valid-id="6" id="edit--date" class="input-text" value="<?php echo $user_info['u_date'] ?>">
                                            <ul class="precept__list">
                                                <li class="hide"></li>
                                                <li class="hide"></li>
                                                <li class="hide"></li>
                                                <li>Вы должны быть старше 14 лет</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--phone">Телефон</label>
                                        <div class="inp setvalidation">
                                            <input type="text" data-valid-id="5" id="edit--phone" class="input-text" value="<?php echo $user_info['u_phone'] ?>">
                                            <ul class="precept__list">
                                                <li>Только цифры</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--about">О себе</label>
                                        <div class="inp"><textarea id="edit--about" class="input-text"><?php echo $user_info['about'] ?></textarea></div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--pass">Пароль</label>
                                        <div class="inp setvalidation"><input type="password" data-valid-id="3" id="edit--pass" class="input-text"  value="<?php echo $user_info['u_pass'] ?>"></div>
                                    </div>
                                    <div class="field">
                                        <label for="edit--image">Изображение</label>
                                        <div class="inp file">
                                            <input name="filename" type="file" id="edit--image" accept="image/jpeg,image/png">
                                            <img id="imgprev" src="#" alt="">
                                        </div>
                                    </div>
                                    <div class="field submit">
                                        <a class="btn btn--def" onclick=" udpateUserInfo()">Сохранить</a>
                                        <a class="link link--def">Отмена</a>
                                    </div>
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