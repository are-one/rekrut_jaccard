<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Interview */

$this->title = $model->pelamarNik->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="interview-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute'=>'pelamar_nik',
                'label' => 'NIK',
                'captionOptions' => ['style'=> 'width:25%']
            ],
            [
                'attribute'=>'lowongan.nama_pekerjaan',
                'label' => 'Pekerjaan Yang di Lamar',
                'captionOptions' => ['style'=> 'width:25%']
            ],

            [
                'attribute'=>'tanggal_interview',
                'label' => 'Jadwal Interview / Tes',
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
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>