<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PilihanJawaban */

$this->title = 'Buat Pilihan Jawaban';
$this->params['breadcrumbs'][] = ['label' => 'Pilihan Jawabans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">


                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>

</div>