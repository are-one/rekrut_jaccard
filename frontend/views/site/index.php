<?php

use frontend\models\Interview;
use yii\bootstrap4\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = "Dashboard";
?>
<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small>Temukan Pekerjaan Yang Cocok Untuk Kamu</small></h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">

                    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped projects'],
        'headerRowOptions' => ['class' => 'thead-dark'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'nama_pekerjaan',
                'sortLinkOptions' => ['style' => 'color:white']
            ],
            // [
            //     'attribute' => 'tgl_publish',
            //     'sortLinkOptions' => ['style' => 'color:white']
            // ],
            // [
            //     'attribute' => 'tgl_penutupan',
            //     'sortLinkOptions' => ['style' => 'color:white']
            // ],
            // [
            //     'attribute' => 'deskripsi',
            //     'sortLinkOptions' => ['style' => 'color:white'],
            //     'format' => 'ntext',
            //     'value' => function($model)
            //     {
            //         if(in_array($model->deskripsi,[null, ""])){
            //             return "<i>Tidak ada deskripsi</i>";
            //         }else{
            //             return $model->deskripsi;
            //         }
            //     },
            //     'format' => ['raw','ntext'],
            // ],
            [
                'header' => 'Lihat Syarat & Kententuan',
                'class' => ActionColumn::class,
                'buttons' => [
                    'syarat' => function($url, $model, $key)
                    {
                        return Html::a('Lihat Persyaratan',['/lowongan/view','id' => $key],['class' => 'btn btn-success btn-xs']);
                    }
                ],
                'template' => '{syarat}'
            ],
            [
                'header' => 'Aksi',
                'class' => ActionColumn::class,
                'buttons' => [
                    'lamar-langsung' => function($url, $model, $key)
                    {
                        $terdaftar = Interview::findOne(['lowongan_id' => $key,'pelamar_nik' => Yii::$app->user->identity->id]);
                        if($terdaftar){
                            return Html::a('Telah Terdaftar',['/lowongan/lamar','id'=> $model->id],['class' => 'btn btn-danger btn-xs']);
                        }else{
                            return Html::a('Lamar Langsung',['/lowongan/lamar','id'=> $model->id],['class' => 'btn btn-success btn-xs']);
                        }
                    }
                ],
                'template' => '{lamar-langsung}'
            ],
        ],
    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>