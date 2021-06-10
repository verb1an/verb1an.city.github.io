<?php 
    session_start();
    if($_SESSION['user']) {
        header('Location: index.php');
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP - register new account</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="libs/validprecept.js"></script>
    <script src="js/index.js"></script>
    
</head>
<body>
<?php include('components/_header.php') ?>
<main class="main">
    <div class="container full">
        <div class="main__inner">
            <?php include('components/_menu.php'); ?>
            <div class="center--col">
                <section class="section" id="registerform">
                    <div class="section__innner">
                        <div class="signinform siteblock">
                            <div class="content">
                                <div class="title">Регистрация</div>
                                <div class="inp setvalidation">
                                    <input name="inpr--name" type="text" data-valid-id="0" class="input-text" placeholder="Введите имя">
                                    <ul class="precept__list">
                                        <li>Только кириллица</li>
                                        <li>Не менее 2 букв</li>
                                        <li>Не более 45</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--email" type="email" data-valid-id="1" class="input-text" placeholder="Введите email">
                                    <ul class="precept__list">
                                        <li>Валидный email</li>
                                        <li>Не менее 2 букв</li>
                                        <li>Не более 45</li>
                                        <li>Уникальный</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--login" type="text" data-valid-id="2" class="input-text" placeholder="Введите логин">
                                    <ul class="precept__list">
                                        <li>Только латиница</li>
                                        <li>Не менее 2 букв</li>
                                        <li>Не более 45</li>
                                        <li>Уникальный</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--pass" type="text" data-valid-id="3" class="input-text" placeholder="Введите пароль">
                                    <ul class="precept__list">
                                        <li>Буквы и цифры</li>
                                        <li>Не менее 6 букв</li>
                                        <li>Не более 45</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--pass2" type="text" data-valid-id="4" class="input-text" placeholder="Подтвердите пароль">
                                    <ul class="precept__list">
                                        <li>Буквы и цифры</li>
                                        <li>Не менее 6 букв</li>
                                        <li>Не более 45</li>
                                        <li>Должен совпадать с первым</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--phone" type="text" data-valid-id="5" class="input-text" placeholder="Номер телефона">
                                    <ul class="precept__list">
                                        <li>Только цифры</li>
                                    </ul>
                                </div>
                                <div class="inp setvalidation">
                                    <input name="inpr--date" type="date" data-valid-id="6" class="input-text" placeholder="">
                                    <ul class="precept__list">
                                        <li class="hide"></li>
                                        <li class="hide"></li>
                                        <li class="hide"></li>
                                        <li>Вы должны быть старше 14 лет</li>
                                    </ul>
                                </div>
                                <a class="btn btn--def" onclick="register()">Регистрация</a>
                                <span class="posttext">Уже есть аккаунт? <a href="login.php" class="link link--def">Войти</a></span>
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