<div class="nav__container">
    <nav class="nav siteblock">
        <div class="menu__inner">
            <?php if($user_info) : ?>
                <a href="profile.php" class="link link--fill">Профиль</a>
            <?php else : ?>
                <a href="login.php" class="link link--fill">Профиль</a>
            <?php endif; ?>
            <a href="index.php" class="link link--fill current">Главная</a>
            <a href="allitems.php" class="link link--fill" data--pathnames-current="edititem.php;item.php;viewitem.php">Объявления</a>
            <?php if($user_info) : ?>
                <a href="settings.php" class="link link--fill">Натройки</a>
                <a class="link link--fill link--red" onclick="logout()">Выйти</a>
            <?php endif; ?>
        </div>

        <div class="dop">
            <a href="help.php" class="link link--fill">Помощь</a>
            <a href="about.php" class="link link--fill">О нас</a>
            <div class="social">
                <a href="" target="_blank" class="link"><span class="i-vk"></span></a>
                <a href="" target="_blank" class="link"><span class="i-telegram"></span></a>
                <a href="" target="_blank" class="link"><span class="i-instagram"></span></a>
            </div>
        </div>
    </nav>
</div>