<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hrd */

$this->title = 'Update Hrd: ' . $model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Hrds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nik, 'url' => ['view', 'nik' => $model->nik]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
