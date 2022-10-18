<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\HasilInterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hasil Interview';
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

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'interview.lowongan.nama_pekerjaan',
                            'keterangan:ntext',
                            // [
                            //     'class' => ActionColumn::className(),
                            //     'urlCreator' => function ($action, \frontend\models\HasilInterview $model, $key, $index, $column) {
                            //         return Url::toRoute([$action, 'id' => $model->id, 'interview_id' => $model->interview_id]);
                            //     }
                            // ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>