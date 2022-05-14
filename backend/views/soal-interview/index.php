<?php

use backend\models\PilihanJawaban;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SoalInterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soal Interview';
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
                        <?= Html::a('Buat Soal Interview', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'soal:ntext',
                            [
                                'attribute' => 'jawaban',
                                'value' => function($model)
                                {                          
                                    return boolval($model->jawaban) ? $model->jawaban : "<i>Jawaban belum diatur</i>";
                                },
                                'format' => 'raw',
                            ],
                            'kategori',
                            [
                                'attribute' => 'hrd_nik',
                                'label' => 'HRD',
                                'value' => function($model)
                                {
                                    return $model->hrdNik->nama_lengkap;
                                }
                            ],
                            [
                                'label' => 'Jumlah Pilihan Jawaban',
                                'value' => function($model)
                                {
                                    $jumlahPilihan = PilihanJawaban::find()->where(['soal_interview_id' => $model->id])->count();
                                    return $jumlahPilihan;
                                }
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Aksi',
                                'urlCreator' => function ($action, \backend\models\SoalInterview $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>