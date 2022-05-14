<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PilihanJawabanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pilihan Jawabans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pilihan-jawaban-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pilihan Jawaban', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pilihan',
            'soal_interview_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PilihanJawaban $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'soal_interview_id' => $model->soal_interview_id]);
                 }
            ],
        ],
    ]); ?>


</div>
