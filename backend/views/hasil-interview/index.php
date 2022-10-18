<?php

use backend\models\Interview;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\HasilInterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hasil Interviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
<div class="alert alert-danger">
    <?= Yii::$app->session->getFlash("error") ?>
</div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
<div class="alert alert-success">
    <?= Yii::$app->session->getFlash("success") ?>
</div>
<?php endif; ?>

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
                        <?= Html::a('<i class="fas fa-sync"></i> Update Hasil', ['update-hasil'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            [
                                'attribute' => 'nama_pekerjaan',
                                'label' => 'Nama Pekerjaan',
                                'value' => function ($model) {
                                    return $model->nama_pekerjaan;
                                }
                            ],
                            'deskripsi:ntext',
                            [
                                'label' => 'Jumlah Pelamar',
                                'value' => function ($model) {
                                    $jumlah = Interview::find()->where(['lowongan_id' => $model->id])->count();
                                    return Html::a($jumlah, ['view', 'lowongan_id' => $model->id], ['class' => 'btn btn-link']);
                                },
                                'format' => 'raw'
                            ],
                            // [
                            //     'class' => ActionColumn::className(),
                            //     'urlCreator' => function ($action, \backend\models\Lowongan $model, $key, $index, $column) {
                            //         return Url::toRoute([$action, 'id' => $model->id]);
                            //     }
                            // ],
                        ],
                    ]); ?>


                </div>
            </div>
        </div>
    </div>

</div>