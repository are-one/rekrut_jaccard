<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = "Profile";
?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash("error") ?>
    </div>
<?php endif; ?>
<div class="row column1">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2 class="d-inline">Profile</h2>
                </div>

                <?= Html::a('<i class="fas fa-plus-circle"></i> Edit Akun', ['/hrd/akun', 'nik' => Yii::$app->user->identity->id], ['class' => 'btn btn-warning float-right']) ?>

                <?= Html::a('<i class="fas fa-plus-circle"></i> Edit Profile', ['/hrd/edit', 'nik' => Yii::$app->user->identity->id], ['class' => 'btn btn-info float-right mr-2']) ?>


            </div>
            <div class="full price_table padding_infor_info">
                <div class="row">
                    <!-- user profile section -->
                    <!-- profile image -->
                    <div class="col-lg-12">
                        <div class="full dis_flex center_text">
                            <div class="profile_img">
                                <i class="fas fa-user-circle fa-10x"></i>
                                <!-- <img width="180" class="rounded-circle" src="<?= Url::base() ?>/template/images/layout_img/user_img.jpg" alt="#" /> -->
                            </div>
                            <div class="profile_contant">
                                <div class="contact_inner">
                                    <h3><?= $hrd->nama_lengkap ?></h3>
                                    <p><strong>NIK. </strong><?= $hrd->nik ?></p>
                                    <ul class="list-unstyled">

                                        <li><i class="fa fa-envelope"></i> :
                                            <?= Yii::$app->user->identity->email ?? '<i class="text-muted">Belum diset</i>' ?></li>

                                        <li><i class="fa fa-phone"></i> :
                                            <?= $hrd->no_hp ?? '<i class="text-muted">Belum diset</i>' ?></li>
                                    </ul>
                                    <p><strong>Alamat: </strong><?= $hrd->alamat ?></p>
                                </div>

                            </div>
                        </div>
                        <!-- profile contant section -->

                        <!-- end user profile section -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- end row -->
</div>