<?php

use yii\helpers\Url;
?>

<ul class="list-unstyled components">
    <li><a href="<?= Url::to(['/site/index']) ?>"><i class="fa fa-dashboard yellow_color"></i>
            <span>Dashboard</span></a></li>
    <li><a href="<?= Url::to(['/interview/index']) ?>"><i class="fa fa-clock-o orange_color"></i> <span>Jadwal
                Interview</span></a></li>
    <li><a href="<?= Url::to(['/hasil-interview/index']) ?>"><i class="fa fa-cog yellow_color"></i> <span>Info
                Kelulusan</span></a></li>
</ul>