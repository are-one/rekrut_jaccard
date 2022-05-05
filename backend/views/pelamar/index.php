<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PelamarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pelamar';
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
                    <!-- <p>
        <?= Html::a('Create Pelamar', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'nik',
                            'nama_lengkap',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'alamat:ntext',
                            //'no_hp',
                            //'email:email',
                            //'file_cv',
                            //'file_ijazah',
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Aksi',
                                'template' => '{view}',
                                'urlCreator' => function ($action, \backend\models\Pelamar $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'nik' => $model->nik]);
                                }
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>