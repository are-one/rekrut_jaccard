<?php

use yii\helpers\Url;
?>
<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive"
                        src="<?= Url::to('@web') ?>/template/images/logo/logo_icon.png" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive"
                        src="<?= Url::to('@web') ?>/template/images/layout_img/user_img.jpg" alt="#" /></div>
                <div class="user_info">
                    <h6><?= (Yii::$app->user->isGuest)? "No Session" : Yii::$app->user->identity->username ?></h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <?= $this->render("@app/views/layouts/menu/sidebar") ?>
    </div>
</nav>