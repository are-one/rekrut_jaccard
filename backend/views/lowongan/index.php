<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LowonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Lowongan';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small><?= Html::encode($this->title) ?></small></h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">

                    <p>
                        <?= Html::a('<i class="fas fa-plus-circle"></i> Lowongan', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'summary' => false,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'nama_pekerjaan',
                            'tgl_publish',
                            'tgl_penutupan',
                            [
                                'attribute' => 'deskripsi',
                                'value' => function($model)
                                {
                                    if(in_array($model->deskripsi,[null, ""])){
                                        return "<i>Tidak ada deskripsi</i>";
                                    }else{
                                        return $model->deskripsi;
                                    }
                                },
                                'format' => 'raw',
                            ],
                            
                            //'hrd_nik',
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Aksi',
                                'urlCreator' => function ($action, \backend\models\Lowongan $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'template' => '{view}'
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>