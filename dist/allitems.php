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

<?php 
    $page = 1;
    if( isset($_GET['page']) && !empty($_GET['page'])) { 
        $page = $_GET['page'];
    }

    $sth = $connect->prepare("SELECT MAX(`id`) FROM `sys_items`");
    $sth->execute();
    $max = $sth->fetch();
    echo ($max[0]+9)-$page*9;
    
    $sth = $connect->prepare("SELECT * FROM sys_items WHERE `id` <= (($max[0]+9)-$page*9) AND `status` NOT IN ('disabled') ORDER BY `id` DESC LIMIT 9");
    $sth->execute();
    $items_src = $sth->fetchAll();

    $members=$connect->query("SELECT COUNT(*) as count FROM sys_items")->fetchColumn();
?>

<main class="main">
    <div class="container full">
        <div class="main__inner">
            <?php include('components/_menu.php'); ?>
            <div class="center--col">
                <div class="section" id="allitems">
                    <div class="section__inner">
                        <div class="content">
                            <div class="additem siteblock" style="background: transparent; box-shadow: none; margin: 0;">
                                <a href="item.php" class="btn btn--def" style="width: 100%; max-width: 100%;">Добавить новую заявку</a>
                            </div>
                            <?php foreach($items_src as $key) : ?>
                            <a href="viewitem.php?id=<?php echo $key['id'] ?>" class="item siteblock">
                                <?php $img = explode(';', $key['images'])[0]; ?>
                                <div class="img"><img src="<?php echo $img; ?>" alt=""></div>
                                <h3 class="id">Заявка №<?php echo $key['id']; ?>
                                    <?php if($key['show_name']) : ?>
                                        <?php 
                                            $un_sth = $connect->prepare("SELECT `u_name` FROM `sys_users` WHERE `id` = $key[user]");
                                            $un_sth->execute();
                                            $u_name = $un_sth->fetch()[0];
                                        ?>
                                        <span><?php echo $u_name; ?></span>
                                    <?php endif;?>
                                </h3>
                                <div class="name"><?php echo $key['name']; ?></div>
                                <div class="date">На сайте с <?php echo $key['date']; ?></div>
                                <span class="status" style="display: block;" data--status="<?php echo $key['status']; ?>">Выполнено</span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <section class="section" id="itemsnav">
                    <div class="section__inner">
                        <div class="itemsnav siteblock">
                            <?php if($page != 1) : ?>
                            <a href="allitems.php?page=<?php echo $page-1; ?>" class="btn btn--nodef back"><span class="i-angle"></span></a>
                            <?php endif; ?>
                            <?php for($i = 1; $i < ($members/9)+1; $i++) : ?>
                            <a href="allitems.php?page=<?php echo $i; ?>" class="btn btn--nodef navlink <?php if($i == $page) echo 'current' ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>
                            <?php if($page != ($members/2+1)) : ?>
                            <a href="allitems.php?page=<?php echo $page+1; ?>" class="btn btn--nodef forw"><span class="i-angle"></span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
</body>

</html>