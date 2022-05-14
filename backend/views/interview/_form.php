<?php

use backend\models\Penilaian;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Interview */
/* @var $form yii\widgets\ActiveForm */

$dataTes = Penilaian::find()->where(['interview_id' => $model->id])->andWhere(['pilih'=> null]);

?>

<div class="interview-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'pelamarNik.nama_lengkap',
                'label' => 'Nama',
                'captionOptions' => ['style'=> 'width:25%']
            ],

            [
                'attribute'=>'lowongan.nama_pekerjaan',
                'label' => 'Pekerjaan Yang di Lamar',
                'captionOptions' => ['style'=> 'width:25%']
            ],

            [
                'attribute'=>'tanggal_interview',
                'label' => 'Tanggal Interview / Tes',
                'captionOptions' => ['style'=> 'width:25%'],
                'value' => function($model)
                {
                    if($model->tanggal_interview != null){
                        $waktu = strtotime($model->tanggal_interview);
                        if($waktu > time()){
                            return date('j F Y', $waktu). " <i class='badge badge-success'>Waktu Interview/Tes Diatur</i>";
                        }else{
                            return date('j F Y', $waktu). " <i class='badge badge-danger'>Waktu Interview/Tes Telah Selesai</i>";
                        }
                    }else{
                        return '<i class="badge badge-warning">Jadwal belum diatur</i>';
                    }
                },
                'format' => 'raw',
                // 'visible' => ($dataTes == null),
            ],
        ]
    ]); ?>
    <?php $form->field($model, 'pelamar_nik')->textInput(['maxlength' => true]) ?>

    <?php
        if($dataTes != null){
    ?>
    <?= $form->field($model, 'tanggal_interview')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih Tanggal Interview / Tes...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ])->label('Atur Jadwal Interview/Tes') ; ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Tetapkan Jadwal Interview / Tes', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>