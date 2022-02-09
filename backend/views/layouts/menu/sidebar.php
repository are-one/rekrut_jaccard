<?php

use yii\helpers\Url;
?>

<ul class="list-unstyled components">
    <li><a href="<?= Url::to(['/site/index']) ?>"><i class="fa fa-dashboard yellow_color"></i>
            <span>Dashboard</span></a></li>

    <li><a href="<?= Url::to(['/lowongan/index']) ?>"><i class="fa fa-clock-o orange_color"></i> <span>Berkas
                Lowongan</span></a></li>
    <li>
        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="fa fa-diamond purple_color"></i> <span>Berkas Pelamar</span></a>
        <ul class="collapse list-unstyled" id="element">
            <li><a href="<?= Url::to(['/pelamar/index']) ?>"> <span>Data Pelamar</span></a></li>

        </ul>
    </li>
    <li>
        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="fa fa-object-group blue2_color"></i> <span>Data Interview</span></a>
        <ul class="collapse list-unstyled" id="apps">
            <li><a href="<?= Url::to(['/interview/index']) ?>">> <span>Page Interview</span></a></li>
            <li><a href="<?= Url::to(['/soal-interview/index']) ?>">> <span>Soal Interview</span></a></li>
        </ul>
    </li>
    <li><a href="<?= Url::to(['/hasil-interview/index']) ?>"><i class="fa fa-briefcase blue1_color"></i> <span>Data
                Rangking</span></a></li>
</ul>