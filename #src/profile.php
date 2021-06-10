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
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP - <?php echo $user_info['u_name']; ?></title>
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
                    <section class="section" id="user__info">
                        <div class="section__inner">
                            <div class="user__info siteblock">
                                <div class="content">
                                    <div class="left--side">
                                        <div class="avatar">
                                            <?php if($user_info['image']) {
                                                echo "<img src='$user_info[image]' alt=''>" ;
                                             } ?>
                                        </div>
                                        <a href="settings.php" class="btn btn--def">Редактировать</a>
                                    </div>
                                    <div class="right--side">
                                        <div class="user__name"><?php echo $user_info['u_name']; ?></div>
                                        <div class="user__aboutext"><?php echo $user_info['about']; ?></div>
                                        <div class="user__age"><span>
                                        <?php 
                                            $now = "now";
                                            $diff = strtotime($now) - strtotime($user_info['u_date']);
                                            echo floor(($diff)/(60*60*24*365)); 
                                        ?>
                                        </span> лет</div>
                                        <div class="user__email"><?php echo $user_info['u_email']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section" id="user__items">
                        <div class="section__inner">
                            <div class="user__items siteblock">
                                <div class="legends">
                                    <span>Заявка</span>
                                    <span>Статус</span>
                                </div>
                                <div class="content">
                                    <?php 
                                        $sth = $connect->prepare("SELECT * FROM `sys_items` WHERE `user` = $user_info[id]");
                                        $sth->execute();
                                        $item_src = $sth->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php if($item_src) : ?>
                                    <?php foreach ($item_src as $key) : ?>
                                    <a class="item" href="viewitem.php?id=<?php echo $key['id']; ?>">
                                        <div class="info">
                                            <div class="img"><img src="<?php echo explode(';', $key['images'])[0]; ?>" alt=""></div>
                                            <div class="text">
                                                <h3 class="ident">Объявление № <span><?php echo $key['id']; ?></span></h3>
                                                <div class="name"><?php echo $key['text']; ?></div>
                                                <div class="date__pub"><?php echo $key['date']; ?></div>
                                            </div>
                                        </div>
                                        <div class="status" data--status="<?php echo $key['status']; ?>">Выполнено</div>
                                    </a>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
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