<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\PelamarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelamar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'tempat_lahir') ?>

    <?= $form->field($model, 'tanggal_lahir') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'file_cv') ?>

    <?php // echo $form->field($model, 'file_ijazah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
