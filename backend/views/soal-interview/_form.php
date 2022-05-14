<?php

use backend\models\PilihanJawaban;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SoalInterview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soal-interview-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput()->label('Kode Soal') ?>

    <?= $form->field($model, 'soal')->textarea(['rows' => 6]) ?>

    <?= ($model->isNewRecord) ? "" : $form->field($model, 'jawaban')->dropDownList(ArrayHelper::map(PilihanJawaban::find()->where(['soal_interview_id' => $model->id])->all(),'id','pilihan'),[
        'prompt' =>  '- Pilih jawaban -'
    ]) ?>

    <?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'hrd_nik')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>