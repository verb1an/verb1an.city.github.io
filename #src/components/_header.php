<header class="header">
    <div class="container full">
        <div class="header__inner">
            <div class="logo__wrap">
                <a href="index.php" class="logo">
                    <svg width="105" height="60" viewBox="0 0 105 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M39.1775 20.2732C35.7019 18.2666 34.4566 13.751 36.4873 10.2335C38.494 6.75797 43.0096 5.51263 46.527 7.54342C50.0025 9.55003 51.2479 14.0656 49.2171 17.5831C47.1863 21.1005 42.6949 22.304 39.1775 20.2732Z" fill="white"/>
                        <path d="M94.2671 32.6094C100.094 22.5177 96.5893 9.43974 86.4976 3.6133C76.3641 -2.23731 63.328 1.29109 57.5016 11.3828L41.9805 38.266C41.9805 38.266 81.1153 55.3889 94.2671 32.6094Z" fill="white"/>
                        <path d="M7.39788 30.1124C3.3363 37.1473 5.73677 46.2381 12.7716 50.2996C19.8065 54.3612 28.8554 51.9366 32.917 44.9017L43.7237 26.1839C43.7656 26.2081 16.5364 14.284 7.39788 30.1124ZM18.2113 40.8779C16.3688 39.8142 15.7317 37.4364 16.7954 35.5939C17.8592 33.7514 20.237 33.1143 22.0794 34.1781C23.9219 35.2418 24.559 37.6196 23.4953 39.4621C22.4734 41.3287 20.0956 41.9659 18.2113 40.8779Z" fill="white"/>
                    </svg>
                    <span>City Problems</span>
                </a>
            </div>

            <div class="buttons">
                <div class="norifyis__btns">
                    <a class="btn" id="modak-tog" data-modal="mdl-notify"><span class="i-notify"></span></a>
                    <a class="btn"><span class="i-search"></span></a>
                </div>
                <?php if($user_info) : ?>
                    <a href="profile.php" class="u_image"><?php echo $user_info['u_name']; ?>  <img src="<?php echo $user_info['image']; ?>" alt=""></a>
                <?php else : ?>
                    <a href="login.php" class="btn btn--toSingInPage">Войти</a>
                <?php endif; ?>
            </div>

            <div class="headers__modals">
                <div class="modal siteblock" data--modal="notify">
                    123
                </div>
            </div>
        </div>
    </div>
</header>