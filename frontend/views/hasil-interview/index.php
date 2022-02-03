<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\HasilInterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hasil Interviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hasil-interview-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hasil Interview', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'keterangan:ntext',
            'interview_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HasilInterview $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'interview_id' => $model->interview_id]);
                 }
            ],
        ],
    ]); ?>


</div>
