<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hrd */

$this->title = 'Edit Profile: ' . $model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Hrds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nik, 'url' => ['view', 'nik' => $model->nik]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small><?= Html::encode($this->title) ?></small></h2>
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