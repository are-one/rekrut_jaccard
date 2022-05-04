<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
?>
<div class="icon_info">
    <ul>
        <!-- <li><a href="#"><i class="fas fa-bell"></i><span class="badge">2</span></a>
        </li>
        <li><a href="#"><i class="fas fa-question-circle"></i></a></li> -->
        <li><a href="#"><i class="fas fa-envelope"></i><span class="badge">3</span></a>
        </li>
    </ul>
    <ul class="user_profile_dd">
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle"
                    src="<?= Url::to('@web') ?>/template/images/layout_img/user_img.jpg" alt="#" /><span
                    class="name_user"><?= (Yii::$app->user->isGuest)? "No Session" : Yii::$app->user->identity->username ?></span></a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= Url::toRoute(['site/profile']) ?>">My Profile</a>
                <?= Html::a('<span>Log Out</span>',['site/logout'], ['class' => 'dropdown-item','data' => ['method' => 'post']]) ?>
            </div>
        </li>
    </ul>
</div>