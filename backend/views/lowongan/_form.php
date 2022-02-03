<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lowongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lowongan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_publish')->textInput() ?>

    <?= $form->field($model, 'tgl_penutupan')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hrd_nik')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
