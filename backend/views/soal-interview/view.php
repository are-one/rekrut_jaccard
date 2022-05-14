<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SoalInterview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Soal Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">

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
                            'id',
                            'soal:ntext',
                            [
                                'attribute' => 'jawaban',
                                'value' => function($model)
                                {                          
                                    return boolval($model->jawaban) ? $model->jawaban : "<i>Jawaban belum diatur</i>";
                                },
                                'format' => 'raw',
                            ],
                            // 'kategori',
                            'hrd_nik',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2>
                <?= Html::a('<i class="fas fa-plus-circle"></i> Pilihan Jawaban', ['/pilihan-jawaban/create','soal_interview_id'=> $model->id]) ?>
            </h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'summary' => false,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'pilihan',
                           
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Aksi',
                                'urlCreator' => function ($action, \backend\models\PilihanJawaban $modelPilihan, $key, $index, $column) use ($model) {
                                    return Url::toRoute(['/pilihan-jawaban/'.$action, ' id' => $modelPilihan->id, 'soal_interview_id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>

                    <div class="alert alert-warning mt-3">
                        <span>Saat anda menghapus soal maka semua pilihan jawaban juga akan ikut terhapus.</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>