<?php  
    session_start();
    include('server/connection.php');
    if($_SESSION['user']) {
        include('server/user.php');
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
    <title>City Problems</title>
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

                <?php 
                    $all=$connect->query("SELECT COUNT(*) as count FROM sys_items")->fetchColumn();
                    $alltrue=$connect->query("SELECT COUNT(*) as count FROM sys_items WHERE `status` = 'true'")->fetchColumn();
                    $allfalse=$connect->query("SELECT COUNT(*) as count FROM sys_items WHERE `status` = 'false'")->fetchColumn();
                ?>

                <div class="center--col">
                    <section class="section" id="bodyhead">
                            <div class="section__inner">
                                <div class="stat siteblock">
                                    <div class="content">
                                        <div class="stat__line stat--1">
                                            <h3 class="num"><?php echo $all; ?></h3>
                                            <span class="name">Всего</br> заявок</span>
                                        </div>
                                        <div class="stat__line stat--2">
                                            <h3 class="num"><?php echo $alltrue; ?></h3>
                                            <span class="name">Выполненных заявок</span>
                                        </div>
                                        <div class="stat__line stat--3">
                                            <h3 class="num"><?php echo $allfalse; ?></h3>
                                            <span class="name">Заявок в обработке</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <section class="section" id="most">
                        <div class="section__inner">
                            <div class="most__links siteblock">
                                <div class="content">
                                    <a href="<?php if($user_info) { echo 'item.php'; }else{ echo 'login.php'; } ?>" class="item gray siteblock">
                                        <h3 class="name">Оставить заявку</h3>
                                        <div class="posttext">Ответ в течении суток</div>
                                    </a>
                                    <a href="allitems.php" class="item small siteblock">
                                        <h3 class="name">Посмотреть все заявки</h3>
                                        <div class="posttext"><span class="num"><?php echo $all; ?></span> Заявок</div>
                                    </a>
                                    <a href="addreview.php" class="item small siteblock">
                                        <h3 class="name">Оставить отзыв</h3>
                                        <div class="posttext"><span class="i-star"></span>4.4<br>Средний балл</div>
                                    </a>
                                    <a href="mailto:tabyshkinalex@gmail.com" class="item siteblock">
                                        <h3 class="name">Помощь</h3>
                                        <div class="posttext"> Написать письмо<br>администратору</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php 
                        $sth = $connect->prepare("SELECT `id`, `images` FROM `sys_items` ORDER BY `date` DESC, `id` DESC LIMIT 4");
                        $sth->execute();
                        $items_src = $sth->fetchAll();
                        $images = [];
                        foreach($items_src as $key) {
                            array_push( $images, explode( ';', $key['images'])[0] );
                        }
                    ?>

                    <section class="section" id="lastitems">
                        <div class="section__inner">
                            <div class="lastitems siteblock">
                                <div class="headers">
                                    <h2 class="title">Последние решённые<br>заявки</h2>
                                </div>
                                <div class="content">
                                    <div class="slider" data--slider="defailt-line-clider">
                                        <a class="item">
                                            <div class="img"><img src="<?php echo $images[0]; ?>" alt=""></div>
                                            <h3 class="name">Заявка №<?php echo $items_src[0]['id']; ?></h3>
                                        </a>
                                        <a class="item" style="left: 380px;">
                                            <div class="img"><img src="<?php echo $images[1]; ?>" alt=""></div>
                                            <h3 class="name">Заявка №<?php echo $items_src[1]['id']; ?></h3>
                                        </a>
                                        <a class="item" style="left: 380px;">
                                            <div class="img"><img src="<?php echo $images[2]; ?>" alt=""></div>
                                            <h3 class="name">Заявка №<?php echo $items_src[2]['id']; ?></h3>
                                        </a>
                                        <a class="item" style="left: 380px;">
                                            <div class="img"><img src="<?php echo $images[3]; ?>" alt=""></div>
                                            <h3 class="name">Заявка №<?php echo $items_src[3]['id']; ?></h3>
                                        </a>
                                    </div>

                                    <div class="controlls">
                                        <a href="allitems.php" class="btn btn--nodef">Смотерть все</a>
                                        <div class="cont">
                                            <a class="ct left"><span class="i-angle"></span></a>
                                            <a class="ct right"><span class="i-angle"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section" id="about">
                        <div class="section__inner">
                            <div class="about siteblock">
                                <div class="headers">
                                    <h2 class="title">О нас</h2>
                                    <h3 class="subtitle">Немного о проекте и прочее</h3>
                                </div>
                                <div class="content">
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, possimus labore maiores expedita praesentium eos corporis, magni accusamus iure hic asperiores quidem beatae inventore officiis distinctio rem quis!</p>
                                        <p>Error excepturi sunt tempore ex laboriosam omnis accusamus aperiam et doloremque, eligendi voluptas corporis ipsum reiciendis rerum dolor optio quis id debitis natus perspiciatis ipsam, dolorum odio nemo explicabo.</p>
                                        <p>Dolor voluptatum quo facere culpa autem quasi ex veniam necessitatibus atque aliquid illo aliquam ipsa, quis sint commodi alias aut eaque eligendi. Iure praesentium ipsum sit blanditiis natus quae nesciunt quisquam perferendis illum excepturi cum obcaecati veritatis culpa nobis, ducimus ea. Est, optio?</p>
                                    </div>
                                    <div class="slider">
                                        <div class="mainimg">1</div>
                                        <div class="mainimg">2</div>
                                        <div class="mainimg">3</div>
                                        <div class="mainimg">4</div>
                                    </div>
                                    <div class="thumbs">
                                        <a class="th" data--slider-active="0"></a>
                                        <a class="th" data--slider-active="1"></a>
                                        <a class="th" data--slider-active="2"></a>
                                        <a class="th" data--slider-active="3"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section" id="contact">
                        <div class="section__inner">
                            <div class="contact siteblock">
                                <div class="content">
                                    <div class="info">
                                        <h3 class="title">Контакты</h3>
                                        <a href="tel:+999999999" class="numphone">+7 (999) 999 99-99</a>
                                        <a href="" class="numadress">Адрес: ул. Такая-то Такая-то, дом такой-то №3</a>
                                        <div class="social">
                                            <a href="" target="_blank" class="link"><span class="i-vk"></span></a>
                                            <a href="" target="_blank" class="link"><span class="i-telegram"></span></a>
                                            <a href="" target="_blank" class="link"><span class="i-instagram"></span></a>
                                        </div>
                                    </div>
                                    <div class="map"><img src="images/customized-map-1.jpg" alt=""></div>
                                    <div class="subus">
                                        <h4 class="title">Подпишитесь на нашу рассылку и будьте в курсе событий</h4>
                                        <div class="inp"><input type="text" class="input-text" placeholder="Ваш Email"></div>
                                        <a class="btn btn--def">Подписаться</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                <section class="section right--col">
                    <div class="section__inner">
                        <div class="last__items siteblock">
                            <div class="content">
                                123
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    
    <div class="message__form"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            defaultSlider({
                target: `#lastitems .slider`,
                controlls: `#lastitems .controlls .cont .ct`,
                line: document.querySelector(`#lastitems .slider .item`).getBoundingClientRect().width + 20,
            });
            defaultSlider({
                target: `#about .slider`,
                thumbs: `.about .thumbs .th`,
                line: document.querySelector(`#about .slider .mainimg`).getBoundingClientRect().width + 10,
            });
        })
    </script>

</body>

</html>