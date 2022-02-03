<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\LowonganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lowongan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama_pekerjaan') ?>

    <?= $form->field($model, 'tgl_publish') ?>

    <?= $form->field($model, 'tgl_penutupan') ?>

    <?= $form->field($model, 'deskripsi') ?>

    <?php // echo $form->field($model, 'hrd_nik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
