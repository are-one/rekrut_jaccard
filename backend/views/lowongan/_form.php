<?php

use backend\models\Hrd;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lowongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lowongan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_publish')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'PILIH TANGGAL PUBLISH ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label('Tanggal Publish') ; ?>

    <?= $form->field($model, 'tgl_penutupan')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'PILIH TANGGAL PENUTUPAN ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label('Tanggal Penutupan'); ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'hrd_nik')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Hrd::find()->all(),'id','nama_skala_kegiatan' ),
        'language' => 'id',
        'options' => ['placeholder' => 'PILIH HRD ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('HRD'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>