<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
?>
<div class="icon_info">
    <ul>
        <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a>
        </li>
        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
        <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a>
        </li>
    </ul>
    <ul class="user_profile_dd">
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle"
                    src="<?= Url::to('@web') ?>/template/images/layout_img/user_img.jpg" alt="#" /><span
                    class="name_user">John
                    David</span></a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <a class="dropdown-item" href="help.html">Help</a>
                <?= Html::a('<span>Log Out</span>',['site/logout'], ['class' => 'dropdown-item', 'data' => ['method' => 'post']]) ?>
            </div>
        </li>
    </ul>
</div>