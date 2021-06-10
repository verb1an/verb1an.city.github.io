<?php 
    session_start();
    if($_SESSION['user']) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP - Авторизация</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="js/index.js"></script>
</head>

<body>
<?php include('components/_header.php'); ?>
<main class="main">
    <div class="container full">
        <div class="main__inner">
            <?php include('components/_menu.php'); ?>
            <div class="center--col">
                <section class="section" id="singinform">
                    <div class="section__innner">
                        <div class="signinform siteblock">
                            <div class="content">
                                <div class="title">Авторизация</div>
                                <div class="inp"><input name='linp--login' type="text" class="input-text" placeholder="Введите логин"></div>
                                <div class="inp"><input name='linp--pass' type="text" class="input-text" placeholder="Введите пароль"></div>
                                <a class="btn btn--def" onclick="login()">Войти</a>
                                <span class="posttext">Ещё нет аккаунта? <a href="register.php" class="link link--def">Зарегестрируйтесь</a></span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

<div class="message__form"></div>
</body>

</html>