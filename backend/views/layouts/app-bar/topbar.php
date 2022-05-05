<?php

use yii\helpers\Url;
?>
<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="full">
            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
            <div class="logo_section">
                <a href="index.html">
                    <!-- <img class="img-responsive" src="<?= Url::to('@web') ?>/template/images/logo/logo.png" alt="#" /></a> -->
            </div>
            <div class="right_topbar">
                <?= $this->render("@app/views/layouts/menu/topbar") ?>
            </div>
        </div>
    </nav>
</div>