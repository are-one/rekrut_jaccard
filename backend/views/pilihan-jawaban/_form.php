<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PilihanJawaban */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pilihan-jawaban-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'pilihan')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'soal_interview_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>