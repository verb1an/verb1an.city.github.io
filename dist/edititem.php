<?php
session_start();
if($_SESSION['user']) {
    include_once('server/user.php');
    include('server/connection.php');
    $user->autologin($connect);
    $user_info = $_SESSION['user'];
}else{
    header('Location: index.php');
}

if( isset($_GET['edit']) && !empty($_GET['edit'])) { 
    $i_id = $_GET['edit'];
    $sth = $connect->prepare("SELECT * FROM `sys_items` WHERE id=$i_id");
    $sth->execute();
    $item_src = $sth->fetch();

    if($item_src['status'] == 'disabled') {
        header('Location: index.php');
    }else{
        if($user_info['rights'] == 'super' || $user_info['id'] == $item_src['user']) {
        // echo 'true';
        }else{
            header('Location: index.php');
        }
    }
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
                    <section class="section" id="createitem">
                        <div class="section__inner">
                            <div class="createitem siteblock">
                                <div class="headers">
                                    <h2 class="title">Редактировать заявку №<?php echo $item_src['id']; ?></h2>
                                </div>
                                <div class="content">
                                    <div class="inp"><input name="item_name" type="text" class="input-text" placeholder="Название" value="<?php echo $item_src['name']; ?>"></div>
                                    <div class="inp">
                                        <textarea name="item_text" class="input-text" placeholder="Краткое писание проблемы"><?php echo $item_src['text']; ?></textarea>
                                    </div>
                                    <div class="inp file">
                                        <input type="file" name="" id="itemsfiles" multiple>
                                        <span>Максимум 10 фото</span>
                                    </div>
                                    <div class="imgpreviews">
                                        <?php 
                                            $item_src['images'] = substr($item_src['images'], 0, -1);
                                            $images = explode(';', $item_src['images']);

                                            foreach($images as $key) :
                                        ?>
                                            <div class="img"><img src="<?php echo $key; ?>" alt=""><a class="del"></a></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php 
                                        $item_src['cats'] = substr($item_src['cats'], 0, -1);
                                        $cats = explode(';', $item_src['cats']);
                                    ?>
                                    <div class="inp dls">
                                        <input type="text" name="" list="data--cat" class="input-text input--cat" placeholder="Категории" value="<?php if($cats[0]) echo $cats[0]; ?>">
                                        <datalist id="data--cat" >
                                            <?php  
                                                include('server/connection.php');
                                                $sth = $connect->prepare("SELECT * FROM sys_catygories");
                                                $sth->execute();
                                                $result = $sth->fetchAll();
                                                foreach($result as $key) :
                                            ?>
                                            <option value="<?php echo $key['name']; ?>" data--cat-id="<?php echo $key['id']; ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                    <div class="inp dls">
                                        <input type="text" name="" list="data--cat2" class="input-text input--cat" placeholder="Категории" value="<?php if($cats[0]) echo $cats[1]; ?>">
                                        <datalist id="data--cat2" >
                                            <?php  
                                                foreach($result as $key) :
                                            ?>
                                            <option value="<?php echo $key['name']; ?>" data--cat-id="<?php echo $key['id']; ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                    <div class="inp dls">
                                        <input type="text" name="" list="data--cat3" class="input-text input--cat" placeholder="Категории" value="<?php if($cats[0]) echo $cats[2]; ?>">
                                        <datalist id="data--cat3" >
                                            <?php  
                                                foreach($result as $key) :
                                            ?>
                                            <option value="<?php echo $key['name']; ?>" data--cat-id="<?php echo $key['id']; ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                    <div class="inp dls">
                                        <input type="text" name="" list="data--cat4" class="input-text input--cat" placeholder="Категории" value="<?php if($cats[0]) echo $cats[3]; ?>">
                                        <datalist id="data--cat4" >
                                            <?php  
                                                foreach($result as $key) :
                                            ?>
                                            <option value="<?php echo $key['name']; ?>" data--cat-id="<?php echo $key['id']; ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="right--col">
                    <section class="section" id="itemtab">
                        <div class="section__inner">
                            <div class="itemtab siteblock">
                                <div class="content">
                                    <a class="link link--fill" onclick="addNewItem('edit')">Сохранить</a>
                                    <a class="link link--fill btn--clearCreateItem">Очистить</a>
                                    <a href="index.php" class="link link--fill">Отмена</a>
                                    <a class="link">
                                        Отображать моё имя
                                        <div class="checkbox">
                                            <input type="checkbox" name="" checked="checked" id="visname">
                                            <label for="visname"></label>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="message__form"></div>
    </main>
</body>

</html>