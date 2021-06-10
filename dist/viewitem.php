<?php
session_start();
if($_GET['id']) {
    include('server/connection.php');
    if ($_SESSION['user']) {
        include('server/user.php');
        $user->autologin($connect);
        $user_info = $_SESSION['user'];
    }

    $sth = $connect->prepare("SELECT * FROM sys_items WHERE id = $_GET[id]");
    $sth->execute();
    $item_src = $sth->fetch(PDO::FETCH_ASSOC);

    if($item_src['status'] == 'disabled') {
        header('Location: index.php');
    }

    $item_src['images'] = substr($item_src['images'],0,-1);
    $item_src['cats'] = substr($item_src['cats'],0,-1);
}else{
    header('Location: index.php');
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


            <div class="center--col">
                <section class="section" id="viewitem">
                    <div class="section__inner">
                        <div class="viewitem siteblock">
                            <div class="content">
                                <div class="slider">
                                    <?php foreach( explode(';', $item_src['images']) as $key ) : ?>
                                        <div class="mainimg"><img src="<?php echo $key; ?>" alt=""></div>
                                    <?php echo '1'; endforeach; ?>
                                </div>
                                <div class="thumbs">
                                    <?php $i = 0; ?>
                                    <?php foreach( explode(';', $item_src['images']) as $key ) : ?>
                                        <a class="th" data--slider-active="<?php echo $i; ?>"><img src="<?php echo $key; ?>" alt=""></a>
                                    <?php $i++;endforeach; ?>
                                </div>

                                <div class="item__info">
                                    <h2 class="u_id">
                                        Заявка №<?php echo $item_src['id']; ?>
                                        <span class="status" data--status="<?php echo $item_src['status']; ?>">Выполнено</span>
                                    </h2>
                                    <div class="i_atuser">
                                        <?php if($item_src['show_name'] == true) : ?>
                                            <?php 
                                                $uname_sth = $connect->prepare("SELECT `u_name` FROM `sys_users` WHERE id=$item_src[user]");
                                                $uname_sth->execute();
                                            ?>
                                                От пользователя: <span><?php echo $uname_sth->fetch()[0]; ?></span>
                                            <?php endif; ?>
                                    </div>
                                        
                                    <div class="i_name"><?php echo $item_src['name']; ?></div>
                                    <div class="i_date">Дата: <span><?php echo $item_src['date']; ?></span></div>
                                    <div class="text"><?php echo $item_src['text']; ?></div>
                                    <div class="cats">
                                        <?php foreach ( explode(';', $item_src['cats']) as $key ) : ?>
                                            <a href="allitems?search=<?php echo $key; ?>" class="btn btn--cat"><?php echo $key; ?><span class="i-angle"></span></a>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <?php if($user_info['id'] == $item_src['user'] || $user_info['rights'] == 'super') : ?>
                <div class="right--col">
                    <div class="section" id="user__menu">
                        <div class="section__inner">
                            <div class="user__menu siteblock">
                                <div class="content">
                                    <a href="edititem.php?edit=<?php echo $item_src['id']; ?>" class="link link--fill">Редактировать</a>
                                    <?php if($user_info['rights'] == 'super') : ?>
                                    <a class="link btn--changeStatus">Статус:
                                        <div class="checkbox">
                                            <input type="checkbox" name="" <?php if($item_src['status'] == 'true') { echo 'checked="checked"'; } ?> id="changestatus">
                                            <label for="changestatus"></label>
                                        </div>
                                    </a>
                                    <?php endif; ?>
                                    <a class="link link--fill link--red" onclick="disItem()">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<div class="message__form"></div>

<script>
    defaultSlider({
        target: `#viewitem .slider`,
        thumbs: `.viewitem .thumbs .th`,
        line: document.querySelector(`#viewitem .slider .mainimg`).getBoundingClientRect().width + 10,
    });
    let thumbs = document.querySelectorAll('.viewitem .thumbs .th');
    thumbs.forEach((el) => {
        el.addEventListener('click', function() {
            thumbs.forEach((leave) => {
                leave.classList.remove('current');
                el.getAttribute('data--slider-active') > 1 ? leave.style = `left: ${(el.getAttribute('data--slider-active')-1)*-160}px` : leave.style = 'left: 0;';
            });
            this.classList.add('current');
        })
    })
</script>

</body>

</html>