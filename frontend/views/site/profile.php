<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = "Profile";
?>
<div class="row column1">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2 class="d-inline">Profile</h2>
                </div>

                <?= Html::a('<i class="fas fa-plus-circle"></i> Edit Profile',['/pelamar/update','nik' => $pelamar->nik],['class' => 'btn btn-info float-right']) ?>

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
                                    <h3><?= $pelamar->nama_lengkap ?></h3>
                                    <p><strong>NIK: </strong><?= $pelamar->nik ?></p>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-envelope"></i> : <?= $pelamar->email ?>
                                        </li>
                                        <li><i class="fa fa-phone"></i> :
                                            <?= $pelamar->no_hp ?? '<i class="text-muted">Belum diset</i>' ?></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <!-- profile contant section -->
                        <div class="full inner_elements margin_top_30">
                            <div class="tab_style2">
                                <div class="tabbar">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                href="#recent_activity" role="tab" aria-selected="true">Data Diri</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                href="#berkas" role="tab" aria-selected="false">Berkas</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="recent_activity" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <div class="msg_list_main">
                                                <ul class="msg_list">
                                                    <li>
                                                        <!-- <span><img
                                                                src="<?= Url::base() ?>/template/images/layout_img/msg2.png"
                                                                class="img-responsive" alt="#"></span> -->
                                                        <span>
                                                            <span class="name_user">Tempat Lahir</span>
                                                            <span
                                                                class="msg_user"><?= $pelamar->tempat_lahir ? $pelamar->tempat_lahir : '<i class="text-muted">Belum diset</i>' ?></span>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <!-- <span><img
                                                                src="<?= Url::base() ?>/template/images/layout_img/msg2.png"
                                                                class="img-responsive" alt="#"></span> -->
                                                        <span>
                                                            <span class="name_user">Tanggal Lahir</span>
                                                            <span
                                                                class="msg_user"><?= $pelamar->tanggal_lahir ? date('j F Y', strtotime($pelamar->tanggal_lahir)) : '<i class="text-muted">Belum diset</i>' ?></span>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <!-- <span><img
                                                                src="<?= Url::base() ?>/template/images/layout_img/msg2.png"
                                                                class="img-responsive" alt="#"></span> -->
                                                        <span>
                                                            <span class="name_user">Alamat</span>
                                                            <span
                                                                class="msg_user"><?= $pelamar->alamat ? $pelamar->alamat : '<i class="text-muted">Belum diset</i>' ?></span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="berkas" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <div class="msg_list_main">
                                                <ul class="msg_list">
                                                    <li>
                                                        <!-- <span><img
                                                                src="<?= Url::base() ?>/template/images/layout_img/msg2.png"
                                                                class="img-responsive" alt="#"></span> -->
                                                        <span>
                                                            <span class="name_user">
                                                                CV
                                                                <?= $pelamar->file_cv ? Html::a('<i class="fas fa-eye"></i>', ['/pelamar/file','id' => $pelamar->file_cv,'type' => 2], ['class' => 'btn btn-sm btn-link']) : '<i class="text-muted">{Belum diset}</i>' ?>
                                                            </span>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <!-- <span><img
                                                                src="<?= Url::base() ?>/template/images/layout_img/msg2.png"
                                                                class="img-responsive" alt="#"></span> -->
                                                        <span>
                                                            <span class="name_user">
                                                                Ijazah
                                                                <?= $pelamar->file_ijazah ? Html::a('<i class="fas fa-eye"></i>', ['/pelamar/file','id' => $pelamar->file_ijazah,'type' => 1], ['class' => 'btn btn-sm btn-link']) : '<i class="text-muted">{Belum diset}</i>' ?>
                                                            </span>
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end user profile section -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- end row -->
</div>