<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Penilaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'interview_id',
            'soal_interview_id',
            'nilai',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Penilaian $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id]);
                 }
            ],
        ],
    ]); ?>


</div>
