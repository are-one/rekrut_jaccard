<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Interview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interview-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lowongan_id')->textInput() ?>

    <?= $form->field($model, 'pelamar_nik')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
