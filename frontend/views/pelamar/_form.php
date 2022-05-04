<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pelamar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true, 'disabled' => true])->label('NIK') ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true])->label('Nama Lengkap') ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true])->label('Tempat Lahir') ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Pilih Tanggal Lahir...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label('Tanggal Lahir') ; ?>


    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true])->label('No. Handphone') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploadCv')->fileInput(['maxlength' => true])->label('File CV') ?>

    <?= $form->field($model, 'uploadIjazah')->fileInput(['maxlength' => true])->label("File Ijazah") ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>