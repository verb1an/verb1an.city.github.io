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

    $search = '';
    if($_GET['search']) {
        $search = "AND `name` LIKE " . "'%" . $_GET['search'] . "%'"; 
    }else if($_GET['category']){
        $search = "AND `cats` LIKE " . "'%" . $_GET['category'] . "%'";
    }
    
    $query = "SELECT * FROM `sys_items` WHERE `status` != 'disabled' $search ORDER BY `id` DESC"; 
    $connect->quote($query);
    $sth = $connect->prepare($query);
    $sth->execute();
    $items_src = $sth->fetchAll();

    $max = 9;
    
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
                            <?php if(count($items_src) < 1) : ?>
                                <section class="section" id="noresult">
                                    <div class="section__inner">
                                        <div class="noresult siteblock">
                                            <div class="content">
                                                <span class="i-search"></span>
                                                <h4>Нету результатов</h4>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php endif; ?>
                            <?php for($i = ($page-1)*$max; $i < $page*$max; $i++) : ?>
                            <?php if($items_src[$i]) : ?>
                            <a href="viewitem.php?id=<?php echo $items_src[$i]['id'] ?>" class="item siteblock">
                                <?php $img = explode(';', $items_src[$i]['images'])[0]; ?>
                                <div class="img"><img src="<?php echo $img; ?>" alt=""></div>
                                <h3 class="id">Заявка №<?php echo $items_src[$i]['id']; ?>
                                    <?php if($items_src[$i]['show_name']) : ?>
                                        <?php 
                                            $un_sth = $connect->prepare("SELECT `u_name` FROM `sys_users` WHERE `id` = $items_src[$i][user]");
                                            $un_sth->execute();
                                            $u_name = $un_sth->fetch()[0];
                                        ?>
                                        <span><?php echo $u_name; ?></span>
                                    <?php endif;?>
                                </h3>
                                <div class="name"><?php echo $items_src[$i]['name']; ?></div>
                                <div class="date">На сайте с <?php echo $items_src[$i]['date']; ?></div>
                                <span class="status" style="display: block;" data--status="<?php echo $items_src[$i]['status']; ?>">Выполнено</span>
                            </a>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php if($_GET['category']) {
                    $s = "&category=$_GET[category]";
                }else if($_GET['search']) {
                    $s = "&search=$_GET[search]";
                } ?>
                    
                <section class="section" id="itemsnav">
                    <div class="section__inner">
                        <div class="itemsnav siteblock">
                            <?php if($page != 1) : ?>
                            <a href="allitems.php?page=<?php echo $page-1; echo $s; ?>" class="btn btn--nodef back"><span class="i-angle"></span></a>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= ceil(count($items_src)/($max)); $i++) : ?>
                            <a href="allitems.php?page=<?php echo $i; echo $s; ?>" class="btn btn--nodef navlink <?php if($i == $page) echo 'current' ?>"><?php echo $i; ?></a>
                            <?php endfor; ?>
                            <?php if( $page != ceil(count($items_src)/($max)) ) : ?>
                            <a href="allitems.php?page=<?php echo $page+1; echo $s; ?>" class="btn btn--nodef forw"><span class="i-angle"></span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>

            <div class="right--coll">
                <section class="section" id="searchall">
                    <div class="section__inner">
                        <div class="searchall siteblock">
                            <div class="content">
                                <?php  
                                    if($_GET['search']) {
                                        $search_val = $_GET['search'];
                                    }
                                ?>
                                <div class="inp"><input type="search" name="" id="" class="input-text" oninput="searchall()" value="<?php echo $search_val;?>"><a href=""><span class="i-search"></span></a></div>
                                <div class="catygories--block">
                                    <?php 
                                        $query = $connect->prepare("SELECT * FROM `sys_catygories` LIMIT 8");
                                        $query->execute();
                                        $cats = $query->fetchAll();
                                        foreach($cats as $key) :
                                    ?>
                                    <a href="allitems.php?category=<?php echo $key['name']; ?>" class="btn btn--cat"><?php echo $key['name']; ?><span class="i-angle"></span></a>
                                    <?php endforeach; ?>
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